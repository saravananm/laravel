<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\TagService;

class TagController extends Controller
{
	protected $tagservice;

	public function __construct(TagService $tagservice)
	{
		$this->tagservice = $tagservice;
	}

    public function view()
    {
    	$tags = $this->tagservice->tagsList();
    	return View('admin.tag',['data'=> $tags]);
    }

    public function add(Request $req)
    {
    	//validation
    	if($req->id == ''){		
    		$validator = $this->tagservice->saveValidation($req);
    	}else{
    		$validator = $this->tagservice->updateValidation($req);
    	}
    	// error message return
        if ($validator->fails()) {
            return redirect('tags')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
    		$validator = $this->tagservice->saveTags($req);
    		return redirect('tags')->with('message', 'Data successfully Created');
    	}else{
    		$validator = $this->tagservice->updateTags($req);
    		return redirect('tags')->with('message', 'Data successfully Updated');
    	}
    }

    public function edit($id)
    {
    	$edit_data = $this->tagservice->getTag($id);
    	$tags = $this->tagservice->tagsList();
    	return View('admin.tag',['data'=> $tags, 'edit_data' => $edit_data]);
    }
}
