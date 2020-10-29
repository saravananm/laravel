<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thescitechjournalpost extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'thescitechpost_tag','thescitechpost_id','tag_id');
    }

    public function categories()
    {
    	return $this->belongsToMany(Thescitech_categories::class,'thescitechpost_categories','thescitechpost_id','thescitechcategorie_id');
    }
}
