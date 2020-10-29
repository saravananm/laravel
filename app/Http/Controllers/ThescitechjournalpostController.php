<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;
use App\Services\ThescitechjournalpostService;
use App\Services\TagService;
use App\Services\CoverImageService;
use App\Services\ThescitechjournalCategoryService;

class ThescitechjournalpostController extends Controller
{
    protected $thescitechjournalpostservice;
    protected $tagservice;
    protected $coverimageservice;

	public function __construct(Thescitechjournalpostservice $thescitechjournalpostservice, TagService $tagservice, CoverImageService $coverimageservice, ThescitechjournalCategoryService $categoryservice)
	{
        $this->thescitechjournalpostservice = $thescitechjournalpostservice;
        $this->tagservice 					= $tagservice;
        $this->coverimageservice 			= $coverimageservice;
        $this->categoryservice              = $categoryservice;
	}

	public function view()
    {
        $post           = $this->thescitechjournalpostservice->postsList();
        $tags           = $this->tagservice->allTags();
        $coverimages    = $this->coverimageservice->allCoverImages();
        $categorieslist = $this->categoryservice->allCategories();
    	return View('admin.thescitechjournalpost',['data'=> $post, 'tags' => $tags, 'coverimages' => $coverimages, 'categorieslist' => $categorieslist]);
    }

     public function add(Request $req)
    {

        //validation
        if($req->id == ''){ 
            $validator = $this->thescitechjournalpostservice->saveValidation($req);
        } else {
            $validator = $this->thescitechjournalpostservice->updateValidation($req);
        }

        // error message return
        if ($validator->fails()) {
            return redirect('thescitechjournalposts')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
            $validator = $this->thescitechjournalpostservice->saveposts($req);
            return redirect('thescitechjournalposts')->with('message', 'Data successfully Created');
        }else{
            $validator = $this->thescitechjournalpostservice->updateposts($req);
            return redirect('thescitechjournalposts')->with('message', 'Data successfully Updated');
        }
    }

    public function edit($id)
    {
        $post           = $this->thescitechjournalpostservice->postsList();
       	$tags           = $this->tagservice->allTags();
        $coverimages    = $this->coverimageservice->allCoverImages();
        $edit_data      = $this->thescitechjournalpostservice->getposts($id);
        $categorieslist = $this->categoryservice->allCategories();
    	return View('admin.thescitechjournalpost',['data'=> $post, 'tags' => $tags, 'coverimages' => $coverimages, 'edit_data' => $edit_data, 'categorieslist' => $categorieslist]);
    }
}
