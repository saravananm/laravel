<?php
namespace App\Services;

use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigService
{

	public function configsList()
	{
		return Config::get();
	}

	public function updateValidation($req)
	{
		/*return Validator::make($req->all(), [
            'config_key' 		=> 'required|unique:configs|min:2',
    		'config_value' 		=> 'required'
		]);*/
		foreach($req->all() as $key => $val)
		{
			if(substr($key,0, 9) == 'configkey')
			{
				foreach($req->all() as $lkey => $lval)
				{
					if((substr($lkey,0, 9) == 'configkey') && $key != $lkey)
					{
						if($val == $lval)
						{
							return 'Config Key should be unique';
						}
					}
				}
			}
		}
		return '';
	}

	public function updateConfigs($req)
	{
		$this->clearConfigs();
		foreach($req->all() as $key => $val)
		{
			if(substr($key,0, 9) == 'configkey')
			{
				$no =  str_replace("configkey","",$key);
				$config 						= new Config;
				$keylab = 'configkey'.$no;
				$vallab = 'configvalue'.$no;
				//echo $req->$keylab; echo '<br />';
				$config->config_key 			= $req->$keylab;
				$config->config_value 		= $req->$vallab;
				$config->save();
			}
		}
	}

	public function clearConfigs()
	{
		Config::truncate();
	}
}