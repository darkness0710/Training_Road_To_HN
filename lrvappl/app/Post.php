<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name - created with Post; default = 'posts'
    protected $table = 'posts';
    //Primary Key
    public $primaryKey = 'id';
    //timestamps - default = 'True'
    public $timestamps = true;
}
