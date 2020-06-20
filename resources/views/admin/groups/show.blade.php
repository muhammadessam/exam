@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row no-print">
            <div class="col">
                <div class="card card-default mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Add new Question</h3>

                        <div class="card-tools no-print">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.questions.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                            <div class="form-group">
                                <input type="text" name="question" id="question" class="form-control" placeholder="Enter question ...">
                                <x-error name="question"></x-error>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="a1" id="question" class="form-control" placeholder="First answer is required ...">
                                        <x-error name="a1"></x-error>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="a2" id="question" class="form-control" placeholder="Second answer not required ...">
                                        <x-error name="a2"></x-error>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="a3" id="question" class="form-control" placeholder="Third answer not required ...">
                                        <x-error name="a3"></x-error>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="correct_answer" id="question" class="form-control" placeholder="Correct answer is required ...">
                                        <x-error name="correct_answer"></x-error>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="number" step=".1" name="degree" id="degree" class="form-control" placeholder="If you want to override the default degree for the section ...">
                                    </div>
                                    <x-error name="degree"></x-error>
                                </div>
                            </div>
                            <div class="form-group card-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add new</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if($group->section->name == 'Reading')
                <div class="col" id="descriptionDiv">
                    <div class="card card-default mt-3" id="readingdescription">
                        <div class="card-header">
                            <h3 class="card-title">Reading</h3>
                            <div class="card-tools no-print">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.description.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="group_id" value="{{$group['id']}}">
                                <div class="form-group">
                                    <textarea class="form-control" rows="8" name="description" id="desc">{{$group->description ? $group->description->description : ''}}</textarea>
                                    <x-error name="description"></x-error>
                                </div>
                                <div class="form-group no-print">
                                    <div class="card-footer">
                                        <button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-save"></i> Update</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif($group->section->name == 'Listening')
                <div class="col no-print">
                    <div class="card card-default mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Audio</h3>
                            <div class="card-tools no-print">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($group->audio()->exists())
                                <div class="row text-center mb-5">
                                    <div class="col-12">
                                        <audio controls>
                                            <source src="{{asset($group->audio->path)}}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>
                            @endif
                            <form action="{{route('admin.audio.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$group->id}}" name="group_id">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="audio">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                                <x-error name="audio"></x-error>
                                <div class="mt-5 form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-success mt-1">
                    <div class="card-header">
                        <h3 class="card-title">{{$group->section->name}} - {{$group->name}} - Questions</h3>

                        <div class="card-tools">
                            <a href="{{route('admin.sections.show', $group->section)}}" type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-list-ul"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <table id="sectionGroups" class="table-striped table">
                        <thead>
                        <tr>
                            <th>Question</th>
                            <th>Answer 1</th>
                            <th>Answer 2</th>
                            <th>Answer 3</th>
                            <th>Correct Answer</th>
                            <th>Degree</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @foreach($group->questions  as $item)
                            <tr>
                                <td>{{$item->question}}</td>
                                <td>{{$item->a1}}</td>
                                <td>{{$item->a2}}</td>
                                <td>{{$item->a3}}</td>
                                <td>{{$item->correct_answer}}</td>
                                <td>{{$item->degree}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-primary d-inline ml-2" href="{{route('admin.questions.edit', $item)}}"><i class="fa fa-edit"></i></a>
                                    <form action="{{route('admin.questions.destroy', $item)}}" method="post" class="form-inline ml-2" onsubmit="return confirm('Are you sure ? ')">
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
    <x-datatable id="sectionGroups" printHead="{{$group->section->name}} - {{$group->name}} - Questions"></x-datatable>
    <script>
        let description = $('#readingdescription');

    </script>
@endsection