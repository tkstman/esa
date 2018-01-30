<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   /* const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'SOFT_TIMESTAMP';*/
    public $timestamps = false;
    protected $table = 'APPLICATIONS';
    protected $primaryKey='app_id';
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }
    
    public function isUrl($value)
    {

        $validation = '/^((http|https|ftp)?:\/\/){1}?((([a-z\d]([a-z\\d-]*[a-z\\d])*)\.)*[a-z]{2,}|((\d{1,3}\.){3}\d{1,3}))(\:\d+)?(\/[-a-z\d%@_.~+&:]*)*(\?[;&a-z\d%@_.,~+&:=-]*)?(\#[-a-z\d_]*)?$/i';
        
        if ( preg_match($validation, $value)) {
            return true;
        }
        
        return false;
    }
    
    public function isSet($value)
    {
        if(isset($value) && strlen($value)>0)
        {
            return true;
        }
        return false;
    }
}
