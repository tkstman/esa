<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public $main = 'uploads/';
	public $allowedMimeTypes =  ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml','image/x-icon'];
	public $php_logo= 'uploads/noimageicon.png';
    //
    public function postCreatePost(Request $request)
    {
        $message= 'There was an error';
		
        $supplier='';
        //try {
            $this->validate($request, [
                'app_name'=>'required|unique:APPLICATIONS,app_nm',
                'app_file'=>'required',
                'app_manual'=>'sometimes|required',
                'app_readme'=>'sometimes|required',
            ]);
            //return redirect()->back()->withErrors('Got Here');
            if($request['app_uploader'])
            {
                if(trim($request['app_uploader']) === '-')
                {
                   return redirect()->back()->withErrors('Please select the App Supplier');
                }

                $supplier = $request['app_uploader'];
            }
        
            $is_url=false;
            $post = new Post();
            $post->app_nm = strtoupper($request['app_name']);
            
            $validation = 
            
              '/^((http|https|ftp)?:\/\/){1}?((([a-z\d]([a-z\\d-]*[a-z\\d])*)\.)*[a-z]{2,}|((\d{1,3}\.){3}\d{1,3}))(\:\d+)?(\/[-a-z\d%@_.~+&:]*)*(\?[;&a-z\d%@_.,~+&:=-]*)?(\#[-a-z\d_]*)?$/i';
		try {
            if ($request->hasFile('app_file') && $request->file('app_file')->isValid()) {
                $appDestinationPath = $this->main . Auth::user()->user_name;
                $appFile = $request->file('app_file');
                $appFileName = $request->file('app_file')->getClientOriginalName();
                //$appFileExt = $appFile->getClientOriginalExtension();
                $appFileSaveLoc = rand(111111, 999999). $appFileName;// .".".$appFileExt;
                $appFile->move($appDestinationPath, $appFileSaveLoc);
                $post->app_path = $appDestinationPath.'/'.$appFileSaveLoc;
            } 
            else if ( preg_match($validation, trim($request['app_file']))) {
                $post->app_path=trim($request['app_file']);
                $is_url=true;
            } else {
                $message = 'Invalid File Submitted As Application File!';
                return redirect()->route('dashboard')->with(['message' => $message, 'errstatus'=>0]);
            }
} catch (\Exception $e) {
            return redirect()->route('dashboard')->with(['message' => $message . $e->getMessage(), 'errstatus'=>0]);
        }
            if ($request->hasFile('app_manual')) {
                if ($request->file('app_manual')->isValid()) {
                    $manualDestinationPath = $this->main . Auth::user()->user_name;
                    $manualFile = $request->file('app_manual');
                    $manualFileName = $request->file('app_manual')->getClientOriginalName();
                    //$manualFileExt = $manualFile->getClientOriginalExtension();
                    $manualFileSaveLoc = rand(111111, 999999). $manualFileName ;//.".".$manualFileExt;
                    $manualFile->move($manualDestinationPath, $manualFileSaveLoc);
                    $post->app_manual_path = $manualDestinationPath.'/'.$manualFileSaveLoc;
                } else {
                    $message = 'Invalid File For Manual Supplied!';
                    return redirect()->route('dashboard')->with(['message' => $message, 'errstatus'=>0]);
                }
            } else if ( preg_match($validation, trim($request['app_manual']))) {
                $post->app_manual_path =trim($request['app_manual']);
                $is_url=true;
            }

            if ($request->hasFile('app_readme')) {
                if ($request->file('app_readme')->isValid()) {
                    $readmeDestinationPath = $this->main . Auth::user()->user_name;
                    $readmeFile = $request->file('app_readme');
                    $readmeFileName = $request->file('app_readme')->getClientOriginalName();
                    //$readmeFileExt = $readmeFile->getClientOriginalExtension();
                    $readmeFileSaveLoc = rand(111111, 999999). $readmeFileName ;//.".".$readmeFileExt;
                    $readmeFile->move($readmeDestinationPath, $readmeFileSaveLoc);
                    $post->app_readme_path = $readmeDestinationPath.'/'.$readmeFileSaveLoc;
                } else {
                    $message = 'Invalid File For Readme Supplied!';
                    return redirect()->route('dashboard')->with(['message' => $message, 'errstatus'=>0]);
                }
            } else if (preg_match($validation, trim($request['app_readme']))) {
                $post->app_readme_path = trim($request['app_readme']);
                $is_url=true;
            }
			
			if ($request->hasFile('app_appicon') ) {
				$contentType = mime_content_type($request->file('app_appicon')->getPathName());
                if ($request->file('app_appicon')->isValid() && in_array($contentType, $this->allowedMimeTypes)) {
                    $app_appiconDestinationPath = $this->main . Auth::user()->user_name;
                    $app_appiconFile = $request->file('app_appicon');
                    $app_appiconFileName = $request->file('app_appicon')->getClientOriginalName();
                    $app_appiconFileSaveLoc = rand(111111, 999999). $app_appiconFileName ;
                    $app_appiconFile->move($app_appiconDestinationPath, $app_appiconFileSaveLoc);
                    $post->app_icon_path = $app_appiconDestinationPath.'/'.$app_appiconFileSaveLoc;
                } else {
                    $message = 'Invalid File For App Icon Supplied!' . $contentType;
                    return redirect()->route('dashboard')->with(['message' => $message, 'errstatus'=>0]);
                }
            } else if (preg_match($validation, trim($request['app_appicon'])) && in_array( get_headers($request['app_appicon'],1)['Content-Type'] , $this->allowedMimeTypes) ) {
                $post->app_icon_path = trim($request['app_appicon']);
                $is_url=true;
            }

            $post->is_url = $is_url;
            $post->aud_dt = date('Y-m-d H:i:s');
            $post->created_dt = $post->aud_dt;
            $post->uploaded_dt = $post->aud_dt;
            $post->aud_uid = Auth::user()->user_name;
        
            if($supplier && trim($supplier) !=='')
            {
                $post->user_id = $supplier;
            }
        
            if ($request->user()->posts()->save($post)) {
                $message = 'Post Successfully Created!';
                return redirect()->route('dashboard')->with(['message' => $message, 'errstatus'=>1]);
            }
            
        /*} catch (\Exception $e) {
            return redirect()->route('dashboard')->with(['message' => $message . $e->getMessage(), 'errstatus'=>0]);
        }*/
        
    }
    
    public function getDashboard()
    {
        $posts = Post::orderBy('user_id', 'asc')->orderBy('created_dt', 'desc')->get();
        return view('dashboard', ['posts'=>$posts]);
    }
    
    public function getWelcome()
    {
        /*$posts = Post::with(['user' => function ($query) {
            $query->orderBy('frst_nm', 'desc');
            //$query->orderBy('last_nm', 'desc');
            //$query->orderBy('created_dt', 'desc');
        }]);*/
        $posts = Post::orderBy('user_id', 'asc')->orderBy('app_nm', 'asc')->get();
		$sidebar = User::hydrate(DB::select('select * from users where [SOFT_WARE].dbo.USERS.user_id in (select distinct APPLICATIONS.user_id from APPLICATIONS) order by frst_nm'));
        return view('welcome', ['posts'=>$posts, 'sidebar'=>$sidebar]);
        //orderBy('frst_nm', 'DESC')->orderBy('last_nm', 'DESC')->
    }
    
    public function getDeletePost($post_id)
    {
        //$post = Post::where('app_id','>',$post_id)->first();
        //try{
        $post = Post::where('app_id', $post_id)->first();
        
        //Check if user owns post
        if(Auth::user()->isAdmin())
        {}
        else if(Auth::user() != $post->user)
        {
            return redirect()->back();
        }
        
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
               
    }
    
    public function postEditPost(Request $request)
    {
        try
        {
            $this->validate($request, [
                'postId' =>'required',
                /*'edit_name' => 'sometimes|required'*/
            ]);

            $state = 'Successfully Updated Post!';
            $change=false;
            $validation = '/^((http|https|ftp)?:\/\/){1}?((([a-z\d]([a-z\\d-]*[a-z\\d])*)\.)*[a-z]{2,}|((\d{1,3}\.){3}\d{1,3}))(\:\d+)?(\/[-a-z\d%@_.~+&:]*)*(\?[;&a-z\d%@_.,~+&:=-]*)?(\#[-a-z\d_]*)?$/i';
            /*'/^((http|https|ftp)?:\/\/){1}?((([a-z\d]([a-z\d-]*[a-z\d])*)\.)*[a-z]{2,}|((\\d{1,3}\.){3}\\d{1,3}))(\:\\d+)?(\/[-a-z\d%@_.~+&:]*)*(\?[;&a-z\d%@_.,~+&:=-]*)?(\\#[-a-z\d_]*)?$/i'*/
            
            //"/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";


            //Check if user owns post
             $post = Post::find($request['postId']);
            $ximo = $post->user;
              
            if(Auth::user()->isAdmin())
            {            
            }
            else if(Auth::user()->user_id != $post->user->user_id)
            {
                return redirect()->back();                
            }
//return response()->json(['message' => $ximo == Auth::user() , 'errstatus'=>0], 200);
            if ($request->has('edit_name') && strlen(trim($request['edit_name'])) >0 && $request['edit_name'] != $post->app_nm)
            {
                if(!Post::where('app_nm', $request['edit_name'])->first())
                {
                    $post->app_nm = strtoupper($request['edit_name']);
                    $change=true;
                }
            }
            else if(strlen(trim($request['edit_name'])) ==0)
            {
                $state = "Length Of App Name Cannot Be < 1";
                return response()->json(['message' => $state, 'errstatus'=>0], 200);
            }


            if($request->has('edit_files')  )
            {
                if($request->hasFile('edit_files') && $request->file('edit_files')->isValid()) 
                {
                    if( file_exists($post->app_path) )
                    {
                        //delete file 
                        if(!unlink(public_path($post->app_path))){
                            throw new \Exception("failed to delete app");
                        }
                    }
                    //update with new file

                    $appDestinationPath = $this->main . $post->user->user_name;
                    $appFile = $request->file('edit_files');
                    $appFileName = $request->file('edit_files')->getClientOriginalName();
                    //$appFileExt = $appFile->getClientOriginalExtension();
                    $appFileSaveLoc = rand(111111, 999999). $appFileName;// .".".$appFileExt;
                    $appFile->move($appDestinationPath, $appFileSaveLoc);
                    $post->app_path = $appDestinationPath.'/'.$appFileSaveLoc; 
                    $change=true;
                }
                else if(preg_match($validation, trim($request['edit_files'])) && trim($request['edit_files']) !== $post->app_path)
                {
                    $post->app_path = trim($request['edit_files']);
                    $change=true;
                }

            }
            else
            {
                throw new \Exception("file not valid");
            }

            if($request->has('edit_manuals') )
            {
                if($request->hasFile('edit_manuals') && $request->file('edit_manuals')->isValid())
                {
                    if( file_exists($post->app_manual_path) )
                    {
                        //delete file 
                        if(!unlink(public_path($post->app_manual_path))){
                            throw new \Exception("failed to delete manual");
                        }
                    }

                    //update with new file

                    $appDestinationPath = $this->main . $post->user->user_name;
                    $appFile = $request->file('edit_manuals');
                    $appFileName = $request->file('edit_manuals')->getClientOriginalName();
                    //$appFileExt = $appFile->getClientOriginalExtension();
                    $appFileSaveLoc = rand(111111, 999999). $appFileName;// .".".$appFileExt;
                    $appFile->move($appDestinationPath, $appFileSaveLoc);
                    $post->app_manual_path = $appDestinationPath.'/'.$appFileSaveLoc; 
                    $change=true;   
                }
                else if(preg_match($validation, trim($request['edit_manuals'])) && trim($request['edit_manuals']) !== $post->app_manual_path)
                {
                    $post->app_manual_path = trim($request['edit_manuals']);
                    $change=true;
                }

            }


            if($request->has('edit_readmes') )
            {
                if($request->hasFile('edit_readmes') && $request->file('edit_readmes')->isValid())
                {
                    if( file_exists($post->app_readme_path) )
                    {
                        //delete file 
                        if(!unlink(public_path($post->app_readme_path))){
                            throw new \Exception("failed to delete readme");
                        }  
                    }
                    //update with new file

                    $appDestinationPath = $this->main . $post->user->user_name;
                    $appFile = $request->file('edit_readmes');
                    $appFileName = $request->file('edit_readmes')->getClientOriginalName();
                    //$appFileExt = $appFile->getClientOriginalExtension();
                    $appFileSaveLoc = rand(111111, 999999). $appFileName;// .".".$appFileExt;
                    $appFile->move($appDestinationPath, $appFileSaveLoc);
                    $post->app_readme_path = $appDestinationPath.'/'.$appFileSaveLoc; 
                    $change=true;   
                    
                }     
                else if(preg_match($validation, trim($request['edit_readmes'])) && trim($request['edit_readmes']) !==$post->app_readme_path  )
                {
                    $post->app_readme_path =trim($request['edit_readmes']);
                    $change=true;
                }
                
            }
			
			if($request->has('edit_appicons') )
            {
	
                if($request->hasFile('edit_appicons') && $request->file('edit_appicons')->isValid() && in_array(mime_content_type($request->file('edit_appicons')->getPathName()), $this->allowedMimeTypes))
                {
                    if( file_exists($post->app_icon_path) )
                    {
                        //delete file 
                        if(!unlink(public_path($post->app_icon_path))){
                            throw new \Exception("failed to delete readme");
                        }  
                    }
                    //update with new file

                    $appDestinationPath = $this->main . $post->user->user_name;
                    $appFile = $request->file('edit_appicons');
                    $appFileName = $request->file('edit_appicons')->getClientOriginalName();
                    //$appFileExt = $appFile->getClientOriginalExtension();
                    $appFileSaveLoc = rand(111111, 999999). $appFileName;// .".".$appFileExt;
                    $appFile->move($appDestinationPath, $appFileSaveLoc);
                    $post->app_icon_path = $appDestinationPath.'/'.$appFileSaveLoc; 
                    $change=true;   
                    
                }     
                else if(preg_match($validation, trim($request['edit_appicons'])) && in_array( get_headers($request['edit_appicons'],1)['Content-Type'] , $this->allowedMimeTypes) && trim($request['edit_appicons']) !==$post->app_icon_path  )
                {	
                    $post->app_icon_path =trim($request['edit_appicons']);
                    $change=true;
                }
                
            }

            

            if(!$change)
            {
                $state = "No Updates Made";
                return response()->json(['message' => $state, 'errstatus'=>0], 200);
            }
            $post->aud_dt = date('Y-m-d H:i:s');
            $post->aud_uid = Auth::user()->user_name;
            $post->update();

            return response()->json([
                'message' => $state,  'errstatus'=>1,
                'post_updated' => $post
            ],200);
        }
        catch(\Throwable $e)
        {
            return response()->json(['message' => "Unexpected Error Thrown" , 'errstatus'=>0], 200); //. $e->getMessage() ." ". $e->getLine() ." ". $e->getFile()
        }
    }
	
	public function postPostSearch(Request $request)
	{
		try
        {
            $this->validate($request, [
                'searchvalue' =>'required',
            ]);
			
			$results = Post::where('app_nm', 'like', '%'. $request['searchvalue'] .'%')->get();
			
			$html = view('includes.searchresults',['posts'=>$results])->render();
			
			return response()->json(['success' => true, 'html' => $html]);

            //$state = 'Successfully Updated Post!';
		}
		catch(\Throwable $e)
		{
			return response()->json(['message' => "Unexpected Error Thrown" . $e->getMessage() ." ". $e->getLine() ." ". $e->getFile(), 'errstatus'=>0], 200); //
		}
	}
}
