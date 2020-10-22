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
		return ["discoveries-innovations"=>"Discoveries&Innovations", "applications-impacts"=>"Applications&Impacts", "science-society"=>"Science&Society"];
	}

	public function getPosts($id)
	{
		return Post::with(['tags','categories'])->where('id',$id)->first();
	}

	public function getPostBySlug($slug)
	{
		$post =  Post::with(['tags','categories'])->where('slug',$slug)->first();
		$division = $this->getDivisions();
		return $post;
	}

	public function postsList()
	{
		return Post::orderBy('id','desc')->paginate(10);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
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
		$di = Post::select('division','posts.id','title')->join('post_categories', 'posts.id', '=', 'post_categories.post_id')->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->where('division','discoveries-innovations')->where('posts.status',1)->orderBy('datefor', 'desc')->take(5)->get();
		array_push($return_array, $di->toArray());

		$ai = Post::select('division','posts.id','title')->join('post_categories', 'posts.id', '=', 'post_categories.post_id')->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->where('division','applications-impacts')->where('posts.status',1)->orderBy('datefor', 'desc')->take(5)->get();
		array_push($return_array, $ai->toArray());

		$ss = Post::select('division','posts.id','title')->join('post_categories', 'posts.id', '=', 'post_categories.post_id')->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->where('division','science-society')->where('posts.status',1)->orderBy('datefor', 'desc')->take(5)->get();
		array_push($return_array, $ss->toArray());
		return $return_array;
	}

	public function getTopNewsAndFeaturePosts()
	{
		return Post::with(['tags'])->join('post_categories', 'posts.id', '=', 'post_categories.post_id')->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->groupBy('posts.id')->orderBy('datefor','desc')->take(5)->get();
	}

	public function getPostsByFilters($division, $categories)
	{
		if(empty($categories))
			return Post::with(['tags'])->join('post_categories', 'posts.id', '=', 'post_categories.post_id')->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->where('division',"$division")->groupBy('posts.id')->orderBy('datefor','desc')->paginate(10);
		else
			return Post::join('post_categories', 'posts.id', '=', 'post_categories.post_id')->with(['tags'])->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->where('division',$division)->whereIn('categorie_id',$categories)->orderBy('datefor','desc')->paginate(10);

	}

	public function getNewsAndFeaturePosts()
	{ 
		return Post::with(['tags'])->join('post_categories', 'posts.id', '=', 'post_categories.post_id')->join('categories', 'post_categories.categorie_id', '=', 'categories.id')->groupBy('posts.id')->orderBy('posts.id','desc')->paginate(3);
	}
}