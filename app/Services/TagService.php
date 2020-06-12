<?php
namespace App\Services;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagService
{
	public function getTag($id)
	{
		return Tag::where('id',$id)->first();
	}
	public function tagsList()
	{
		return Tag::paginate(3);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
            'name' 			=> 'required|unique:tags|min:2',
    		'color' 		=> 'required|size:6',
    		'background' 	=> 'required|size:6',
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
            'name' 			=> 'required|unique:tags,name,'.$req->id.'|min:2',
    		'color' 		=> 'required|size:6',
    		'background' 	=> 'required|size:6',
    		'status' 		=> 'required',
        ]);
	}

	public function saveTags($req)
	{
		$tag 				= new Tag;
        $tag->name 			= $req->name;
        $tag->color 		= $req->color;
        $tag->background 	= $req->background;
        $tag->status 		= $req->status;;
        $tag->save();
	}

	public function updateTags($req)
	{
		$tag 				= Tag::find($req->id);
        $tag->name 			= $req->name;
        $tag->color 		= $req->color;
        $tag->background 	= $req->background;
        $tag->status 		= $req->status;
        $tag->save();
	}
}