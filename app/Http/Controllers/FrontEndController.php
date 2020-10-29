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
       // echo '<pre>'; print_r($post); die;
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
        $postcoverimage                 = $this->postservice->getPostCoverImage();
        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('discoveries-innovations', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->getCategoriesByDivision('discoveries-innovations');
        
        $title          = 'Discoveries & Innovations';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner, 'postcoverimage' => $postcoverimage]);
    }

    public function applicationsandimpactspage(Request $req)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        $postcoverimage                 = $this->postservice->getPostCoverImage();

        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('applications-impacts', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->getCategoriesByDivision('applications-impacts');
        
        $title          = 'Applications & Impacts';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner, 'postcoverimage' => $postcoverimage]);
    }

    public function scienceandsocietypage(Request $req)
    {
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        $postcoverimage                 = $this->postservice->getPostCoverImage();
        
        $selectedcategories = [];
        if($req->input('selectedcategories') != '')
        $selectedcategories = explode(',',$req->input('selectedcategories'));

        $post           = $this->postservice->getPostsByFilters('science-society', $selectedcategories);

        $this->coverimageservice    = new CoverImageService();
        $coverimage     = $this->coverimageservice->getLatestCoverImage();

        $this->categoryservice      = new CategoryService();
        $categories      = $this->categoryservice->getCategoriesByDivision('science-society');
        
        $title          = 'Science & Society';
        return View('discoveries-innovations-applications-impacts-science-society',['data' => $post, 'coverimage' => $coverimage, 'title' => $title, 'categories' => $categories, 'selectedcategories' => $selectedcategories, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom, 'advertisementdetails_banner' => $advertisementdetails_banner, 'postcoverimage' => $postcoverimage]);
    }

    public function thescitechjournalpage($my = '')
    {
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        $advertisementdetails_top       = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_top');
        $sidepaneltabdetails            = $this->postservice->getSidePanelTab();
        $advertisementdetails_bottom    = $this->advertisementservice->getAdvertisementsByPosition('sidepanel_bottom');
        $this->coverimageservice        = new CoverImageService();
        $this->highlightservice         = new HighlightService();
        $this->thescitechjournalpostservice    = new ThescitechjournalpostService();
        $coverImageYearMonths           = $this->coverimageservice->getCoverImageYearsMonths();
        if($my == '')
        {
            $Latestcoverimage           = $this->coverimageservice->getLatestCoverImage();
            $my                         = $Latestcoverimage->month.'-'.$Latestcoverimage->year;
        }
       
        $coverimage                     = $this->coverimageservice->getCoverImageByFilter($my);
        $thescitechjournalpost          = $this->thescitechjournalpostservice->getThescitechPosts($my);
        $my_array                       = explode("-",$my);
        $month                          = $my_array[0];
        $year                           = $my_array[1];
        $monthname                      = array ('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');

        return View('thescitechjournal',['coverimage'=>$coverimage, 'advertisementdetails_banner' => $advertisementdetails_banner, 'data' => $thescitechjournalpost, 'advertisementdetails_top' => $advertisementdetails_top, 'sidepaneltabdetails' => $sidepaneltabdetails, 'advertisementdetails_bottom' => $advertisementdetails_bottom,'coverImageYearMonths' => $coverImageYearMonths, 'selmonth' => $month, 'selyear' => $year, 'monthname' => $monthname]);
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

    public function thescitechjournallistpage($my = '')
    {
        $this->coverimageservice        = new CoverImageService();
        $advertisementdetails_banner    = $this->advertisementservice->getAdvertisementsByPosition('banner');
        $coverImageYearMonths                 = $this->coverimageservice->getCoverImageYearsMonths();
        $Latestcoverimage                 = $this->coverimageservice->getLatestCoverImage();
        if($my == '')
        {
            $month  = $Latestcoverimage->month;
            $year   = $Latestcoverimage->year;
        }
        else
        {
            $my_array = explode("-",$my);
            $month  = $my_array[1];
            $year   = $my_array[0];
        }
        $monthname = array ('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
        return View('thescitechjournallist',['advertisementdetails_banner' => $advertisementdetails_banner,'coverImageYearMonths' => $coverImageYearMonths, 'selmonth' => $month, 'selyear' => $year, 'monthname' => $monthname]);
    }
}
