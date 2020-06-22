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

            <!-- listening section questions-->
            <div class="row" v-if="sectionsVisibility[1]">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-5">
                                <div class="col-12 text-center">
                                    <audio controls>
                                        <source :src="audio" type="audio/mpeg">
                                        Your browser does not support the audio element.
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
                                    <div class="row " v-for="answer in question.ans" v-if="answer">
                                        <div class="col-12">
                                            <div class="radio pl-4">
                                                <label>
                                                    <input type="radio" :value="answer" v-model="listening_answers[index]"
                                                           @change="answerListening(question,index)">
                                                    {{answer}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-6">
                            <button class="btn btn-primary" @click="switchVisibility(1, 'B')">Previous</button>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" @click="switchVisibility(1, 'F')">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /listening section -->

            <!-- reading section questions-->

            <div class="row" v-if="sectionsVisibility[2]">
                <div class="col-12">

                    <div class="row mb-5">
                        <div class="col-12">
                            <textarea-autosize class="form-control"
                                               ref="description"
                                               v-model="description"
                                               :min-height="30"
                                               :max-height="500"
                                               @blur.native="onBlurTextarea"
                            />
                        </div>
                    </div>
                    <div class="row" v-for="(question, index) in reading">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <strong>{{index+1}} - {{question.question}}</strong>
                                </div>
                            </div>
                            <div class="row" v-for="answer in question.ans" v-if="answer">
                                <div class="col-12">
                                    <div class="radio pl-4">
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
                    <div class="row mt-5">
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

                    <div class="row" v-for="(question, index) in ls">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <strong>{{index+1}} - {{question.question}}</strong>
                                </div>
                            </div>
                            <div class="row" v-for="answer in question.ans" v-if="answer">
                                <div class="col-12">
                                    <div class="radio pl-4">
                                        <label>
                                            <input type="radio" :value="answer" v-model="ls_answers[index]"
                                                   @change="answerLS(question,index)">
                                            {{answer}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header text-center mb-1">
                                    <div class="logo text-center">
                                        <img style="width:100px;height: 100px;" :src="logo" alt="asdasd">
                                    </div>
                                    <div>
                                        www.eitd-oman.com
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body" id="result">
                                    <h1 class="box-title text-center">English Level Certificate</h1>
                                    <div class="row text-center mb-5">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h4 class="mb-3">
                                                        Student: {{studentName}}
                                                    </h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 v-if="studentID" class="mb-3">
                                                        ID: {{studentID}}
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span>{{ new Date() | moment("dddd, MMMM Do YYYY - h:m") }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" style="margin: 0 auto; width: 450px;">
                                        <table class="table table-hover">
                                            <tr>
                                                <th></th>
                                                <th>Percentage</th>
                                            </tr>
                                            <tr>
                                                <td>Listening</td>
                                                <td>{{listeningResult}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Reading</td>
                                                <td>{{readingResult}}%</td>
                                            </tr>
                                            <tr>
                                                <td>Language System</td>
                                                <td>{{grammarResult}}%</td>
                                            </tr>
                                            <tr style="line-height:  50px;border-top: 1px solid;font-size: larger;font-weight: bold">
                                                <td>Overall</td>
                                                <td>{{overallResult}}%</td>
                                            </tr>
                                        </table>
                                        <div style="margin-top: 2px;background-color: #3579b4;width: 100%;text-align: center;margin-bottom: 30px;">
                                            <h2 id="level" style="-webkit-print-color-adjust: exact;color:white;background-color:#007bff; width: 100%" v-text="'Level ' +level"></h2>
                                        </div>
                                    </div>
                                    <barChart :data="dataset" :options="options" :styles="style"></barChart>
                                    <div style="margin-top: 50px;">
                                        <table class="table table-hover text-center" id="levels">
                                            <tr class="bg-primary">
                                                <th>Level</th>
                                                <th>One</th>
                                                <th>Two</th>
                                                <th>Three</th>
                                                <th>Four</th>
                                                <th>Five</th>
                                                <th>Advanced</th>
                                            </tr>
                                            <tr id="tableleveldown">
                                                <td>Scale</td>
                                                <td>0-40 %</td>
                                                <td>41-60 %</td>
                                                <td>61-70 %</td>
                                                <td>71-80 %</td>
                                                <td>81-90 %</td>
                                                <td>91-100 %</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>

                    <div class="row mt-5">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary no-print" @click="print()">Print</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /result section -->

        </div>

    </div>
</template>

<script>
    import BarChart from "./barChart";

    export default {
        components: {BarChart},
        data: () => {
            return {
                //ui visibility
                sectionsVisibility: [true, false, false, false, false],
                studentName: '',
                studentID: '',

                // getting question
                reading: [],
                listening: [],
                ls: [],
                audio: '',
                description: '',
                log: '',
                // readingGroup: null,
                // listeningGroup: null,


                // getting result
                reading_answers: [],
                listening_answers: [],
                ls_answers: [],
                level: 'One',
                readingResult: 0,
                listeningResult: 0,
                grammarResult: 0,
                overallResult: 0,

                // barchart
                options: {
                    barThickness: 10,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [{
                            barPercentage: 1,
                            categoryPercentage: 0.6,
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    tooltips: {
                        enabled: true,
                        mode: 'single',

                    },
                    responsive: true,
                    maintainAspectRatio: false,
                },
                dataset: {
                    labels: ['Listening', 'Reading', 'Language System'],
                    datasets: [
                        {
                            label: 'Student Result',
                            backgroundColor: 'blue',
                            data: [10, 18, 72]
                        },
                        {
                            label: 'Full Mark',
                            backgroundColor: 'red',
                            data: [10, 18, 72]
                        }
                    ]
                },
                style: {
                    height: '300px',
                    width: '400px',
                    margin: '0 auto'
                },
            }
        },
        methods: {
            switchVisibility(index, direction) {
                if (index == 3 && direction == 'F') {
                    this.showResult();
                }
                if (this.studentName != '') {
                    if (direction == 'F') {
                        this.$set(this.sectionsVisibility, index + 1, true)
                        this.$set(this.sectionsVisibility, index, false)
                    } else {
                        this.$set(this.sectionsVisibility, index - 1, true)
                        this.$set(this.sectionsVisibility, index, false)
                    }
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'error',
                        title: 'Enter your name'
                    })
                }
            },

            answerListening(question, index) {
                this.$set(question, 'choice', this.listening_answers[index]);
            },
            answerReading(question, index) {
                this.$set(question, 'choice', this.reading_answers[index]);
            },
            answerLS(question, index) {
                this.$set(question, 'choice', this.ls_answers[index]);
            },

            calcResult() {
                this.listening.forEach((q) => {
                    console.log(q)
                    if (q.choice == q.correct_answer) {
                        this.listeningResult += q.degree;
                    }
                });
                this.reading.forEach((q) => {
                    if (q.choice == q.correct_answer) {
                        this.readingResult += q.degree;
                    }
                });
                this.ls.forEach((q) => {
                    if (q.choice == q.correct_answer) {
                        this.grammarResult += q.degree;
                    }
                });

                this.overallResult += this.listeningResult + this.readingResult + this.grammarResult;

                if (this.overallResult > 0 && this.overallResult <= 40) {
                    this.level = 'One';
                } else if (this.overallResult > 40 && this.overallResult <= 60) {
                    this.level = 'Two';
                } else if (this.overallResult > 60 && this.overallResult <= 70) {
                    this.level = 'Three';
                } else if (this.overallResult > 70 && this.overallResult <= 80) {
                    this.level = 'Four';
                } else if (this.overallResult > 80 && this.overallResult <= 90) {
                    this.level = 'Five';
                } else if (this.overallResult > 90 && this.overallResult <= 100) {
                    this.level = 'Advanced';
                }
            },

            showResult() {
                this.calcResult();
                this.dataset.datasets[0].data[0] = this.listeningResult;
                this.dataset.datasets[0].data[1] = this.readingResult;
                this.dataset.datasets[0].data[2] = this.grammarResult;

            },

            print() {
                window.print();
            }
        },
        mounted() {
            window.axios.get(route('admin.test.generate')).then((res) => {
                this.reading = res.data.reading.questions;
                this.listening = res.data.listening.questions;
                this.ls = res.data.ls.questions;
                this.audio = res.data.audio;
                this.description = res.data.reading.description.description;
                // this.listeningGroup = res.data.listening;
                // this.readingGroup = res.data.reading;
                // shuffling answers
                this.reading.forEach(function (q) {
                    q.choice = null;
                    q.ans = [q.a1, q.a2, q.a3, q.correct_answer];
                    q.ans = _.shuffle(q.ans);
                });

                this.listening.forEach(function (q) {
                    q.choice = null;
                    q.ans = [q.a1, q.a2, q.a3, q.correct_answer];
                    q.ans = _.shuffle(q.ans);
                })

                this.ls.forEach(function (q) {
                    q.choice = null;
                    q.ans = [q.a1, q.a2, q.a3, q.correct_answer];
                    q.ans = _.shuffle(q.ans);
                })
            });
        }
    }
</script>
<style>
    @media print {
        #levels th {
            background-color: #007bff !important;
        }
    }
</style>