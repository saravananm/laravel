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

	public function getDivisions()
	{
		return ["news-features"=>"News&Features","discoveries-innovations"=>"Discoveries&Innovations", "applications-impacts"=>"Applications&Impacts", "science-society"=>"Science&Society"];
	}

	public function allCategories()
	{
		return Category::select('id','division','category','order')->where('status',1)->orderBy('division', 'asc')->orderBy('order', 'asc')->get();
	}

	public function getCategoriesByDivision($division)
	{
		return Category::select('id','division','category','order')->where('division',$division)->where('status',1)->orderBy('division', 'asc')->orderBy('order', 'asc')->get();
	}

	public function categoriesList()
	{
		return Category::paginate(10);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
			'division' 		=> 'required',
            'category' 		=> 'required',
    		'order' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
			'division' 		=> 'required',
            'category' 		=> 'required',
    		'order' 		=> 'required',
    		'status' 		=> 'required',
        ]);
	}

	public function saveCategories($req)
	{
		$category 				= new Category;
		$category->division 	= $req->division;
        $category->category 	= $req->category;
        $category->order 		= $req->order;
        $category->status 		= $req->status;
        $category->save();
	}

	public function updateCategories($req)
	{
		$category 				= Category::find($req->id);
		$category->division 	= $req->division;
        $category->category 	= $req->category;
        $category->order 		= $req->order;
        $category->status 		= $req->status;
        $category->save();
	}
}