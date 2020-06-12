<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;
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

    public function add(Request $req)
    {
        //validation
        if($req->id == ''){ 
            $validator = $this->advertisementservice->saveValidation($req);
        } else {
            $validator = $this->advertisementservice->updateValidation($req);
        }

        // error message return
        if ($validator->fails()) {
            return redirect('advertisements')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
            $validator = $this->advertisementservice->saveAdvertisements($req);
            return redirect('advertisements')->with('message', 'Data successfully Created');
        }else{
            $validator = $this->advertisementservice->updateAdvertisements($req);
            return redirect('advertisements')->with('message', 'Data successfully Updated');
        }
    }

    public function edit($id)
    {
        $edit_data = $this->advertisementservice->getAdvertisements($id);
        $advertisements = $this->advertisementservice->advertisementsList();
        return View('admin.advertisement',['data'=> $advertisements, 'edit_data' => $edit_data]);
    }
}
