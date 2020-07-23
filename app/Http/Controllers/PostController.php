<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Storage;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\CategoryService;

class PostController extends Controller
{
    protected $postservice;
    protected $categoryservice;
    protected $tagservice;

	public function __construct(Postservice $postservice, CategoryService $categoryservice, TagService $tagservice)
	{
        $this->postservice = $postservice;
        $this->categoryservice = $categoryservice;
        $this->tagservice = $tagservice;
	}

    public function view()
    {
        $post           = $this->postservice->postsList();
        $divisions      = $this->postservice->getDivisions();
        $categorieslist = $this->categoryservice->allCategories();
        $tags           = $this->tagservice->allTags();
    	return View('admin.post',['data'=> $post, 'divisions'=> $divisions, 'categorieslist' => $categorieslist, 'tags' => $tags]);
    }

    public function add(Request $req)
    {

        //validation
        if($req->id == ''){ 
            $validator = $this->postservice->saveValidation($req);
        } else {
            $validator = $this->postservice->updateValidation($req);
        }

        // error message return
        if ($validator->fails()) {
            return redirect('posts')->withErrors($validator)->withInput();
        }

        // insert or update the records
        if($req->id == ''){ 
            $validator = $this->postservice->saveposts($req);
            return redirect('posts')->with('message', 'Data successfully Created');
        }else{
            $validator = $this->postservice->updateposts($req);
            return redirect('posts')->with('message', 'Data successfully Updated');
        }
    }

    public function edit($id)
    {
        $post           = $this->postservice->postsList();
        $divisions      = $this->postservice->getDivisions();
        $categorieslist = $this->categoryservice->allCategories();
        $tags           = $this->tagservice->allTags();
        $edit_data      = $this->postservice->getposts($id);
    	return View('admin.post',['data'=> $post, 'divisions'=> $divisions, 'categorieslist' => $categorieslist, 'tags' => $tags, 'edit_data' => $edit_data]);
    }
}
