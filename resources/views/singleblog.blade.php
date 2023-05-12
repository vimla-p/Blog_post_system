<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Forest Time - Stylish Magazine Blog Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="{{ asset('assets/frontend/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('assets/frontend/style.css') }}" rel="stylesheet">

<!-- Responsive styles for this template -->
<link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">

<!-- Colors for this template -->
<link href="{{ asset('assets/frontend/css/colors.css') }}" rel="stylesheet">

<!-- Version Garden CSS for this template -->
<link href="{{ asset('assets/frontend/css/version/garden.css') }}" rel="stylesheet">



</head>

<body>

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form class="form-inline">
                        <input type="text" class="form-control" placeholder="What you are looking for?">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">

                    </div><!-- end col -->

                    <div class="col-lg-4 hidden-md-down">
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->


        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">

                            <div class="blog-title-area">

                                @foreach ($blog->categories as $item)
                                    {{ $item->name.',' }}
                                    
                                @endforeach

                                <h3>{{ $blog->title }}</h3>

                                <div class="blog-meta big-meta">
                                    <small>{{ $blog->created_at->format('d M, Y') }}</small>
                                    <small>by {{ $blog->users->first_name }}</small>
                                    <small><i class="fa fa-eye"></i> {{ $blog->visited_count }}</small>
                                </div><!-- end meta -->


                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="{{ asset("/storage/blog/image/$blog->image") }}" alt="{{ $blog->image }}"
                                    class="img-fluid">
                            </div><!-- end media -->
                            <div class="div">
                                {{ $blog->description }}<hr>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae voluptatibus perspiciatis, quos, quis eaque doloribus quo incidunt aspernatur minima explicabo iusto. Quas consequatur soluta explicabo quam ut ea voluptatum eligendi?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi minima officia necessitatibus quisquam, vero a possimus asperiores distinctio culpa, atque hic neque itaque aspernatur et fugit impedit nihil. Sed sint, doloribus perspiciatis rerum sit hic, ad id possimus accusantium animi odit tenetur! Earum aut quis perspiciatis nesciunt cumque aliquid nostrum repellat illum dolor laborum sed aperiam laudantium neque, saepe unde eum cupiditate autem? Sunt facilis quis, illo doloribus ipsa est quibusdam id. Nulla praesentium dignissimos excepturi iusto assumenda dolorem magnam vel unde accusantium consequatur rem voluptatibus totam voluptas libero nostrum eius consectetur nesciunt quaerat, necessitatibus officiis quae deleniti quia! Explicabo!
                            </div>

                            
                            <hr class="invis1">

                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->


                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-white">
                        @copyright Blog Post System-2023.
                    </div><!-- end col -->
                </div>

            </div><!-- end container -->
        </footer><!-- end footer -->



    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    {{-- <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/frontend/js/tether.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/custom.js') }}"></script>

</body>

</html>
