<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag','post_id','tag_id');
    }

    public function categories()
    {
    	return $this->belongsToMany(category::class,'post_categories','post_id','categorie_id');
    }
}
