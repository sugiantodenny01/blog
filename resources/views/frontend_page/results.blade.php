@extends('includes_frontend.frontend')

@section('content')
    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">Search results: {{$search}}</h1>
        </div>
    </div>
    <div class="container">
        <div class="row medium-padding120">
            <main class="main">

                <div class="row">
                    @if($posts->count()>0)
                        <div class="case-item-wrap">
                            @foreach($posts as $post)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="case-item">
                                        <div class="case-item__thumb">
                                            <img src="{{asset($post->featured)}}" alt="our case">
                                        </div>
                                        <h6 class="case-item__title"><a href="{{route('post.single',['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <h1 class="text-center">No result found</h1>
                    @endif
                </div>

                <!-- End Post Details -->
                <br>
                <br>
                <br>
                <!-- Sidebar-->

            {{--<div class="col-lg-12">--}}
            {{--<aside aria-label="sidebar" class="sidebar sidebar-right">--}}
            {{--<div  class="widget w-tags">--}}
            {{--<div class="heading text-center">--}}
            {{--<h4 class="heading-title">ALL BLOG TAGS</h4>--}}
            {{--<div class="heading-line">--}}
            {{--<span class="short-line"></span>--}}
            {{--<span class="long-line"></span>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="tags-wrap">--}}
            {{--<a href="#" class="w-tags-item">SEO</a>--}}
            {{--<a href="#" class="w-tags-item">Advertising</a>--}}
            {{--<a href="#" class="w-tags-item">Business</a>--}}
            {{--<a href="#" class="w-tags-item">Optimization</a>--}}
            {{--<a href="#" class="w-tags-item">Digital Marketing</a>--}}
            {{--<a href="#" class="w-tags-item">Social</a>--}}
            {{--<a href="#" class="w-tags-item">Keyword</a>--}}
            {{--<a href="#" class="w-tags-item">Strategy</a>--}}
            {{--<a href="#" class="w-tags-item">Audience</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</aside>--}}
            {{--</div>--}}

            <!-- End Sidebar-->

            </main>
        </div>
    </div>
@endsection