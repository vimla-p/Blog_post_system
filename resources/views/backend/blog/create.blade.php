@extends('backend.layouts.master')

@section('content')

    @if (Auth::user()->role === 'user')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Blog</h1>
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
                                <div class="card-header">
                                    <h3 class="card-title">Add Blog</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('createblog') }}" enctype="multipart/form-data"
                                    id="BlogForm">
                                    @csrf
                                    @method('post')
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="exampleInputTitle">Title</label>
                                            <input type="text" class="form-control" id="exampleInputTitle" name="title"
                                                placeholder="Enter title">
                                            @error('title')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Category</label>
                                            <select class="select2bs4" multiple="multiple" id="exampleInputCategory"
                                                data-placeholder="Select a category" style="width: 100%;"
                                                name="category_ids[]">
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_ids[]')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputSlug">Slug</label>
                                            <input type="text" class="form-control" id="exampleInputSlug" name="slug"
                                                placeholder="enter slug">
                                            @error('slug')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    Description
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <textarea id="summernote" name="description">
                                                                                            
                                                </textarea>
                                                @error('description')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>

                                            <input type="file" class="form-control" name="image"
                                                id="exampleInputFile">
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
                $(function() {
                    // Summernote
                    $('#summernote').summernote()

                })
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
            </script>
            <script>
                $(document).ready(function() {
                    $('#exampleInputTitle').blur(function() {
                        $('#exampleInputSlug').val($('#exampleInputTitle').val().replace(/\s+/g, '-'));
                        // $('#exampleInputSlug').trigger('change');

                    });
                   
                    $.validator.addMethod("verifySlug",
                        function(element) {
                            var slug = $('#exampleInputSlug').val();
                            var result = false;
                            $.ajax({
                                type: "POST",
                                async: false,
                                url: '{{ route('createblogslug') }}',
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
                            return result;
                            // alert("RESULT " + result);
                        },

                    );

                    $("#BlogForm").validate({
                        rules: {
                            title: {
                                required: true,


                            },
                            'category_ids[]': {
                                required: true,
                            },
                            'slug': {
                                required: true,
                                verifySlug: true,
                            },
                            'description': {
                                required: true,
                            },
                            image: {
                                required: true
                            },
                        },
                        messages: {
                            title: {
                                required: "Please enter title...",
                            },
                            'category_ids[]': {
                                required: "Please select categories...",
                            },
                            'slug': {
                                required: "Please enter slug...",
                                verifySlug: "Slug already exists. try to another",
                            },
                            'description': {
                                required: "Please enter description...",
                            },
                            image: {
                                required: "Please select image...",
                            },
                        },
                    })

                });
            </script>
        @endsection
    @endif
@endsection
