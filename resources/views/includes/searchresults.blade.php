<article class="holder slideout_inner" id="search">
	<h4 class="section-title" >SEARCH RESULTS:</h4>
	
	@foreach($posts as $post)
		<article class="post" data-postid="{{$post->app_id}}">
			<div>
				<img class="icon" src="{{$post->isSet($post->app_icon_path) ? $post->app_icon_path : 'uploads/noimageicon.png' }}" alt="Image" />
			</div>
			<div>
				<p title="{{strtoupper($post->app_nm)}}"> {{strtoupper($post->app_nm)}}        
				</p>
				<p>
					<a class="btn btn-info btn-sm" href="{{$post->app_path}}" {{$post->isUrl($post->app_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_path}}">Download</a> |
					@if($post->isSet($post->app_manual_path))
						<a class="btn btn-info btn-sm" href="{{$post->app_manual_path}}" data-title="manual" {{$post->isUrl($post->app_manual_path) ? 'target="_blank"' : 'download'}}  data-name="{{$post->app_manual_path}}">Manual</a> |
					@endif  
					@if($post->isSet($post->app_readme_path))
					   <a class="btn btn-info btn-sm" href="{{$post->app_readme_path}}" data-title="readme" {{$post->isUrl($post->app_readme_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_readme_path}}">Read Me</a> |
					@endif                                    
				</p>
			</div>			
		</article>					
	@endforeach
</article>