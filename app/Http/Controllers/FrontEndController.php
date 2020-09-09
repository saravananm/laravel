<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CoverImageService;
use App\Services\CategoryService;
use App\Services\HighlightService;
use Input;

class FrontEndController extends Controller
{
	protected $postservice;
	protected $coverimageservice;
    protected $categoryservice;
    protected $highlightservice;

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

    public function discoveriesandinnovationspage(Request $req)
    {
        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('discoveries-innovations', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->allCategories();
        
        $title          = 'Discoveries & Innovations';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories]);
    }

    public function applicationsandimpactspage(Request $req)
    {
        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('applications-impacts', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->allCategories();
        
        $title          = 'Applications & Impacts';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories]);
    }

    public function scienceandsocietypage(Request $req)
    {
        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('science-society', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->allCategories();
        
        $title          = 'Science & Society';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories]);
    }

    public function thescitechjournalpage($my = '')
    {
        $this->coverimageservice = new CoverImageService();
        $this->highlightservice = new HighlightService();
        $post                       = $this->postservice->getTopNewsAndFeaturePosts();
        if($my == '')
            $coverimage             = $this->coverimageservice->getLatestCoverImage();
        else
            $coverimage             = $this->coverimageservice->getCoverImageByFilter($my);
        $highlight                  = $this->highlightservice->getHighlight();
        $coverimagesecongandthired  = $this->coverimageservice->getSecondSndThiredCoverImage();
        return View('thescitechjournal',['data'=> $post, 'coverimage'=>$coverimage, 'highlight'=>$highlight, 'coverimagesecongandthired'=>$coverimagesecongandthired]);
    }

    public function postpage($slug)
    {
    	$post           = $this->postservice->getPostBySlug($slug);
    	return View('post',['post'=> $post]);
    }
}
