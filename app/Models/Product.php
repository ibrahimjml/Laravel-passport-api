<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $fillable = ['title','description','stock','price','discount','size'];

  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }
}