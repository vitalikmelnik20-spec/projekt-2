<?php
	function random_image($ext, $folder = "."){

		$img = null;

		if(substr($folder, -1) != "/"){
			$folder = $folder."/";
		}

		if(isset($_GET["img"])){

			$imageInfo = pathinfo($_GET["img"]);

			if(isset($ext[strtolower($imageInfo["extension"])]) &&
			   file_exists($folder.$imageInfo["basename"])){
				$img = $folder.$imageInfo["basename"];
			}

		}else{

			$fileList = array();
			$handle = opendir($folder);

			while(false !== ($file = readdir($handle))){

				$file_info = pathinfo($file);

				if(isset($ext[strtolower($file_info["extension"])])){
					$fileList[] = $file;
				}
			}

			closedir($handle);

			if(count($fileList) > 0){

				$imageNumber = time() % count($fileList);
				$img = $folder.$fileList[$imageNumber];
			}
		}

		if($img != null){

			$imageInfo   = pathinfo($img);
			$contentType = "Content-type: ".$ext[$imageInfo["extension"]];
			header($contentType);
			readfile($img);
		}else{

			if(function_exists("imagecreate")){

				header("Content-type: image/png");

				$im = @imagecreate(100, 100) or die("Cannot initialize new GD image stream");

				$background_color = imagecolorallocate($im, 255, 255, 255);
				$text_color = imagecolorallocate($im, 0, 0, 0);

				imagestring($im, 2, 5, 5,  "IMAGE ERROR", $text_color);
				imagepng($im);
				imagedestroy($im);
			}
		}
	}

	random_image(array(

		"gif"  => "image/gif",
		"jpg"  => "image/jpeg",
		"jpeg" => "image/jpeg",
		"png"  => "image/png"
	));
?>