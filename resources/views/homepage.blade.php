@extends('frontend.layouts.master')
@section('content')
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="page-wrapper">
            <div class="blog-list clearfix">
                @foreach ($arr as $item)
                    <div class="blog-box row">
                        <div class="col-md-4">
                            <div class="post-media">
                                <a href="{{ route('blog', [$item->id]) }}" title="">
                                    <img src="{{ asset("/storage/blog/image/$item->image") }}" alt="image"
                                        class="img-fluid h-50">
                                    <div class="hovereffect"></div>
                                </a>
                            </div><!-- end media -->
                        </div><!-- end col -->

                        <div class="blog-meta big-meta col-md-8">
                            <input type="hidden" class="form-control" id="exampleInputId" name="id"
                                        value="{{ $item->id }}">

                            @foreach ($item->categories as $cat)
                                <span class="bg-aqua"><a href="garden-category.html"
                                        title="">{{ $cat->name }}</a></span>
                            @endforeach

                            <h4><a href="{{ route('blog', [$item->id]) }}" title="" id="title">{{ $item->title }}
                                    {{-- @php
                                    session(['count' => $item->increment('visited_count')])
                                @endphp --}}
                                </a></h4>
                            <p>{!! $item->description !!}</p>
                            <small><i class="fa fa-eye view"></i>
                                {{ $item->visited_count }}</a></small>
                            <small>{{ $item->created_at->format('d M, Y') }}</small>
                            <small>by
                                @if ($item->users)
                                    {{ $item->users->first_name . ' ' . $item->users->last_name }}
                                @endif
                            </small>
                        </div><!-- end meta -->
                    </div><!-- end blog-box -->
                    <hr class="invis">
                    {{-- {{$item}} --}}
                @endforeach




            </div><!-- end blog-list -->
        </div><!-- end page-wrapper -->

        <hr class="invis">

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    {{ $blogs->links() }}
                   
                </nav>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end col -->
@section('script')
   
@endsection
@endsection
