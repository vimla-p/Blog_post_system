<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        {{-- <div class="widget">
            <h2 class="widget-title">Search</h2>
            <form class="form-inline search-form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search on the site">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
        </div><!-- end widget --> --}}

        <div class="widget">
            <h2 class="widget-title">Popular Blogs</h2>
            <div class="link-widget">
                <ul>

                    @foreach ($category as $item)
                        <li> {{ $item->title }}<span>({{ $item->views }})</span></li>
                        {{-- <li> {{ $item->title }}
                            <span>({{ $item->visited_count }})</span>
                        </li> --}}
                    @endforeach
                </ul>
            </div><!-- end link-widget -->
        </div><!-- end widget -->

        <div class="widget">
            <h2 class="widget-title">Recent Blogs</h2>

            <div class="blog-list-widget">
                <div class="list-group">
                    @foreach ($data as $item)
                        <a href="garden-single.html"
                            class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="w-100 justify-content-between">
                                <img src="{{ asset("/storage/blog/image/$item->image") }}" alt=""
                                    class="img-fluid float-left">
                                <h5 class="mb-1">{{ $item->title }}</h5>
                                <small> {{ $item->created_at->format('d M, Y') }}</small>
                            </div>
                        </a>
                    @endforeach


                </div>
            </div><!-- end blog-list -->
        </div><!-- end widget -->



    </div><!-- end sidebar -->
</div><!-- end col -->
