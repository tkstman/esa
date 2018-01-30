@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message-block')
    <div class="jumbotron mx-auto">
        <div class="container">
            <h1>Welcome To Our Site</h1>
            <p class="lead">
                Welcome to the Electoral Office Software Hub Application. This website uses laravel 5.5.
            </p>
        </div>
    </div>
    <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <header><h3>Listed Apps</h3></header>
                @foreach($posts as $post)
            <article class="post" data-postid="{{$post->app_id}}">
                <p> {{strtoupper($post->app_nm)}}        
                </p>
                <p><a class="btn btn-info btn-sm" href="{{$post->app_path}}" {{$post->isUrl($post->app_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_path}}">App</a> |
                  @if($post->isSet($post->app_manual_path))
                   <a class="btn btn-info btn-sm" href="{{$post->app_manual_path}}" data-title="manual" {{$post->isUrl($post->app_manual_path) ? 'target="_blank"' : 'download'}}  data-name="{{$post->app_manual_path}}">Manual</a> |
                   @endif  
                   @if($post->isSet($post->app_readme_path))
                       <a class="btn btn-info btn-sm" href="{{$post->app_readme_path}}" data-title="readme" {{$post->isUrl($post->app_readme_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_readme_path}}">Read Me</a> |
                   @endif                                    
                </p>
                <div class="info">
                    Posted by {{$post->user->frst_nm . " ".$post->user->last_nm}} on {{$post->created_dt}}
                </div>
                
            </article>
            @endforeach

            </div>
        </section>
@endsection
