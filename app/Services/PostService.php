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
		return ["news-features"=>"News&Features", "discoveries-innovations"=>"Discoveries&Innovations", "applications-impacts"=>"Applications&Impacts", "science-society"=>"Science&Society"];
	}

	public function getPosts($id)
	{
		return Post::with(['tags','categories'])->where('id',$id)->first();
	}

	public function getPostBySlug($slug)
	{
		$post =  Post::with(['tags','categories'])->where('slug',$slug)->first();
		$division = $this->getDivisions();
		$post->division = $division[$post->division];
		return $post;
	}

	public function postsList()
	{
		return Post::orderBy('id','desc')->paginate(10);
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
			'cover_image'   => 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
			'division' 		=> 'required',
			'categories' 	=> 'required',
            'title' 		=> 'required',
            'image_name' 	=> 'mimes:jpeg,png',
    		'short_message' => 'required',
    		'message' 		=> 'required',
    		'datefor' 		=> 'required',
			'author' 		=> 'required',
			'tag' 			=> 'required',
			'cover_image'   => 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function savePosts($req)
	{
		$post 				= new Post;
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/posts');
			$file_path = $req->image_name->hashName();
			$post->image_name 	= $file_path;
		}
        $post->division 		= $req->division;
        $post->title 			= $req->title;
        $post->slug 			= $this->slugify($req->title);
        $post->short_message 	= $req->short_message;
        $post->message 			= $req->message;
        $post->datefor 			= $req->datefor;
        $post->author 			= $req->author;
        $post->status 			= $req->status;
        $post->cover_image 		= $req->cover_image;
		$insertedId 			= $post->save();
		$post->tags()->attach($req->tag);
		$post->categories()->attach($req->categories);

		if($req->cover_image == 1)
		{
			$this->updateCoverImageStatus($insertedId);
		}
	}

	public function updatePosts($req)
	{
		$post 				= Post::find($req->id);
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/posts');
			$file_path = $req->image_name->hashName();
			$post->image_name 	= $file_path;
		}
        $post->division 		= $req->division;
        $post->title 			= $req->title;
        $post->slug 			= $this->slugify($req->title);
        $post->short_message 	= $req->short_message;
        $post->message 			= $req->message;
        $post->datefor 			= $req->datefor;
        $post->author 			= $req->author;
        $post->cover_image 		= $req->cover_image;
        $post->status 			= $req->status;
		$post->save();
		$post->tags()->detach();
		$post->tags()->attach($req->tag);
		$post->categories()->detach();
		$post->categories()->attach($req->categories);

		if($req->cover_image == 1)
		{
			$this->updateCoverImageStatus($req->id);
		}
	}

	public function slugify($title)
	{
		return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
	}

	public function updateCoverImageStatus($id)
	{
		Post::where('cover_image','1')->update(['cover_image' => '0']);
		Post::where('id',$id)->update(['cover_image' => '1']);
	}

	public function getPostCoverImage()
	{
		return Post::select('id','title','image_name')->where('cover_image','1')->first();
	}

	public function getSidePanelTab()
	{
		$return_array = array();
		$di = Post::select('division','id','title')->where('division','discoveries-innovations')->where('status',1)->orderBy('datefor', 'desc')->take(5)->get();
		array_push($return_array, $di->toArray());

		$ai = Post::select('division','id','title')->where('division','applications-impacts')->where('status',1)->orderBy('datefor', 'desc')->take(5)->get();
		array_push($return_array, $ai->toArray());

		$ss = Post::select('division','id','title')->where('division','science-society')->where('status',1)->orderBy('datefor', 'desc')->take(5)->get();
		array_push($return_array, $ss->toArray());
		return $return_array;
	}

	public function getTopNewsAndFeaturePosts()
	{
		return Post::with(['tags'])->where('division','news-features')->orderBy('datefor','desc')->take(5)->get();
	}

	public function getNewsAndFeaturePosts()
	{
		return Post::with(['tags'])->where('division','news-features')->orderBy('datefor','desc')->orderBy('id','desc')->paginate(2);
	}
}