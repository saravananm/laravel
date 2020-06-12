<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\CoverImageService;

class CoverImageController extends Controller
{
    protected $coverimageservice;

	public function __construct(CoverImageService $coverimageservice)
	{
		$this->coverimageservice = $coverimageservice;
	}

    public function view()
    {
    	$coverimages = $this->coverimageservice->coverImagesList();
    	return View('admin.coverimage',['data'=> $coverimages]);
    }

    public function add(Request $req)
    {
    	//validation
    	if($req->id == ''){		
    		$validator = $this->coverimageservice->saveValidation($req);
    	}else{
    		$validator = $this->coverimageservice->updateValidation($req);
    	}
    	// error message return
        if ($validator->fails()) {
            return redirect('coverimages')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
    		$validator = $this->coverimageservice->saveCoverImage($req);
    		return redirect('coverimages')->with('message', 'Data successfully Created');
    	}else{
    		$validator = $this->coverimageservice->updateCoverImage($req);
    		return redirect('coverimages')->with('message', 'Data successfully Updated');
    	}
    }

    public function edit($id)
    {
    	$edit_data = $this->coverimageservice->getCoverImage($id);
    	$coverimages = $this->coverimageservice->coverImagesList();
    	return View('admin.coverimage',['data'=> $coverimages, 'edit_data' => $edit_data]);
    }
}
