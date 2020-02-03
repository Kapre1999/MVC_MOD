<?php 

/**
 * Base Controller Class
 * Loads The Model And Views
 */
class Controller
{
	public function model($model)
	{
		//Require The Model File And Check if file exists
		require_once '../app/models/'.$model.'.php';
		return new $model;
	}

	public function view($view , $data = [])
	{
		//Check for the file existance
		if (file_exists('../app/views/'.$view.'.php')) {
			//
			//require the view file
			require_once '../app/views/'.$view.'.php';
		}
		else{
			//if not existst
			die("VIEW DOES NOT EXISTS");
		}
	}

}


?>