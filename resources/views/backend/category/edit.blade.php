@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('updatecategory', [$data->slug]) }}" id="categoryForm">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="exampleInputId" name="id"
                                        value="{{ $data->id }}">

                                    <div class="form-group">
                                        <label for="exampleInputName">Name</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="name"
                                            value="{{ $data->name }}" placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputSlug">Slug</label>
                                        <input type="text" class="form-control" id="exampleInputSlug" name="slug"
                                            value="{{ $data->slug }}" placeholder="slug">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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

            $('#exampleInputName').blur(function() {
                $('#exampleInputSlug').val($('#exampleInputName').val().replace(/\s+/g, '-'));
               

            });

         

            $.validator.addMethod("verifySlug",
                function( element) {
                var slug = $('#exampleInputSlug').val();
                var id = $('#exampleInputId').val()
                var result = false; 
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '{{ route('editslug') }}',
                    data: {
                        'slug': slug,
                        'id' : id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        result = (data.msg == true) ? true : false;
                        if (result == true) {
                            $('#exampleInputSlug').val(data.data);
                        }
                        console.log(data);
                    }
                });
                // return true if username is exist in database
                return result; alert("RESULT " + result);
                },

            );

          
        });
    </script>
    <script>
        $(document).ready(function() {
            if (("#categoryForm").length > 0) {
                $("#categoryForm").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        slug: {
                            required: true,
                            verifySlug: true,
                        },
                    },
                    messages: {
                        name: {
                            required: "Please enter title...",
                        },
                        slug: {
                            required: "Please enter slug...",
                            verifySlug: "This slug is already exists. Try to another.",
                        },
                    },
                })
            }
        });
    </script>
@endsection
@endsection
