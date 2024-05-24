@extends('layout')
@section('content')
    <div class="c-layout-page">
        <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
            <div class="container">
                <div class="c-page-title c-pull-left">
                    <h3 class="c-font-uppercase c-font-sbold"><a href="/#" title="Blog tin tức">{{$blog->title}}</a></h3>
                </div>
                <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                    <li><a href="{{url('/')}}">Trang chủ</a></li>
                    <li>/</li>
                    <li>
                        <a href="{{route('blogs')}} ">
                            <h1>Blog tin tức</h1>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="c-content-box c-size-md">
            <div class="container">

                <div class="row">
                    <div class="col-md-9">
               <h5>{!!$blog->description!!}</h5>
                        <p>{!!$blog->content!!}</p>

                    </div>
                </div>
            </div>
                </div>
            </div>
@endsection
