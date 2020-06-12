<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\AdvertisementService;

class AdvertisementController extends Controller
{
    protected $advertisementservice;

	public function __construct(AdvertisementService $advertisementservice)
	{
		$this->advertisementservice = $advertisementservice;
	}

    public function view()
    {
    	$advertisement = $this->advertisementservice->advertisementsList();
    	return View('admin.advertisement',['data'=> $advertisement]);
    }
}
