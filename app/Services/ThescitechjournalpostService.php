<?php
namespace App\Services;

use App\Thescitechjournalpost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use App\Services\TagService;

class ThescitechjournalpostService
{
    protected $categoryservice;

    public function __construct(CategoryService $categoryservice)
    {
       // $this->categoryservice = $categoryservice;
	}

	public function getPosts($id)
	{
		return Thescitechjournalpost::where('id',$id)->first();
	}

	public function getPostBySlug($slug)
	{
		return Post::where('slug',$slug)->first();
	}

	public function postsList()
	{
		return Thescitechjournalpost::join('coverimages', 'coverimages.id', '=', 'thescitechjournalposts.coverimages_id')
		->orderBy('id','desc')
		->select('thescitechjournalposts.*', 'coverimages.month', 'coverimages.year')
		->paginate(10);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
			'coverimages_id'=> 'required',
            'title' 		=> 'required',
            'image_name' 	=> 'required|mimes:jpeg,png',
    		'short_message' => 'required',
    		'message' 		=> 'required',
    		'datefor' 		=> 'required',
			'author' 		=> 'required',
			'tag_id' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
			'coverimages_id'=> 'required',
            'title' 		=> 'required',
            'image_name' 	=> 'mimes:jpeg,png',
    		'short_message' => 'required',
    		'message' 		=> 'required',
    		'datefor' 		=> 'required',
			'author' 		=> 'required',
			'tag_id' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function savePosts($req)
	{
		$post 				= new Thescitechjournalpost;
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/thescitechjournalposts');
			$file_path = $req->image_name->hashName();
			$post->image_name 	= $file_path;
		}
        $post->coverimages_id 	= $req->coverimages_id;
        $post->title 			= $req->title;
        $post->slug 			= $this->slugify($req->title);
        $post->short_message 	= $req->short_message;
        $post->message 			= $req->message;
        $post->datefor 			= $req->datefor;
        $post->author 			= $req->author;
        $post->status 			= $req->status;
        $post->tag_id 			= $req->tag_id;
		$insertedId 			= $post->save();
	}

	public function updatePosts($req)
	{
		$post 				= Thescitechjournalpost::find($req->id);
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/posts');
			$file_path = $req->image_name->hashName();
			$post->image_name 	= $file_path;
		}
       $post->coverimages_id 	= $req->coverimages_id;
        $post->title 			= $req->title;
        $post->slug 			= $this->slugify($req->title);
        $post->short_message 	= $req->short_message;
        $post->message 			= $req->message;
        $post->datefor 			= $req->datefor;
        $post->author 			= $req->author;
        $post->tag_id 			= $req->tag_id;
        $post->status 			= $req->status;
		$post->save();
	}

	public function slugify($title)
	{
		return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
	}
}