<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = ['tittle', 'body','category_id','image'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->user_id = Auth::id();
        });
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    } //cada articulo puede tener vario comentarios

    public function user()
    {
        return $this->belongsTo('App\User');
    } //relacion inversa
}



