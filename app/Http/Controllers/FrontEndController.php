<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CoverImageService;

class FrontEndController extends Controller
{
	protected $postservice;
	protected $coverimageservice;

	public function __construct(Postservice $postservice)
	{
        $this->postservice = $postservice;
	}

    public function homepage()
    {
    	$this->coverimageservice = new CoverImageService();
    	$post           = $this->postservice->getTopNewsAndFeaturePosts();
    	$coverimage     = $this->coverimageservice->getLatestCoverImage();
    	return View('home',['data'=> $post, 'coverimage'=>$coverimage]);
    }

    public function newsandfeaturespage()
    {
        $post           = $this->postservice->getNewsAndFeaturePosts();
        return View('newsandfeatures',['data'=> $post]);
    }

    public function postpage($slug)
    {
    	$post           = $this->postservice->getPostBySlug($slug);
    	return View('post',['post'=> $post]);
    }
}
