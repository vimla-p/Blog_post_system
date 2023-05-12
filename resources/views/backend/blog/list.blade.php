@extends('backend.layouts.master')

@section('content')

    @if (Auth::user()->role == 'admin')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>List Blogs</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8">

                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <form action="simple-results.html">
                                                    <div class="input-group">
                                                        {{-- <input type="search" name="searchbar"
                                                            class="form-control form-control-md"
                                                            placeholder="Type your keywords here">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-md btn-default search">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <br>
                                        @if (session()->get('message'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session()->get('message') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <table id="example1"
                                                    class="table table-bordered table-striped dataTable dtr-inline"
                                                    aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="Rendering engine: activate to sort column descending">
                                                                user Id</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                title
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Category
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">slug
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                description</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                image</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                visited_count
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Isactive</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($blog as $item)
                                                            <tr class="odd">
                                                                <td>{{ $item->user_id }}</td>
                                                                <td>{{ $item->title }}</td>
                                                                <td>

                                                                    @foreach ($item->categories as $val)
                                                                        {{ $val->name }}
                                                                    @endforeach

                                                                </td>
                                                                <td>{{ $item->slug }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td>
                                                                    @if ($item->image)
                                                                        <img class="w-25 h-25"
                                                                            src="{{ asset("storage/blog/image/$item->image") }}"
                                                                            alt="{{ $item->image }}">
                                                                    @else
                                                                        Image unavilable
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->visited_count }}</td>
                                                                <td>
                                                                    <input type="checkbox" data-id="{{ $item->id }}"
                                                                        name="is_active" class="js-switch"
                                                                        {{ $item->is_active == 1 ? 'checked' : '' }}>
                                                                </td>
                                                                <td><button class="btn buttons-copy buttons-html5"
                                                                        tabindex="0" aria-controls="example1"
                                                                        type="button"><span><a
                                                                                href="{{ route('fillblog', [$item->slug]) }}">
                                                                                <i class="fas fa-edit">
                                                                                </i></a></span></button>
                                                                    <button class="btn buttons-copy buttons-html5"
                                                                        tabindex="0" aria-controls="example1"
                                                                        type="button"><span><a
                                                                                onclick="return confirm('Are you sure to delete?')"
                                                                                href="{{ route('deleteblog', [$item->id]) }}">
                                                                                <i class="fas fa-trash">
                                                                                </i></a></span></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{ $blog->links() }}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @section('script')
            <script>
                $(function() {
                    $("#example1").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "searching": true,
                        "paging": false,

                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                });
            </script>
            <script>
                let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        size: 'small'
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('.js-switch').change(function() {
                        let status = $(this).prop('checked') === true ? 1 : 0;
                        let userId = $(this).data('id');
                        console.log(status, userId);
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('changeblogstatus') }}',
                            data: {
                                'status': status,
                                'id': userId,
                                'is_active': status
                            },
                            success: function(data) {
                                console.log(data.message);
                                alert(data.message);
                            }
                        });
                    });
                });
            </script>
            {{-- <script>
                $(document).ready(function() {
                    $('.search').click(function() {
                        let value = $('.searchbar').val();
                        console.log(value);
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('searchblog') }}',
                            data: {
                                'value': value
                            },
                            success: function(response) {
                                // console.log(response);
                                alert("okay");
                                $('tbody').html(response);
                            },
                            error: function(response) {
                                console.log(response);
                                // alert("okay");
                                $('tbody').html(response);
                            }
                        });
                    });
                });
            </script> --}}
        @endsection
    @else
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>List Blogs</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8">
                                                <div class="dt-buttons btn-group flex-wrap"> <button
                                                        class="btn border buttons-copy buttons-html5" tabindex="0"
                                                        aria-controls="example1" type="button"><span><a
                                                                href="{{ route('create') }}">Add
                                                                Blog</a></span></button>

                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <form>
                                                    @csrf
                                                    <div class="input-group">
                                                        {{-- <input type="search"
                                                            class="form-control form-control-md searchbar "
                                                            placeholder="Type your keywords here">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-md btn-default search">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <br>
                                        @if (session()->get('message'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session()->get('message') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <table id="example1"
                                                    class="table table-bordered table-striped dataTable dtr-inline"
                                                    aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                title
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Category
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                slug
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                description</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Engine version: activate to sort column ascending">
                                                                image</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                visited_count
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Isactive</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                                rowspan="1" colspan="1"
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($blog as $key => $item)
                                                            <tr class="odd">
                                                                <td>{{ $item->title }}</td>
                                                                <td>

                                                                    @foreach ($item->categories as $val)
                                                                        {{ $val->name }}
                                                                    @endforeach

                                                                </td>
                                                                <td>{{ $item->slug }}</td>
                                                                <td>{!! $item->description !!}</td>
                                                                <td>
                                                                    @if ($item->image)
                                                                        <img class="w-25 h-25"
                                                                            src="{{ asset("/storage/blog/image/$item->image") }}"
                                                                            alt="{{ $item->image }}">
                                                                    @else
                                                                        Image unavilable
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->visited_count }}</td>
                                                                <td>
                                                                    <input type="checkbox" data-id="{{ $item->id }}"
                                                                        name="is_active" class="js-switch"
                                                                        {{ $item->is_active == 1 ? 'checked' : '' }}
                                                                        disabled>
                                                                </td>
                                                                <td><button class="btn buttons-copy buttons-html5"
                                                                        tabindex="0" aria-controls="example1"
                                                                        type="button"><span><a
                                                                                href="{{ route('fillblog', [$item->slug]) }}">
                                                                                <i
                                                                                    class="fas fa-edit"></i></a></span></button>
                                                                    <button class="btn buttons-copy buttons-html5"
                                                                        tabindex="0" aria-controls="example1"
                                                                        type="button"><span><a
                                                                                href="{{ route('deleteblog', [$item->id]) }}">
                                                                                <i
                                                                                    class="fas fa-trash"></i></a></span></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                </table>
                                            </div>
                                        </div>

                                        {{ $blog->links() }}
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @section('script')
            <script>
                $(function() {
                    $("#example1").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "searching": true,
                        "paging": false,

                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                });
            </script>
            <script>
                let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        size: 'small'
                    });
                });
            </script>
        @endsection
    @endif
@endsection


