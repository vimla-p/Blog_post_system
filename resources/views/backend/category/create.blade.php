@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Category</h1>
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
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="post" action="{{ route('createcategory') }}" id="categoryForm">
                                @csrf
                                @method('post')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Name</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="name"
                                            placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputSlug">Slug</label>
                                        <input type="text" class="form-control" id="exampleInputSlug" name="slug"
                                            placeholder="slug">
                                        @error('slug')
                                            <span class="text-danger" id="slugerror">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                var result = false; 
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '{{ route('createslug') }}',
                    data: {
                        'slug': slug,
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
            let slug = $('#exampleInputSlug').val();
            if (("#categoryForm").length > 0) {
                $("#categoryForm").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        slug: {
                            required: true,
                            verifySlug: true,
                            // remote: {
                            //     url: '{{ route('createslug') }}',
                            //     type: "post",
                            //     data: {
                            //         'slug': $(slug).val(),
                            //         _token: "{{ csrf_token() }}"
                            //     },
                            //     dataFilter: function(data) {
                            //         var json = JSON.parse(data);
                            //         if (json.msg == "true") {
                            //             // $('#exampleInputSlug').val('');
                            //             return "\"" + "Slug already exists" + "\"";
                            //         } else {
                            //             $('#exampleInputSlug').val(json.msg);
                            //         }
                            //     }
                            // },
                        },
                    },
                    messages: {
                        name: {
                            required: "Please enter title...",
                        },
                        slug: {
                            required: "Please enter slug...",
                            verifySlug: "Slug already exists. try to another",
                        },
                    },
                })
            }
        });
    </script>
@endsection
@endsection
