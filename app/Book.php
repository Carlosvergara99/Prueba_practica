<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['publish_date','title','author_id'];


    public  function Authors()
    {
        return $this->belongsTo(Author::class,'author_id');

    }
}
