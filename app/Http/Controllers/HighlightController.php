<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\HighlightService;

class HighlightController extends Controller
{
    protected $highlightService;

	public function __construct(HighlightService $highlightService)
	{
        $this->highlightService = $highlightService;
	}

    public function view()
    {
        $highlight           = $this->highlightService->getHighlight();
    	return View('admin.forthcoming_issue_highlights',['data'=> $highlight]);
    }

    public function add(Request $req)
    {
        $validator = $this->highlightService->saveHighlight($req);
        return redirect('highlights')->with('message', 'Data successfully Updated');
    }
}
