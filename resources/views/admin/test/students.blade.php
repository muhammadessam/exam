@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">

                    <div class="card-body overflow-auto">
                        <table id="sectionGroups" class="table-striped table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Student name</th>
                                <th>Question ID</th>
                                <th>Reading</th>
                                <th>Listening</th>
                                <th>Language System</th>
                                <th>Overall</th>
                            </tr>
                            </thead>
                            @foreach(\App\Test::all()->sortByDesc('created_at')  as $index=> $item)
                                <tr>
                                    <th>{{$index + 1}}</th>
                                    <th>{{$item['student_name']}}</th>
                                    <th>{{$item['student_id']}}</th>
                                    <th>{{$item['reading']}}</th>
                                    <th>{{$item['listening']}}</th>
                                    <th>{{$item['ls']}}</th>
                                    <th>{{$item['ls'] + $item['reading'] + $item['listening']}}</th>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <x-datatable id="sectionGroups"></x-datatable>
@endsection