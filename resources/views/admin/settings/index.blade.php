@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12">
                <h3>Settings</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.settings.update', \App\Setting::MainSettings())}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="logo">Logo: </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="logo_temp" type="file" class="custom-file-input" id="logo">
                                                <label class="custom-file-label" for="logo">Choose file</label>
                                            </div>
                                            @if(\App\Setting::MainSettings()->logo)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <img class="img-thumbnail" style="width: 150px;height: 150px;" src="{{asset(\App\Setting::MainSettings()->logo)}}" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="time">Time: </label>
                                        <input type="number" name="time" id="time" class="form-control" step=".1" value="{{\App\Setting::MainSettings()->time}}">
                                        <x-error name="time"></x-error>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="time">Footer: </label>
                                        <textarea id="mymce" class="form-control" name="footer" id="footer" cols="30" rows="10">{{\App\Setting::MainSettings()->footer}}</textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="reading">Reading section default degree: </label>
                                        <input type="number" name="reading" id="reading" class="form-control" step=".1" value="{{\App\Models\Section::Reading()->degree}}">
                                        <x-error name="reading"></x-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="listening">Listening section default degree: </label>
                                        <input type="number" name="listening" id="listening" class="form-control" step=".1" value="{{\App\Models\Section::Listening()->degree}}">
                                        <x-error name="listening"></x-error>

                                    </div>
                                    <div class="form-group">
                                        <label for="ls">LS section default degree: </label>
                                        <input type="number" name="ls" id="ls" class="form-control" step=".1" value="{{\App\Models\Section::LS()->degree}}">
                                        <x-error name="ls"></x-error>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="maxreading">Max Reading section Group Question number: </label>
                                        <input type="number" name="maxreading" id="maxreading" class="form-control" step=".1" value="{{\App\Models\Section::Reading()->max}}">
                                        <x-error name="maxreading"></x-error>

                                    </div>
                                    <div class="form-group">
                                        <label for="maxlistening">Max Listening section Group Question number: </label>
                                        <input type="number" name="maxlistening" id="maxlistening" class="form-control" step=".1" value="{{\App\Models\Section::Listening()->max}}">
                                        <x-error name="maxlistening"></x-error>

                                    </div>
                                    <div class="form-group">
                                        <label for="maxls">Max LS section Group Question number: </label>
                                        <input type="number" name="maxls" id="maxls" class="form-control" step=".1" value="{{\App\Models\Section::LS()->max}}">
                                        <x-error name="maxls"></x-error>

                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('javascript')
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: "#mymce",
            height: 400,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
        });
    </script>
@endsection
