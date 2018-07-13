@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
	<div class="row">
	{{----}}
	@include('includes.sidebar')
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			@include('includes.message-block')
			<div class="jumbotron mx-auto" id="top">
				<div class="container">
					<h1>Welcome To Our Site</h1>
					<p class="lead">
						Welcome to the Electoral Office Software Hub Application.
					</p>
					<p style="font-size: 14px;">
						<span  class="arrow" style="font-size:  30px; top: 4px; position: relative;">&#x21FD;</span>
						Select A Name To See The Associated Applications.
					</p>
				</div>
			</div>
			<div class="row posts">
			<div class="col-md-6 appscontainer" id="appscontainer">
				<!--<header ><h3>Listed Apps</h3></header>-->

				@foreach($sidebar as $user)
					<div class="holder slideout_inner" id="{{$user->user_id}}">
						<h4 class="section-title" >{{$user->frst_nm . " ".$user->last_nm}} </h4>

						@foreach($posts as $post)
							@if($post->user->user_id == $user->user_id)
							<div class="post" data-postid="{{$post->app_id}}">
								<div>
									<img class="icon" src="{{$post->isSet($post->app_icon_path) ? $post->app_icon_path : 'uploads/noimageicon.png' }}" alt="Image" />
								</div>
								<div>
									<p class="title" title="{{strtoupper($post->app_nm)}}"> {{strtoupper($post->app_nm)}}
									</p>
									<p class="downloadables">
										<a class="btn btn-info btn-sm" href="{{$post->app_path}}" {{$post->isUrl($post->app_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_path}}">Download</a> |
										@if($post->isSet($post->app_manual_path))
											<a class="btn btn-info btn-sm" href="{{$post->app_manual_path}}" data-title="manual" {{$post->isUrl($post->app_manual_path) ? 'target="_blank"' : 'download'}}  data-name="{{$post->app_manual_path}}">Manual</a> |
										@endif
										@if($post->isSet($post->app_readme_path))
										   <a class="btn btn-info btn-sm" href="{{$post->app_readme_path}}" data-title="readme" {{$post->isUrl($post->app_readme_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_readme_path}}">Read Me</a> |
										@endif
									</p>
								</div>
								<!--<div class="info">
									Posted on {{$post->created_dt}}
								</div>	-->
							</div>
							@endif
						@endforeach
					</div>
				@endforeach

				{{----}}

			</div>
			</div>
		</main>

		</div>
		<script>
        var token = '{{Session::token()}}';
        var url = '{{route('search')}}';

        if(window.screen.availWidth<"1152")
        {
          var jumbotron = document.getElementById("top");
          jumbotron.style.width="760px";

          var holder = document.querySelectorAll(".holder.slideout_inner");
          for(var t=0;t<holder.length;t++)
          {
            holder[t].style.width="760px";
          }
        }
        if(window.screen.availHeight<"920")
        {
          var nav = document.getElementById("sidebar");
          nav.style.overflowY="scroll";
          nav.style.bottom="0px";
        }


    </script>
@endsection
