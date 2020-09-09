<?php
namespace App\Services;

use App\Highlight;
use Illuminate\Http\Request;

class HighlightService
{
	public function getHighlight()
	{
		return Highlight::first();
	}

	public function saveHighlight($req)
	{
		$this->clearHighlights();
		$highlight 				= new Highlight;
        $highlight->highlights 	= $req->highlights;
		$highlight->save();
	}

	public function clearHighlights()
	{
		Highlight::truncate();
	}
}