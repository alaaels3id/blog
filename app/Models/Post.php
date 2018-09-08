<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use \Dimsav\Translatable\Translatable;
	
    public $translatedAttributes = ['title', 'body'];

    protected $fillable = ['user_id'];
}
