<head>
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
    <link href="style.css" rel="stylesheet">

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
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/home') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
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

        <div class="header-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo">
                            <img src="{{ asset('/storage/blog/image/download (1).png') }}" alt=""
                                style="height:100px;">
                        </div><!-- end logo -->
                    </div>
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->

        <section class="section first-section">
            <div class="container-fluid">
                <div class="masonry-blog clearfix">
                    @foreach ($data as $item)
                        <div class="left-side">
                            <div class="masonry-box post-media">

                                <img src="{{ asset("/storage/blog/image/$item->image") }}" alt=""
                                    class="img-fluid" style="height:400px;">

                                <div class="shadoweffect">
                                    <div class="shadow-desc">
                                        <div class="blog-meta">

                                            @foreach ($item->categories as $cat)
                                                <span class="bg-aqua">{{ $cat->name }}</span>
                                            @endforeach

                                            <h4><a href="{{ route('blog', [$item->id]) }}"
                                                    title="">{{ $item->title }}</a>
                                            </h4>
                                            <small class="text-white">{{ $item->created_at->format('d M, Y') }}</small>
                                            <small class="text-white">
                                                @if ($item->users)
                                                    {{ $item->users->first_name . ' ' . $item->users->last_name }}
                                                @endif
                                            </small>
                                        </div><!-- end meta -->
                                    </div><!-- end shadow-desc -->
                                </div><!-- end shadow -->
                            </div><!-- end post-media -->
                        </div><!-- end left-side -->
                    @endforeach


                </div><!-- end masonry -->
            </div>
        </section>

        <section class="section wb">
            <div class="container-fluid">
                <div class="row">
