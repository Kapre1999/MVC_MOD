<?php
	function LoadCss($path = Null)
	{
		$css = array();
		if ($path) {
			foreach (glob("css/$path/*.css") as $filename)
			{
				$css = "<link rel='stylesheet' type='text/css' href='$filename'>";
			}
			return $css;
		}
		else{
			foreach (glob("css/*.css") as $filename)
			{
				$css = "<link rel='stylesheet' type='text/css' href='$filename'>";
			}
			return $css;
		}
	}
	function LoadJs($path = Null){
		$js = array();
		if ($path) {
			foreach (glob("js/$path/*.js") as $jsFileName) {
				$js = "<script type='text/javascript' src='$jsFileName'></script>";
			}
			return $js;
		}
		else{
			foreach (glob("js/*.js") as $jsFileName) {
				$js = "<script type='text/javascript' src='$jsFileName'></script>";
			}
			return $js;
		}
	}

	function checkFile($file){
		$imageType =  array("image/jpg", "image/jpeg", "image/bmp", "image/gif","image/png");
		$name = $file['type'];
		if (in_array($name,$imageType)) {
			return "Allowed";
		}
		else{
			return "Not_Allowed";
		}
	}

	function UploadImage($file)
	{
		$imageName = time().$file['image']['name'];
		if (is_dir(UPLOADPATH.'/PostsImages')) {
			$uplodePath = UPLOADPATH.'/PostsImages/'.$imageName;
		}
		else{
			mkdir(UPLOADPATH.'/PostsImages');
			return "DNP404";
		}
		if (move_uploaded_file($file['image']['tmp_name'],$uplodePath)) {
			return getImage($uplodePath);
		}
		else{
			return "File_Upload_Error";
		}
	}

	function getImage($imgPath){
		$img = explode("/",$imgPath);
		$img = end($img);
		return $img;
	}
?>