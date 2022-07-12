<?php

namespace App\Models;

use App\Http\Resources\User;
use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
        'user_id',
        'body'
    ];


    protected static function boot(){
   parent::boot();

   static::addGlobalScope(new ReverseScope());
    }
    public function user(){

        return $this->belongsTo(User::class);
    }
}
