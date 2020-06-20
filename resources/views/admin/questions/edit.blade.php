@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row no-print">
            <div class="col-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <h3>Add new question</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.questions.update', $question)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <input type="text" name="question" id="question" class="form-control" placeholder="Enter question ..." value="{{$question->question}}">
                                <x-error name="question"></x-error>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="a1" id="question" class="form-control" placeholder="First answer is required ..." value="{{$question['a1']}}">
                                        <x-error name="a1"></x-error>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="a2" id="question" class="form-control" placeholder="Second answer not required ..." value="{{$question['a2']}}">
                                        <x-error name="a2"></x-error>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="a3" id="question" class="form-control" placeholder="Third answer not required ..." value="{{$question['a3']}}">
                                        <x-error name="a3"></x-error>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="correct_answer" id="question" class="form-control" placeholder="Correct answer is required ..." value="{{$question['correct_answer']}}">
                                        <x-error name="correct_answer"></x-error>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="number" step=".1" name="degree" id="degree" class="form-control" value="{{$question['degree']}}" placeholder="If you want to override the default degree for the section ...">
                                    </div>
                                    <x-error name="degree"></x-error>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection