@extends('backend.layouts.master')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    @if (Auth::user()->role == 'admin')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $countCategory }}</h3>

                                    <p>Total Categories</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('listcategory') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $countBlog }}<sup style="font-size: 20px"></sup></h3>

                                    <p>Total Blogs</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ route('listblog') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $countUser }}</h3>

                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('listuser') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">

                        <!-- Main content -->

                        <div class="container-fluid">
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
                                                                <h4>Pending Blogs</h4>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4">

                                                                {{-- <div class="input-group">
                                                                    <input type="search" name="search"
                                                                        class="form-control form-control-md"
                                                                        placeholder="Type your keywords here">
                                                                    <div class="input-group-append">
                                                                        <button type="submit" id="search"
                                                                            class="btn btn-md btn-default">
                                                                            <i class="fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div> --}}

                                                            </div>
                                                        </div>
                                                        <br>
                                                        @if (session()->get('message'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
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
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1" aria-sort="ascending"
                                                                                aria-label="Rendering engine: activate to sort column descending">
                                                                                user Id</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Browser: activate to sort column ascending">
                                                                                title
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Browser: activate to sort column ascending">
                                                                                Categories
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Browser: activate to sort column ascending">
                                                                                slug
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                                description</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Engine version: activate to sort column ascending">
                                                                                image path</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                                visited_count
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                                Isactive</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                                Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data as $item)
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
                                                                                    <input type="checkbox"
                                                                                        data-id="{{ $item->id }}"
                                                                                        name="is_active" class="js-switch"
                                                                                        {{ $item->is_active == 1 ? 'checked' : '' }}>
                                                                                </td>
                                                                                <td><button
                                                                                        class="btn buttons-copy buttons-html5"
                                                                                        tabindex="0"
                                                                                        aria-controls="example1"
                                                                                        type="button"><span><a
                                                                                                href="{{ route('fillblog', [$item->slug]) }}">
                                                                                                <i
                                                                                                    class="fas fa-edit"></i></a></span></button>
                                                                                    <button
                                                                                        class="btn buttons-copy buttons-html5"
                                                                                        tabindex="0"
                                                                                        aria-controls="example1"
                                                                                        type="button"><span><a
                                                                                                href="{{ route('deleteblog', [$item->id]) }}"><i
                                                                                                    class="fas fa-trash"></i></a></span></button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach


                                                                        </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        {{ $data->links() }}
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
                        </div>
                        <!-- /.container-fluid -->

                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @section('script')
            <script>
                let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        size: 'small'
                    });
                });

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
                $(document).ready(function() {
                    $('.js-switch').change(function() {
                        let status = $(this).prop('checked') === true ? 1 : 0;
                        let userId = $(this).data('id');
                        console.log(status, userId);
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('changestatus') }}',
                            data: {
                                'status': status,
                                'id': userId,
                                'is_active': status
                            },
                            success: function(data) {
                                console.log(data.message);
                            }
                        });
                    });
                });
            </script>
        @endsection
    @else
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">

                        <!-- Main content -->

                        <div class="container-fluid">
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
                                                                <h4>Approved Blogs</h4>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4">
                                                                <div id="example1_filter" class="dataTables_filter">
                                                                    <form>
                                                                        @csrf
                                                                        <div class="input-group">
                                                                            {{-- <input type="search"
                                                                                class="form-control form-control-md searchbar "
                                                                                placeholder="Type your keywords here">
                                                                            <div class="input-group-append">
                                                                                <button type="submit"
                                                                                    class="btn btn-md btn-default search">
                                                                                    <i class="fa fa-search"></i>
                                                                                </button>
                                                                            </div> --}}
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        @if (session()->get('message'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
                                                                {{ session()->get('message') }}
                                                                <button type="button" class="close"
                                                                    data-dismiss="alert" aria-label="Close">
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

                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Browser: activate to sort column ascending">
                                                                                title
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Browser: activate to sort column ascending">
                                                                                Categories
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Browser: activate to sort column ascending">
                                                                                slug
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Platform(s): activate to sort column ascending">
                                                                                description</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Engine version: activate to sort column ascending">
                                                                                image path</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                                visited_count
                                                                            </th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                                Isactive</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                                Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if ($data)
                                                                            @foreach ($data as $key => $item)
                                                                                @if ($data[$key] != null)
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
                                                                                            <input type="checkbox"
                                                                                                data-id="{{ $item->id }}"
                                                                                                name="is_active"
                                                                                                class="js-switch"
                                                                                                {{ $item->is_active == 1 ? 'checked' : '' }}
                                                                                                disabled>
                                                                                        </td>
                                                                                        <td><button
                                                                                                class="btn buttons-copy buttons-html5"
                                                                                                tabindex="0"
                                                                                                aria-controls="example1"
                                                                                                type="button"><span><a
                                                                                                        href="{{ route('fillblog', [$item->slug]) }}">
                                                                                                        <i
                                                                                                            class="fas fa-edit"></i></a></a></span></button>
                                                                                            <button
                                                                                                class="btn buttons-copy buttons-html5"
                                                                                                tabindex="0"
                                                                                                aria-controls="example1"
                                                                                                type="button"><span><a
                                                                                                        href="{{ route('deleteblog', [$item->id]) }}">
                                                                                                        <i
                                                                                                            class="fas fa-trash"></i></a></span></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    {{-- @endforeach --}}
                                                                                @endif
                                                                            @endforeach
                                                                        @endif

                                                                    </tbody>
                                                                    <tfoot>
                                                                        {{-- {{ $data->links() }} --}}

                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
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
                        </div>
                        <!-- /.container-fluid -->

                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @section('script')
            <script>
                let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        size: 'small'
                    });
                });

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
                $(document).ready(function() {
                    $('.js-switch').change(function() {
                        let status = $(this).prop('checked') === true ? 1 : 0;
                        let userId = $(this).data('id');
                        console.log(status, userId);
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('userdash') }}',
                            data: {
                                'status': status,
                                'id': userId,
                                'is_active': status
                            },
                            success: function(data) {
                                console.log(data.message);
                            }
                        });
                    });
                });
            </script>
        @endsection
    @endif
@endsection
