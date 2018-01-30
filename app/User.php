<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    //
    use \Illuminate\Auth\Authenticatable;
    
    public $primaryKey = 'user_id';
    
    public function posts()
    {
        return $this->hasMany('App\Post','user_id','user_id');
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Role','USER_ROLE','user_id','role_id');
        //linkedtable,intermediatetable,thistableslinkcolumn,othertableslinkcolumn
        //additional fields were entered due to table name being different from the convension
        //laravel is looking for which would be role_user based on alphabetic order n model names
    }
    
    public function getUserRoles()
    {
        /*try 
        {*/
            $roll = array();

            for ($i=0; $i <$this->roles->count(); $i++) {
                array_push($roll, $this->roles[$i]['role_nm']);
                if (in_array('admin', $roll)) {
                    return true;
                }
            }
            return $roll[0];//[0]->name;
        /*} catch (\Exception $e) {
            return redirect()->route('dashboard')->with(['message' => $e, 'errstatus'=>0]);
        }*/
    }
    
    public function isAdmin()
    {
        /*try
        {*/
        for ($i=0; $i <$this->roles()->count(); $i++) {
            if ($this->roles[$i]['role_nm']==='admin') {
                return true;
            }
        }
        return false;
         /*   }
        catch(\Throwable $e)
        {
            return redirect()->route('dashboard')->with(['message' => $e->getMessage(), 'errstatus'=>0]);
        }*/
    }
    
    public function isCreator()
    {
        return $this->roles->pluck('role_nm', 'creator') ? true : false;
    }
}

//Account [{"id":1,"name":"admin","pivot":{"user_id":"1","role_id":"1"}},{"id":2,"name":"creator","pivot":{"user_id":"1","role_id":"2"}}]
