@extends('backend.layouts.master')

@section('content')
    @if (Auth::user()->role == 'admin')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create User</h1>
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
                                <form method="post" action="{{ route('createuser') }}" enctype="multipart/form-data" id="UserForm">
                                    @csrf
                                    @method('post')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFirstName">First name</label>
                                            <input type="text" class="form-control" id="exampleInputFirstName"
                                                name="first_name" placeholder="Enter first name">
                                            {{-- @if (count($errors) > 0)
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif --}}
                                            @error('first_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputLastName">Last name</label>
                                            <input type="text" class="form-control" id="exampleInputLastName"
                                                name="last_name" placeholder="Enter last name">
                                            @error('last_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                name="email" placeholder="Enter email">
                                            @error('email')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputContact">Contact</label>
                                            <input type="tel" class="form-control" id="exampleInputContact"
                                                name="contact" placeholder="Enter contact number">
                                            @error('contact')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputImage">Image</label>
                                            <input type="file" class="form-control" name="image"
                                                id="exampleInputImage">
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
        @section('script')
        <script>
            $(document).ready(function() {
                if (("#UserForm").length > 0) {
                    $("#UserForm").validate({
                        rules: {
                            first_name: {
                                required: true,
                            },
                            last_name: {
                                required: true,
                            },
                            email: {
                                required: true,
                            },
                            contact: {
                                required: true,
                            },
                            image: {
                                required: true,
                            },
                        },
                        messages: {
                            first_name: {
                                required: "Please enter title...",
                            },
                            last_name: {
                                required: "Please select categories...",
                            },
                            email: {
                                required: "Please enter valid slug...",
                            },
                            contact: {
                                required: "Please enter description...",
                            },
                            image: {
                                required: "Please select image...",
                                
                            },
                        },
                    })
                }
            });
        </script>
            
        @endsection
    @endif
@endsection
