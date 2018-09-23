<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model{
  
  // Renameing Table Name
    // protected $table = 'Dogs';
  // Primary Key
    // public $primaryKey = 'id';
  // Timestamps
    // public $timestamps = true;

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function comments(){
      return $this->hasMany('App\Comment');
    }
}
