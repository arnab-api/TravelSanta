<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //



    public $imgRoot = "/images/";
    public function getPathAttribute($value)
    {
        return $this->imgRoot.$value;
    }

    protected $fillable = [

        'title',
        'review'

    ];

}
