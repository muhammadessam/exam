@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row mb-5">
                            <div class="col-12">
                                <form action="{{route('admin.groups.store')}}" method="post" class="form-inline d-flex justify-content-between">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="section_id" value="{{$section['id']}}">
                                        <input type="text" name="name" id="" class="form-control" placeholder="New group name ..">
                                    </div>
                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h3>{{$section->name}} Groups</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto">
                        <table id="sectionGroups" class="table-striped table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Question number</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($section->groups  as $index=> $item)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td><div class="badge badge-success">{{$item->questions->count()}}</div></td>
                                    <td class="d-flex">
                                        <a class="btn btn-info" href="{{route('admin.groups.show', $item)}}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-primary d-inline ml-2" href="{{route('admin.groups.edit', $item)}}"><i class="fa fa-edit"></i></a>
                                        <form action="{{route('admin.groups.destroy', $item)}}" method="post" class="form-inline ml-2" onsubmit="return confirm('Are you sure ? ')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
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
    <x-datatable id="sectionGroups"></x-datatable>
@endsection