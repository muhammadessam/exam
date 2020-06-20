@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row mb-5">
                            <div class="col-12">
                                <form action="{{route('admin.groups.update', $group)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <input type="text" name="name" id="" class="form-control" value="{{$group['name']}}">
                                    </div>
                                    <button class="btn btn-success" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <x-datatable id="sectionGroups"></x-datatable>
@endsection