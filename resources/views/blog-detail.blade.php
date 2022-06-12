@extends('layouts.app')


@section('content')
<main id="site-container" class="site-main" role="main">
    <div class="album py-5 bg-light" style="padding-top: 40px; padding-bottom: 40px">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <article id="post-3303" class="post-3303 post type-post status-publish format-standard has-post-thumbnail category-chuyen-gia category-kien-thuc">
                    <div class="td-pb-row">
                        <div class="td-pb-span12">
                            <div class="td-post-header">
                                <div class="td-crumb-container">
                                    <div class="entry-crumbs"><span><a title="" class="entry-crumb" href="/">Trang chủ</a></span> 
                                    <i class="td-icon-right td-bread-sep"></i> 
                                </div>
                                </div>
                                <header class="td-post-title">
                                    <h1 class="entry-title">{{$post->title}}</h1>
                                    <div class="td-module-meta-info">
                                        <div class="td-post-author-name td-post-author-no-dot">
                                            <div class="td-author-by">Bởi <span>{{$post->user->name}}</span> - <span class="td-nr-views-3303">{{date('d-m-Y', strtotime($post->created_at));}}</span></div> 
                                        </div>
                                        <div class="td-post-views"><i class="td-icon-views"></i></div>
                                    </div>

                                </header>
                            </div>
                        </div>
                    </div> <!-- /.td-pb-row -->

                    <div class="td-pb-row">
                        <div class="td-pb-span12 td-main-content" role="main">
                            <div class="td-ss-main-content" style="padding-top: 20px">
                                {!!$post->content!!}
                            </div>
                        </div>
                    </div> <!-- /.td-pb-row -->
                </article>
            </div>
        </div>
    </div>
</main>
@endsection