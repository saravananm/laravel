<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryservice;

	public function __construct(CategoryService $categoryservice)
	{
		$this->categoryservice = $categoryservice;
	}

    public function view()
    {
    	$categories = $this->categoryservice->categoriesList();
    	return View('admin.category',['data'=> $categories]);
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
            return redirect('categories')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
    		$validator = $this->categoryservice->saveCategories($req);
    		return redirect('categories')->with('message', 'Data successfully Created');
    	}else{
    		$validator = $this->categoryservice->updateCategories($req);
    		return redirect('categories')->with('message', 'Data successfully Updated');
    	}
    }

    public function edit($id)
    {
    	$edit_data = $this->categoryservice->getCategory($id);
    	$categories = $this->categoryservice->categoriesList();
    	return View('admin.category',['data'=> $categories, 'edit_data' => $edit_data]);
    }
}
