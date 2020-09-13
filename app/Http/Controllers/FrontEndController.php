<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CoverImageService;
use App\Services\CategoryService;
use App\Services\HighlightService;
use App\Services\AdvertisementService;
use App\Services\ThescitechjournalpostService;
use Input;

class FrontEndController extends Controller
{
	protected $postservice;
	protected $coverimageservice;
    protected $categoryservice;
    protected $highlightservice;
    protected $advertisementservice;
    protected $thescitechjournalpostservice;

	public function __construct(Postservice $postservice, AdvertisementService $advertisementservice)
	{
        $this->postservice = $postservice;
        $this->advertisementservice = $advertisementservice;
	}

    public function homepage()
    {
    	$this->coverimageservice = new CoverImageService();
    	$post                           = $this->postservice->getTopNewsAndFeaturePosts();
        $postcoverimage                 = $this->postservice->getPostCoverImage();
    	$coverimage                     = $this->coverimageservice->getLatestCoverImage();

        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');

    	return View('home',['data'=> $post, 'coverimage'=>$coverimage, 'postcoverimage' => $postcoverimage, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }

    public function newsandfeaturespage()
    {
        $post           = $this->postservice->getNewsAndFeaturePosts();
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        return View('newsandfeatures',['data'=> $post, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }

    public function discoveriesandinnovationspage(Request $req)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');

        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('discoveries-innovations', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->allCategories();
        
        $title          = 'Discoveries & Innovations';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }

    public function applicationsandimpactspage(Request $req)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');

        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('applications-impacts', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->allCategories();
        
        $title          = 'Applications & Impacts';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }

    public function scienceandsocietypage(Request $req)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');

        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('science-society', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->allCategories();
        
        $title          = 'Science & Society';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }

    public function thescitechjournalpage($my = '')
    {
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        $this->coverimageservice        = new CoverImageService();
        $this->highlightservice         = new HighlightService();
        $this->thescitechjournalpostservice    = new ThescitechjournalpostService();
        $post                           = $this->postservice->getTopNewsAndFeaturePosts();

        if($my == '')
        {
            $coverimage                 = $this->coverimageservice->getLatestCoverImage();
            $cover_image_month_year     = $coverimage ->month.'-'.$coverimage->year;
            $thescitechjournalpost      = $this->thescitechjournalpostservice->getThescitechPosts($cover_image_month_year);
        }
        else
        {
            $coverimage                 = $this->coverimageservice->getCoverImageByFilter($my);
            $thescitechjournalpost      = $this->thescitechjournalpostservice->getThescitechPosts($my);
        }

        $highlight                      = $this->highlightservice->getHighlight();

        $coverimagesecongandthired      = $this->coverimageservice->getSecondSndThiredCoverImage();
        return View('thescitechjournal',['data'=> $post, 'coverimage'=>$coverimage, 'highlight'=>$highlight, 'coverimagesecongandthired'=>$coverimagesecongandthired, 'advertisementdetails_banner' => $advertisementdetails_banner, 'thescitechjournalpost' => $thescitechjournalpost]);
    }

    public function postpage($slug)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        
    	$post           = $this->postservice->getPostBySlug($slug);
    	return View('post',['post'=> $post, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }

    public function thescitechjournalpostpage($slug)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        $this->thescitechjournalpostservice    = new ThescitechjournalpostService();
        $post           = $this->thescitechjournalpostservice->getPostBySlug($slug);
        return View('thescitechjournalpost',['post'=> $post, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner]);
    }
}
