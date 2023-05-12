@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>List Users</h1>
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
                                                            href="{{ route('adduser') }}">Add User</a></span></button>

                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-12 col-md-4">
                                            <form>
                                                @csrf
                                                <div class="input-group">
                                                    <input type="search" class="form-control form-control-md searchbar "
                                                        placeholder="Type your keywords here">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-md btn-default search">
                                                            <i class="fa fa-search "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> --}}
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
                                            <table id="example1"
                                                class="table table-bordered table-striped dataTable dtr-inline"
                                                aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0"
                                                            aria-controls="example1" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="Rendering engine: activate to sort column descending">
                                                            first_name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            last_name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Contact</th>

                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending">role
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending">Image
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending">
                                                            Isactive
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $item)
                                                        <tr class="odd">

                                                            <td>{{ $item->first_name }}</td>
                                                            <td>{{ $item->last_name }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->contact }}</td>
                                                            <td>{{ $item->role }}</td>
                                                            {{-- <td>{{ $item->image }}</td> --}}
                                                            <td>
                                                                @if ($item->image)
                                                                    <img class="w-25 h-25"
                                                                        src="{{ asset("/storage/user/image/$item->image") }}"
                                                                        alt="{{ $item->image }}">
                                                                @else
                                                                    Image unavilable
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <input type="checkbox" data-id="{{ $item->id }}"
                                                                    name="status" class="js-switch" id='status'
                                                                    {{ $item->status == 1 ? 'checked' : '' }}>

                                                            </td>
                                                            <td><button class="btn  buttons-copy buttons-html5"
                                                                    tabindex="0" aria-controls="example1"
                                                                    type="button"><span><a
                                                                            href='{{ route('updateuser', [$item->id]) }}'>
                                                                            <i class="fas fa-edit"></i></a></span></button>
                                                                <button class="btn  buttons-copy buttons-html5"
                                                                    tabindex="0" aria-controls="example1"
                                                                    type="button"><span><a
                                                                            onclick="return confirm('Are you sure to delete?')"
                                                                            href="{{ route('deleteuser', [$item->id]) }}">
                                                                            <i
                                                                                class="fas fa-trash"></i></a></span></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    {{ $users->links() }}

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
            $('.search').click(function() {
                let value = $('.searchbar').val();
                $("#example1").DataTable().clear().destroy();
                var table = $('#example1').DataTable({
                    ajax: {
                        url: '{{ route('searchuser') }}',
                        type: 'GET',
                        data: {
                            'value': value
                        },
                        dataSrc: 'data',
                    },
                    columns: [
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'email' },
                        { data: 'contact' },
                        { data: 'role' },
                        { data: 'image_html' },
                        { data: 'status_html' },
                        { data: 'action_html' },

                    ],
                });
            });

            $('.js-switch').change(function() {
                console.log('changed');
                let status = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                console.log(status, userId);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('changeuserstatus') }}',
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

            
                // $('.search').click(function() {
                //     let value = $('.searchbar').val();
                //     $("#example1").DataTable().clear().destroy();
                //     var table = $('#example1').DataTable({
                        
                //         processing: true,
                //         serverSide: true,
                //         ajax: '{{ route('searchuser') }}',
                //         data: {
                //             'value': value
                //         },
                //         columns: [{
                //                 data: 'first_name',
                //                 name: 'first_name'
                //             },
                //             {
                //                 data: 'last_name',
                //                 name: 'last_name'
                //             },
                //             {
                //                 data: 'email',
                //                 name: 'email'
                //             },
                //             {
                //                 data: 'contact',
                //                 name: 'contact'
                //             },
                //             {
                //                 data: 'role',
                //                 name: 'role'
                //             },
                //             {
                //                 data: 'image_html',
                //                 name: 'image_html'
                //             },
                //             {
                //                 data: 'status_html',
                //                 name: 'status_html'
                //             },
                //             {
                //                 data: 'action_html',
                //                 name: 'action_html',
                //                 orderable: false,
                //                 searchable: false
                //             },
                //         ]
                //     });
                // });

           
        });
    </script>
@endsection
@endsection
<!-- Page specific script -->
{{-- $('.search').click(function() {
    let value = $('.searchbar').val();
    console.log(value);
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('searchuser') }}',
        data: {
            'value': value
        },
        success: function(data) {
            $("#example1").DataTable().clear().destroy();
            console.log(data);
            // $('tbody').html(response);
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                columns: [
                { data: 'first_name' },
                { data: 'last_name' },
                { data: 'email' },
                { data: 'contact' },
                { data: 'role' },
                { data: 'image' },
                { data: 'status' },
                
            ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
        },

        error: function(response) {}
    });
}); --}}
