@extends('backend.layouts.master')

@section('content')

    @if (Auth::user()->role == 'admin')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Blog</h1>
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
                                <form method="post" action="{{ route('updateblog', $data->slug) }}"
                                    enctype="multipart/form-data" id="BlogForm">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" id="exampleInputId" name="id"
                                            value="{{ $data->id }}">

                                        <div class="form-group">
                                            <label for="exampleInputTitle">Title</label>
                                            <input type="text" class="form-control" id="exampleInputTitle" name="title"
                                                value="{{ $data->title }}" placeholder="Enter title">
                                            @error('title')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                                                style="width: 100%;" name="category_ids[]">

                                                @foreach ($data->categories as $key => $val)
                                                    <option value="{{ $val->id }}" selected>
                                                        {{ $val->name }}</option>
                                                @endforeach

                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_ids')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputSlug">Slug</label>
                                            <input type="text" class="form-control" id="exampleInputSlug" name="slug"
                                                value="{{ $data->slug }}" placeholder="slug">
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
                                           {{ $data->description }}
                                          </textarea>
                                                @error('description')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>

                                            <input type="file" class="form-control" name="image" id="exampleInputFile"
                                                value="{{ asset("/storage/blog/image/$data->image") }}">
                                            <br>
                                            <img class="w-25 h-25" id="BlogImage"
                                                src="{{ asset("/storage/blog/image/$data->image") }}"
                                                alt="{{ $data->image }}">
                                            {{ $data->image }}
                                            @error('image')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

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
                
                    });



                    $.validator.addMethod("verifySlug",
                        function(element) {
                            var slug = $('#exampleInputSlug').val();
                            var id = $('#exampleInputId').val()
                            var result = false;
                            $.ajax({
                                type: "POST",
                                async: false,
                                url: '{{ route('editblogslug') }}',
                                data: {
                                    'slug': slug,
                                    'id': id,
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
                            alert("RESULT " + result);
                        },

                    );


                    if (("#BlogForm").length > 0) {
                        $("#BlogForm").validate({
                            rules: {
                                title: {
                                    required: true,
                                },
                                'category_ids[]': {
                                    required: true,
                                },
                                slug: {
                                    required: true,
                                    verifySlug: true,
                                },
                                'description': {
                                    required: true,
                                },
                                image: {

                                },
                            },
                            messages: {
                                title: {
                                    required: "Please enter title...",
                                },
                                'category_ids[]': {
                                    required: "Please select categories...",
                                },
                                slug: {
                                    required: "Please enter valid slug...",
                                    verifySlug: "Slug already exists. try to another",
                                },
                                'description': {
                                    required: "Please enter description...",
                                },
                                image: {

                                },
                            },
                        })
                    }
                });
            </script>
        @endsection
    @else
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Blog</h1>
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
                                    <h3 class="card-title">Quick Example</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                              
                                <form method="post" action="{{ route('updateblog', [$data->slug]) }}"
                                    enctype="multipart/form-data" id="BlogForm">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" id="exampleInputId" name="id"
                                            value="{{ $data->id }}">

                                        <div class="form-group">
                                            <label for="exampleInputTitle">Title</label>
                                            <input type="text" class="form-control" id="exampleInputTitle" name="title"
                                                value="{{ $data->title }}" placeholder="Enter title">
                                            @error('title')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="select2bs4" multiple="multiple"
                                                data-placeholder="Select a State" style="width: 100%;"
                                                name="category_ids[]">

                                                @foreach ($data->categories as $key => $val)
                                                    <option value="{{ $val->id }}" selected>
                                                        {{ $val->name }}</option>
                                                @endforeach

                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_ids')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputSlug">Slug</label>
                                            <input type="text" class="form-control" id="exampleInputSlug"
                                                name="slug" value="{{ $data->slug }}" placeholder="slug">
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
                                                    {{ $data->description }}</textarea>

                                            </div>
                                            @error('description')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>

                                            <input type="file" class="form-control" name="image"
                                                id="exampleInputFile"
                                                value="{{ asset("/storage/blog/image/$data->image") }}"><br>
                                            <img class="w-25 h-25" id="imageUpload"
                                                src="{{ asset("/storage/blog/image/$data->image") }}"
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
                        $('#exampleInputSlug').trigger('change');
                    });


                    $.validator.addMethod("verifySlug",
                        function(element) {
                            var slug = $('#exampleInputSlug').val();
                            var id = $('#exampleInputId').val()
                            var result = false;
                            $.ajax({
                                type: "POST",
                                async: false,
                                url: '{{ route('editblogslug') }}',
                                data: {
                                    'slug': slug,
                                    'id': id,
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
                            alert("RESULT " + result);
                        },

                    );

                    if (("#BlogForm").length > 0) {
                        $("#BlogForm").validate({
                            rules: {
                                title: {
                                    required: true,
                                },
                                'category_ids[]': {
                                    required: true,
                                },
                                slug: {
                                    required: true,
                                    verifySlug: true,
                                },
                                'description': {
                                    required: true,
                                },
                                image: {

                                },
                            },
                            messages: {
                                title: {
                                    required: "Please enter title...",
                                },
                                'category_ids[]': {
                                    required: "Please select categories...",
                                },
                                slug: {
                                    required: "Please enter valid slug...",
                                    verifySlug: "This slug is already exists. Try to another.",
                                },
                                'description': {
                                    required: "Please enter description...",
                                },
                                image: {

                                },
                            },
                        })
                    }
                });
            </script>
        @endsection
    @endif
@endsection
