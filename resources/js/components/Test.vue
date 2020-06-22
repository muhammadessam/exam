<template>
    <div class="row justify-content-center">
        <div class="col-10">
            <!-- start section questions-->
            <div class="row" v-if="sectionsVisibility[0]">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input v-model="studentName" class="form-control" type="text" name="name" id="name" placeholder="please enter your name" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="id">ID: </label>
                        <input class="form-control" v-model="studentID" type="text" name="id" id="id" placeholder="please enter your ID" required>
                    </div>
                </div>

                <button class="btn btn-primary" @click="switchVisibility(0, 'F')"><i class="fa fa-star"></i> Start</button>
            </div>
            <!-- /reading section -->

            <!-- reading section questions-->
            <div class="row" v-if="sectionsVisibility[1]">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-5">
                                <div class="col-12 text-center">
                                    <audio controls>
                                        <source :src="audio" type="audio/mp3">
                                    </audio>
                                </div>
                            </div>
                            <div class="row" v-for="(question, index) in listening">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <strong>{{index+1}} - {{question.question}}</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="radio" v-for="answer in question.ans" v-if="answer">
                                                <label>
                                                    <input type="radio" :value="answer" v-model="reading_answers[index]"
                                                           @change="answerReading(question,index)">
                                                    {{answer}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary" @click="switchVisibility(1, 'B')">Previous</button>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" @click="switchVisibility(1, 'F')">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /reading section -->

            <!-- listening section questions-->

            <div class="row" v-if="sectionsVisibility[2]">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary" @click="switchVisibility(2, 'B')">Previous</button>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" @click="switchVisibility(2, 'F')">Next</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /listening section -->

            <!-- LS section questions-->

            <div class="row" v-if="sectionsVisibility[3]">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary" @click="switchVisibility(3, 'B')">Previous</button>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" @click="switchVisibility(3, 'F')">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /LS section -->

            <!-- Result section-->

            <div class="row" v-if="sectionsVisibility[4]">
                <div class="col-12">
                    Showing result
                </div>
            </div>
            <!-- /result section -->

        </div>

    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                //ui visibility
                sectionsVisibility: [false, true, false, false, false],
                studentName: '',
                studentID: '',

                // getting question
                reading: [],
                listening: [],
                ls: [],
                audio: '',
                description: '',
                readingGroup: null,
                listeningGroup: null,


                // getting result
                reading_answers: [],
                listening_answers: [],
                ls_answers: [],
            }
        },
        methods: {
            switchVisibility(index, direction) {
                this.answers = [];
                if (direction == 'F') {
                    this.$set(this.sectionsVisibility, index + 1, true)
                    this.$set(this.sectionsVisibility, index, false)
                } else {
                    this.$set(this.sectionsVisibility, index - 1, true)
                    this.$set(this.sectionsVisibility, index, false)
                }
            },
            answerListening(question, index) {
                this.$set(question, 'chioce', this.listening_answers[index]);
            },
            answerReading(question, index) {
                this.$set(question, 'chioce', this.reading_answers[index]);
            },
            answerLS(question, index) {
                this.$set(question, 'chioce', this.ls_answers[index]);
            }
        },
        mounted() {
            window.axios.get(route('admin.test.generate')).then((res) => {
                this.reading = res.data.reading.questions;
                this.listening = res.data.listening.questions;
                this.ls = res.data.ls.questions;
                this.audio = res.data.audio;
                this.listeningGroup = res.data.listening;
                this.readingGroup = res.data.reading;
                // shuffling answers
                this.reading.forEach(function (q) {
                    q.chioce = null;
                    q.ans = [q.a1, q.a2, q.a3, q.correct_answer];
                    q.ans = _.shuffle(q.ans);
                });

                this.listening.forEach(function (q) {
                    q.chioce = null;
                    q.ans = [q.a1, q.a2, q.a3, q.correct_answer];
                    q.ans = _.shuffle(q.ans);
                })

                this.ls.forEach(function (q) {
                    q.chioce = null;
                    q.ans = [q.a1, q.a2, q.a3, q.correct_answer];
                    q.ans = _.shuffle(q.ans);
                })
            });
        }
    }
</script>
