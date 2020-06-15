<?php
namespace App\Services;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use App\Services\TagService;
use App\Services\CategoryService;

class PostService
{
    protected $categoryservice;

    public function __construct(CategoryService $categoryservice)
    {
       // $this->categoryservice = $categoryservice;
	}
	
	public function getDivisions()
	{
		return ["news-features"=>"News&Features", "discoveries-innovations "=>"Discoveries&Innovations" ,"applications-impacts"=>"Applications&Impacts", "science-society"=>"Science&Society"];
	}

	public function getPosts($id)
	{
		return Post::with(['tags'])->where('id',$id)->first();
		$editpost = Post::with(['tags'])->where('id',$id)->first();
		return $editpost->toArray();
	}

	public function postsList()
	{
		return Post::paginate(3);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
			'division' 		=> 'required',
			'categories' 	=> 'required',
            'title' 		=> 'required',
            'image_name' 	=> 'required|mimes:jpeg,png',
    		'short_message' => 'required',
    		'message' 		=> 'required',
    		'datefor' 		=> 'required',
			'author' 		=> 'required',
			'tag' 			=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
			'division' 		=> 'required',
			'categories' 	=> 'required',
            'title' 		=> 'required',
            'image_name' 	=> 'required|mimes:jpeg,png',
    		'short_message' => 'required',
    		'message' 		=> 'required',
    		'datefor' 		=> 'required',
			'author' 		=> 'required',
			'tag' 			=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function savePosts($req)
	{
		$adv 				= new Post;
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/posts');
			$file_path = $req->image_name->hashName();
			$adv->image_name 	= $file_path;
		}
        $adv->division 		= $req->division;
        $adv->title 		= $req->title;
        $adv->short_message = $req->short_message;
        $adv->message 		= $req->message;
        $adv->datefor 		= $req->datefor;
        $adv->author 		= $req->author;
        $adv->status 		= $req->status;
		$insertedId = $adv->save();
		$adv->tags()->attach($req->tag);
	}

	public function updatePosts($req)
	{
		$adv 				= new Post;
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/posts');
			$file_path = $req->image_name->hashName();
			$adv->image_name 	= $file_path;
		}
        $adv->division 		= $req->division;
        $adv->title 		= $req->title;
        $adv->short_message = $req->short_message;
        $adv->message 		= $req->message;
        $adv->datefor 		= $req->datefor;
        $adv->author 		= $req->author;
        $adv->status 		= $req->status;
		$adv->save();
		$adv->tags()->detach();
		$adv->tags()->attach($req->tag);
	}
}