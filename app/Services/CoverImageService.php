<?php
namespace App\Services;

use App\Coverimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoverImageService
{
	public function getCoverImage($id)
	{
		return Coverimage::where('id',$id)->first();
	}
	public function coverImagesList()
	{
		return Coverimage::paginate(10);
	}

	public function saveValidation($req)
	{
		return Validator::make($req->all(), [
            'month' 		=> 'required|size:2',
    		'year' 			=> 'required|size:4',
    		'image_name' 	=> 'required|mimes:jpeg,png', 
    		'status' 		=> 'required',
        ]);
	}

	public function updateValidation($req)
	{
		return Validator::make($req->all(), [
            'month' 		=> 'required|size:2',
    		'year' 			=> 'required|size:4',
    		'image_name' 	=> 'mimes:jpeg,png', 
    		'status' 		=> 'required',
        ]);
	}

	public function saveCoverImage($req)
	{
		$cover 				= new Coverimage;
		if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/coverimage');
			$file_path = $req->image_name->hashName();
			$cover->image_name 	= $file_path;
		}
        $cover->month 		= $req->month;
        $cover->year 		= $req->year;
        $cover->status 		= $req->status;
        $cover->save();
	}

	public function updateCoverImage($req)
	{
		$cover 				= Coverimage::find($req->id);
        if($req->hasFile('image_name'))
		{
			$req->image_name->store('public/images/coverimage');
			$file_path = $req->image_name->hashName();
			$cover->image_name 	= $file_path;
		}
        $cover->month 		= $req->month;
        $cover->year 		= $req->year;
        $cover->status 		= $req->status;
        $cover->save();
	}

	public function getLatestCoverImage()
	{
		return Coverimage::orderBy('year','desc')->where('status','1')->orderBy('month','desc')->first();
	}
}