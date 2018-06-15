@extends('layouts.master')

@section('content')
   @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6">
            <header>
                <h3>Uploading a new application?</h3>
            </header>
            <button type="button" class="btn btn-primary btn-lg" id="addNew">Add New App</button>
            <!--<form action="{{route('post.create')}}" enctype="multipart/form-data" method="post">
               <div class="jumbotron">               
                    <div class="form-group">
                        <textarea class="form-control" name="app_name" id="app_name" rows="1" placeholder="Application Name"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="app_file">Application File</label>
                        <input class="form-control" type="file" name="app_file" id="app_file"/>
                    </div>

                    <div class="form-group">
                        <label for="app_manual">Manual</label>
                        <input class="form-control" type="file" name="app_manual" id="app_manual"/>
                    </div>
                    <div class="form-group">
                        <label for="app_readme">Read me</label>
                        <input class="form-control" type="file" name="app_readme" id="app_readme"/>
                    </div>
                    <button type="submit" class="btn-primary">Post New App</button>
                    {{Form::token()}}
                </div>
            </form>-->
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 holder dash">
            <header><h3>Listed Apps</h3></header>
            @foreach($posts as $post)
            <article class="post" data-postid="{{$post->app_id}}">
                <p> {{strtoupper($post->app_nm)}}        
                </p>
                <p><a class="btn btn-info btn-sm" href="{{$post->app_path}}" data-title="appfile" {{$post->isUrl($post->app_path) ? 'target="_blank"' : 'download'}} data-name="{{$post->app_path}}">App</a> |
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
                <div class="interaction">
                   <!--<a href="#">Like</a> |
                   <a href="#">DisLike</a>--> 
                   @if(Auth::user()->user_id==$post->user->user_id || Auth::user()->isAdmin())
                       |
                       <a href="#" class="edit">Edit</a> |
                       <a href="{{route('post.delete',['post_id'=>$post->app_id])}}">Delete</a>
                   @endif
                </div>
            </article>
            @endforeach
            
        </div>
    </section>
    
    <div class="modal" tabindex="-1" role="dialog" id='edit-modal'>
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content contlucent">
          <div class="modal-header">
            <h5 class="modal-title lucent">Edit Application</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span class="myerror"></span>
            <form action="{{route('post.create')}}" enctype="multipart/form-data" method="post" id="uploaders">
               <div class="jumbotron lucent">
                                  
                    <div class="form-group">
                        <label for="edit_name">Application Name</label>
                        <input class="form-control" name="edit_name" id="edit_name" rows="1" placeholder="Application Name" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="app_file">Application File</label>
                        <label class="float-right">Is Url</label>
                        <div class="input-group mb-3">
                            <input class="custom-file-upload-hidden" type="file" name="edit_file" id="edit_files" placeholder="Enter Url | http://intranet"/>
                            <input type="text" class="form-control dummy" id="edit_file" >
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary select-butn" tabindex="-1">Select New File</button>
                                <div class="input-group-append">|
                                    <div class="input-group-text">
                                      <input class="editcheckbox" type="checkbox" aria-label="checkbox_app_file">
                                    </div>
                                </div> 
                            </div>
                                     
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="app_manual">Manual</label>
                        <div class="input-group mb-3">
                            <input class="custom-file-upload-hidden" type="file" name="edit_manual" id="edit_manuals"  placeholder="Enter Url | http://intranet"/>
                            <input type="text" class="form-control dummy" id="edit_manual">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary select-butn" tabindex="-1">Select New File</button>
                                <div class="input-group-append">|
                                    <div class="input-group-text">
                                      <input class="editcheckbox" type="checkbox" aria-label="checkbox_app_file">
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="app_readme">Read me</label>
                        <div class="input-group mb-3">
                            <input class="custom-file-upload-hidden" type="file" name="edit_readme" id="edit_readmes" placeholder="Enter Url | http://intranet"/>
                            <input type="text" class="form-control dummy" id="edit_readme" >
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary select-butn" tabindex="-1">Select New File</button>
                                <div class="input-group-append">|
                                    <div class="input-group-text">
                                      <input class="editcheckbox" type="checkbox" aria-label="checkbox_app_file">
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>   
					<div class="form-group">
							<label for="edit_appicon">App Icon</label>
							<div class="input-group mb-3">
								<input class="custom-file-upload-hidden" type="file" name="edit_appicon" id="edit_appicons" data-text=""  placeholder="Enter Url | http://intranet">
								<input type="text" class="form-control dummy" id="edit_appicon" data-text="">
								<div class="input-group-append">
									<button type="button" class="btn btn-outline-secondary select-butn" tabindex="-1">Select New File</button>
									<div class="input-group-append">|
										<div class="input-group-text">
										  <input class="editcheckbox" type="checkbox" aria-label="checkbox_app_file">
										</div>
									</div> 
								</div>
							</div>
						</div>							
                    {{Form::token()}}
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id='add-modal'>
      <div class="modal-dialog" role="document">
        <div class="modal-content contlucent">
          <div class="modal-header">
            <h5 class="modal-title lucent">New Application</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('post.create')}}" enctype="multipart/form-data" method="post">
               <div class="jumbotron lucent">               
                    <div class="form-group">
                       <div class="input-group mb-3">
                           <input class="form-control" name="app_name" id="app_name" rows="1" placeholder="Application Name" type="text"/>
                           <div class="input-group-append" >|
                                <div class="input-group-text" style="padding-left: 12%">
                                  <label style="margin: 0;">Url?</label><br/>
                                  <label style="margin: 0;">&darr;</label>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="form-group">
                        <label for="app_file">Application File</label>
                        <div class="input-group mb-3">
                           <input class="form-control" type="file" name="app_file" id="app_file"/>
                            <div class="input-group-append">|
                                <div class="input-group-text">
                                  <input class="checkbox add" type="checkbox" aria-label="checkbox_app_file">
                                </div>
                            </div>                            
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="app_manual">Manual</label>
                       <div class="input-group mb-3">                            
                            <input class="form-control" type="file" name="app_manual" id="app_manual"/>
                            <div class="input-group-append">|
                                <div class="input-group-text">
                                  <input class="checkbox add" type="checkbox" aria-label="checkbox_app_file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="app_readme">Read me</label>
                        <div class="input-group mb-3">   
                            <input class="form-control" type="file" name="app_readme" id="app_readme"/>
                            <div class="input-group-append"> |
                                <div class="input-group-text">
                                  <input class="checkbox add" type="checkbox" aria-label="checkbox_app_file">
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="app_appicon">App Icon</label>
                        <div class="input-group mb-3">   
                            <input class="form-control" type="file" name="app_appicon" id="app_appicon"/>
                            <div class="input-group-append"> |
                                <div class="input-group-text">
                                  <input class="checkbox add" type="checkbox" aria-label="checkbox_app_file">
                                </div>
                            </div>
                        </div>
                    </div>					
                    <button type="submit" class="btn-primary">Post New App</button>
                    {{Form::token()}}
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
        var token = '{{Session::token()}}';
        var url = '{{route('edit')}}';
    </script>
    
    
@endsection