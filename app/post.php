<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{

    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'title', 'featured', 'content','category_id','slug','user_id',
    ];


    //
    public function  category(){
        return $this->belongsTo('App\category');
    }

    public function  tags(){
        return $this->belongsToMany('App\tag');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


}
