<?php
namespace App\Services;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
	public function getCategory($id)
	{
		return Category::where('id',$id)->first();
	}
	public function categoriesList()
	{
		return Category::paginate(3);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
            'category' 		=> 'required',
    		'order' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
            'category' 			=> 'required|unique:categories,category,'.$req->id,
    		'order' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function saveCategories($req)
	{
		$category 				= new Category;
        $category->category 	= $req->category;
        $category->order 		= $req->order;
        $category->status 		= $req->status;
        $category->save();
	}

	public function updateCategories($req)
	{
		$category 				= Category::find($req->id);
        $category->category 	= $req->category;
        $category->order 		= $req->order;
        $category->status 		= $req->status;
        $category->save();
	}
}