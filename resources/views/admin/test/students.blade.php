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
                                <th>Date</th>
                                <th>Overall</th>
                                <th>Reading</th>
                                <th>Listening</th>
                                <th>Language System</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach(\App\Test::all()->sortByDesc('created_at')  as $index=> $item)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$item['student_name']}}</td>
                                    <td>{{$item['student_id']}}</td>
                                    <td>{{$item['created_at']}}</td>
                                    <td>{{$item['ls'] + $item['reading'] + $item['listening']}}</td>
                                    <td>{{$item['reading']}}</td>
                                    <td>{{$item['listening']}}</td>
                                    <td>{{$item['ls']}}</td>
                                    <td>
                                        <a class="btn btn-success" target="_blank" href="{{route('admin.get.student.certificate', $item)}}"><i class="fa fa-print"></i></a>
                                    </td>
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
    <x-datatable id="sectionGroups" printHead="Students" cols="[0,1,2,3,4]"></x-datatable>
@endsection