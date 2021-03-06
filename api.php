<?php
/*
 * Created on Oct 24, 2013
 * Gallery-Viewer API Backend
 *
 */

function get_username(){
	return "user";	
} 

function get_password(){
	return "passw0rd";
}


function api_get() {
	check_dir();
	if (isset($_GET['rpc']) && $_GET['rpc'] == 'picdir') {
		$result = array();
		if ($handle = opendir('etc')) {
			while (false !== ($file = readdir($handle))) {
				if (strpos($file, '.json') !== false && strpos($file, '.json~') == false) {
					if($file == 'categories.json'){
						continue;
					}
					$result[$file] = (string)file_get_contents('etc/' . $file);
				}
			}
			to_json($result);
			closedir($handle);
		}
	} 
	if (isset($_GET['rpc']) && $_GET['rpc'] == 'catdir') {
		if (file_exists('etc/categories.json')){
			echo (string)file_get_contents('etc/categories.json');
		}else{
			$fp = fopen('etc/categories.json','wb');
			fwrite($fp,'{}');
			fclose($fp);
			echo (string)file_get_contents('etc/categories.json');
		}
		
	}
	else {

	}
}

function api_post() {
	is_auth();
	check_dir();
	if(isset($_POST['rpc']) && $_POST['rpc'] == 'addimg'){
		write_file();
	}
	if(isset($_POST['rpc']) && ($_POST['rpc'] == 'setcat' && $_POST['cat'])){
			$fp = fopen('etc/categories.json','wb');
			fwrite($fp,(string)$_POST['cat']);
			fclose($fp);
	}
	
}
	


function to_json($my_result) {
	$result = '';
	foreach ($my_result as $key => $value)
		$result=$result.'"'.$key . '" :' . $value.',';
	$result=rtrim($result, ',');
	echo('{'.$result.'}');
}

function is_auth() {
	if ((isset($_POST['username']) && $_POST['username'] == get_username()) && (isset($_POST['password']) && $_POST['password'] == get_password())) {
		return;
	} else {
		header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden', true, 403);
		exit ;
	}
}

function check_dir(){
	$dirs = array('img/', 'etc/', 'thumb/');
	foreach($dirs as $dir){
		if(!file_exists($dir)){
			mkdir($dir);
		}
	}
}

function write_descriptor($height, $width){
	$name = $_FILES["file"]["name"];
	$path = 'img/'.$name;
	$path_thumb = 'thumb/'.$name;
	$title = $_POST['title'];
	$description = $_POST['description'];
	$categories = explode(',', $_POST['category']);
	$category = '';
	foreach ($categories as $key => $value) {
		$category = $category.'"'.$value.'",';
	}
	$category = rtrim($category, ",");
	echo($category);
	$stringdata = '{ "path_thumb": "'.$path_thumb.
	'" , "path": "'. $path.
	 '", "title": "'.$title.
	 '", "model": "'.$description.
	 '", "height": '.intval($height).
	 ', "width": '.intval($width).
	 ', "category": ['.$category.']'.
	 '}';
	$file = fopen('etc/'.$title.'.json', 'w');
	fwrite($file, $stringdata);
	fclose($file);
}

function create_thumb($image){
	
	$orig_width = imagesx($image);
	$orig_height = imagesy($image);
	$width = 240;
	$height = (($orig_height * $width) / $orig_width);
	
	$new_image = imagecreatetruecolor($width, $height);
	
	imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
	imagejpeg($new_image, 'thumb/'.$_FILES['file']['name'], 100);
	write_descriptor($height, $width);
}


function write_file() {
	$allowedExts = array("jpeg", "jpg", );
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if (($_FILES["file"]["type"] == "image/jpeg") 
	|| ($_FILES["file"]["type"] == "image/jpg") 
	|| ($_FILES["file"]["type"] == "image/pjpeg") 
	 && in_array($extension, $allowedExts)) {
		if ($_FILES["file"]["error"] > 0) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Error', true, 500);
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 200', true, 200);
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Stored in: " . $_FILES["file"]["tmp_name"];
			move_uploaded_file($_FILES["file"]["tmp_name"], 'img/'.$_FILES['file']['name']);
			create_thumb(imagecreatefromjpeg('img/'.$_FILES['file']['name']));
		}
	} else {
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Error', true, 500);
	}
}

switch($_SERVER['REQUEST_METHOD']) {
	case 'GET' :
		$the_request = &$_GET;
		header('Content-Type: application/json');
		api_get();
		break;
	case 'POST' :
		$the_request = &$_POST;
		api_post();
		break;
	default :
}
?>