@extends('admin.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{\App\Models\Section::readingSection()->groups()->count()}}</h3>
                                    <p>Reading Section Groups</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="{{route('admin.sections.show', \App\Models\Section::readingSection())}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{\App\Models\Section::listeningSection()->groups()->count()}}</h3>
                                    <p>Reading Section Groups</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-headphones"></i>
                                </div>
                                <a href="{{route('admin.sections.show', \App\Models\Section::listeningSection())}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{\App\Models\Section::lsSection()->groups()->count()}}</h3>
                                    <p>Reading Section Groups</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <a href="{{route('admin.sections.show', \App\Models\Section::lsSection())}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection