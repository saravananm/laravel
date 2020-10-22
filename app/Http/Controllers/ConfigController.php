<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Services\ConfigService;

class ConfigController extends Controller
{
    protected $configservice;

	public function __construct(ConfigService $configservice)
	{
		$this->configservice = $configservice;
	}

    public function view()
    {
    	$tags = $this->configservice->configsList();
    	return View('admin.config',['data'=> $tags]);
    }

    public function add(Request $req)
    {

        $validator = $this->configservice->updateValidation($req);
        
    	// error message return
        if ($validator != '') {
            return redirect('configs')->withErrors($validator)->withInput();
        }

    	$this->configservice->updateConfigs($req);
    	return redirect('configs')->with('message', 'Data successfully Updated');
    	
    }
}
