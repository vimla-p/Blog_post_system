@extends('backend.layouts.master')

@section('content')
    {{-- {{$data}} --}}
    @if (Auth::user()->role == 'admin')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit profile</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-2"></div>

                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">

                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('updateusertable', [$data->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">First name</label>
                                            <input type="text" class="form-control" id="exampleInputFirstName"
                                                name="first_name" value="{{ $data->first_name }}"
                                                placeholder="Enter first name">
                                            @error('first_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputLastName">Last name</label>
                                            <input type="text" class="form-control" id="exampleInputLastName"
                                                name="last_name" value="{{ $data->last_name }}"
                                                placeholder="Enter last name">
                                            @error('last_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                name="email" value="{{ $data->email }}" placeholder="Enter email"
                                                >
                                            @error('email')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputContact">Contact</label>
                                            <input type="tel" class="form-control" id="exampleInputContact"
                                                name="contact" value="{{ $data->contact }}"
                                                placeholder="Enter contact number">
                                            @error('contact')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>

                                            <input type="file" class="form-control" name="image" id="exampleInputFile" value="{{ asset("/storage/user/image/$data->image") }}">
                                            <img class="w-25 h-25" id="BlogImage"
                                                src="{{ asset("/storage/user/image/$data->image") }}"
                                                alt="{{ $data->image }}">
                                            {{ $data->image }}
                                            @error('image')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->


                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    @else
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('userdash') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item active"></li> --}}
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-2"></div>

                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">

                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('updateusertable', [$data->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">First name</label>
                                            <input type="text" class="form-control" id="exampleInputFirstName"
                                                name="first_name" value="{{ $data->first_name }}"
                                                placeholder="Enter first name">
                                            @error('first_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputLastName">Last name</label>
                                            <input type="text" class="form-control" id="exampleInputLastName"
                                                name="last_name" value="{{ $data->last_name }}"
                                                placeholder="Enter last name">
                                            @error('last_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                name="email" value="{{ $data->email }}" placeholder="Enter email"
                                                >
                                            @error('email')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputContact">Contact</label>
                                            <input type="tel" class="form-control" id="exampleInputContact"
                                                name="contact" value="{{ $data->contact }}"
                                                placeholder="Enter contact number">
                                            @error('contact')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>

                                            <input type="file" class="form-control" name="image"
                                                id="exampleInputFile" value="{{ asset("/storage/user/image/$data->image") }}"><br>
                                                <img class="w-25 h-25" id="BlogImage"
                                                src="{{ asset("/storage/user/image/$data->image") }}"
                                                alt="{{ $data->image }}">
                                            {{ $data->image }}
                                            @error('image')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->


                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    @endif
@endsection
