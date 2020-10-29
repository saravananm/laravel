<?php
namespace App\Services;

use App\Thescitech_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThescitechjournalCategoryService
{
	public function getCategory($id)
	{
		return Thescitech_categories::where('id',$id)->first();
	}

	public function allCategories()
	{
		return Thescitech_categories::select('id','category','order')->where('status',1)->orderBy('order', 'asc')->get();
	}

	public function categoriesList()
	{
		return Thescitech_categories::paginate(10);
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
            'category' 		=> 'required',
    		'order' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function saveCategories($req)
	{
		$category 				= new Thescitech_categories;
        $category->category 	= $req->category;
        $category->order 		= $req->order;
        $category->status 		= $req->status;
        $category->save();
	}

	public function updateCategories($req)
	{
		$category 				= Thescitech_categories::find($req->id);
        $category->category 	= $req->category;
        $category->order 		= $req->order;
        $category->status 		= $req->status;
        $category->save();
	}
}