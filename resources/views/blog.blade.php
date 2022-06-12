@extends('layouts.app')

@section('content')
<div class="album py-5 bg-light" style="padding-top: 40px; padding-bottom: 40px">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($posts as $post)
            <div class="col">
                <div class="card shadow-sm">
                    <div style="height: 250px; background: url({{$post->thumbnail}}) no-repeat center; background-size: cover">
                    </div>

                    <div class="card-body">
                        <h4 class="card-text">{{$post->title}}</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a type="button" href="/blog/{{$post->slug}}" class="btn btn-sm btn-outline-secondary">Chi tiết</a>
                            </div>
                            <small class="text-muted">{{date('d-m-Y', strtotime($post->created_at));}}</small>
                            <small class="text-muted">{{$post->user->name}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="d-flex justify-content-end mt-5">
                {{$posts->links('pagination.default')}}
            </div>
        </div>
    </div>
</div>
@endsection