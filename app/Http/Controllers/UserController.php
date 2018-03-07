<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public static function loginAttempt($username, $password)
    {
        $serverName = "eojmw\sqlmw";  //// "SYSPRO_3\SQLEXPRESS" ;"DESKTOP-CADDIOB";//
          //// "LAPTOP-4QLRKL82\SQLEXPRESS";
        


        $connectionInfo = array( "Database"=>"SOFT_WARE", "UID"=>$username, "PWD"=>$password); ////);EOJ@Supp0rt
        $db_connx= sqlsrv_connect($serverName, $connectionInfo);

        // = mssql_("eojmw\sqlmw", "tstone", "password");
        
        if ($db_connx) {
            $user_id= DB::table('users')->where('user_name', $username)->value('user_id');
            $user = User::find($user_id);

            if($user){
            //return redirect()->route('login')->with(['message' => $user_id, 'errstatus'=>1]);
            //
                Auth::login($user);
                return true;
            }
            return false;
            
            
        } else {
            /*echo 'here2';
            print_r(sqlsrv_errors());
                    die("Failed to update audit ");*/
             return false;
        }
    }
    
    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'user_name'=>'required',
            'password'=>'required'
        ]);
        $password= $request['password']; //bcrypt()
        $username= trim($request['user_name']);
        

        

        if (self::loginAttempt($username, $password)) {
            return redirect()->route('dashboard');
        }
 
        return redirect()->route('login')->with(['message' => 'Login Failed', 'errstatus'=>0]);
        
        //return redirect()->route('home');
        
    }
    
    public function getAccount()
    {
        if (Auth::user()->isAdmin()) {
            $users = User::all();
            return view('account', ['users'=> $users]);
        }
        return redirect()->back()->withErrors('not admin');
    }
    
    
    
    public function getHome()
    {
        return view('welcome');
    }
    
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    
}
