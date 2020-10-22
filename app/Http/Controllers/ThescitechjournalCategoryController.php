<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\ThescitechjournalCategoryService;

class ThescitechjournalCategoryController extends Controller
{
    protected $categoryservice;

	public function __construct(ThescitechjournalCategoryService $categoryservice)
	{
		$this->categoryservice = $categoryservice;
	}

    public function view()
    {
		$categories = $this->categoryservice->categoriesList();
    	return View('admin.thescitechjournalcategory',['data'=> $categories]);
    }

    public function add(Request $req)
    {
    	//validation
    	if($req->id == ''){		
    		$validator = $this->categoryservice->saveValidation($req);
    	}else{
    		$validator = $this->categoryservice->updateValidation($req);
    	}
    	// error message return
        if ($validator->fails()) {
            return redirect('thescitechjournalcategories')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
    		$validator = $this->categoryservice->saveCategories($req);
    		return redirect('thescitechjournalcategories')->with('message', 'Data successfully Created');
    	}else{
    		$validator = $this->categoryservice->updateCategories($req);
    		return redirect('thescitechjournalcategories')->with('message', 'Data successfully Updated');
    	}
    }

    public function edit($id)
    {
    	$edit_data = $this->categoryservice->getCategory($id);
		$categories = $this->categoryservice->categoriesList();
    	return View('admin.thescitechjournalcategory',['data'=> $categories, 'edit_data' => $edit_data]);
    }
}
