<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
  
  public function user(){
    return $this->belongsTo('App\User');
  }

  public function dog(){
    return $this->belongsTo('App\Dog');
  }

  public function likes(){
    return $this->hasMany('App\Like');
  }
}
