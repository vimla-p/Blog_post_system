@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>List categories</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- {{ session('message') }} --}}

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
                                                            href="{{ route('addcategory') }}">Add
                                                            Category</a></span></button>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <form action="#" method="POST">
                                                <div class="input-group">
                                                    <input type="search" name="searchbar"
                                                        class="form-control form-control-md searchbar"
                                                        placeholder="Type your keywords here">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-md btn-default search">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    @if (session()->get('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered yajra-datatable"
                                                {{-- "table table-bordered table-striped dataTable dtr-inline " --}} aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">slug
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending">
                                                            is_active</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending">action
                                                        </th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    @foreach ($category as $item)
                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1" tabindex="0">
                                                                {{ $item->name }}</td>
                                                            <td>{{ $item->slug }}</td>
                                                            <td>
                                                                <input type="checkbox" data-id="{{ $item->id }}"
                                                                    name="is_active" class="js-switch"
                                                                    {{ $item->is_active == 1 ? 'checked' : '' }}>
                                                            </td>
                                                            <td><button class="btn buttons-copy buttons-html5"
                                                                    tabindex="0" aria-controls="example1"
                                                                    type="button"><span><a
                                                                            href='{{ route('fillcategory', [$item->slug]) }}'>
                                                                            <i class="fas fa-edit"></i></a></span></button>
                                                                <button class="btn buttons-copy buttons-html5"
                                                                    tabindex="0" aria-controls="example1"
                                                                    type="button"><span><a
                                                                            onclick="return confirm('Are you sure to delete?')"
                                                                            href="{{ route('deletecategory', [$item->id]) }}">
                                                                            <i class="fas fa-trash"></i></a></span></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                            {{-- {{ $dataTable->table() }} --}}

                                        </div>
                                    </div>

                                    {{ $category->links() }}
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
                "searching": false,
                "paging": false,
                "ordering": false,


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
                    url: '{{ route('changecategorystatus') }}',
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
    <script>
        $(document).ready(function() {
            $('.search').click(function() {
                let value = $('.searchbar').val();
                console.log(value);
                var table = $('#example1').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": false,
                    "paging": false,
                    ajax: {
                        url: '{{ route('searchcategory') }}',
                        dataType: "json",
                        data: {
                            value: value
                        },
                        complete: function() {
                            let elems = Array.prototype.slice.call(document.querySelectorAll(
                                '.js-switch'));

                            elems.forEach(function(html) {
                                let switchery = new Switchery(html, {
                                    size: 'small'
                                });
                            });

                            $('.js-switch').change(function() {
                                let status = $(this).prop('checked') === true ? 1 : 0;
                                let userId = $(this).data('id');
                                console.log(status, userId);
                                $.ajax({
                                    type: "GET",
                                    dataType: "json",
                                    url: '{{ route('changecategorystatus') }}',
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

                        }
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'slug',
                            name: 'slug'
                        },
                        {
                            data: 'is_active',
                            name: 'Isactive'
                        },
                        {
                            data: 'action',
                            name: 'Action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });


            });

            $('.sorting').click(function() {
                console.log($(this).text());
                value = $(this).text();
                var table = $('#example1').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": false,
                    "paging": false,
                    "ordering": false,

                    ajax: {
                        url: '{{ route('sortcategory') }}',
                        dataType: "json",
                        data: {
                            value: value
                        },
                        complete: function() {
                            let elems = Array.prototype.slice.call(document.querySelectorAll(
                                '.js-switch'));

                            elems.forEach(function(html) {
                                let switchery = new Switchery(html, {
                                    size: 'small'
                                });
                            });

                            $('.js-switch').change(function() {
                                let status = $(this).prop('checked') === true ? 1 : 0;
                                let userId = $(this).data('id');
                                console.log(status, userId);
                                $.ajax({
                                    type: "GET",
                                    dataType: "json",
                                    url: '{{ route('changecategorystatus') }}',
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

                        }
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'slug',
                            name: 'slug'
                        },
                        {
                            data: 'is_active',
                            name: 'Isactive'
                        },
                        {
                            data: 'action',
                            name: 'Action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });


            });



        });
    </script>
@endsection
@endsection
