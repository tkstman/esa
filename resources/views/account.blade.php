@extends('layouts.master')
@section('title')
    Account    
@endsection
@section('content')
   @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Administration</h3></header>
            <button type="button" class="btn btn-primary btn-lg" id="addNew">Add App For Another User</button>
        </div>    
    </section>
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
               <div class="jumbotron lucent add_for">               
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
                       <label for="app_readme">App Supplier</label>
                       <input class="form-control" type="hidden" name="app_uploader" value="-" id="app_uploader"/>
                        <div class="dropdown">                           
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-selected="0">
                              Select App Supplier...
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                             @foreach($users as $user)
                              <a class="dropdown-item" href="#" data-selected="{{$user->user_id}}">{{$user->frst_nm . ' ' . $user->last_nm}}</a>
                             @endforeach
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
@endsection
