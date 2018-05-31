<?php

namespace application\controllers;

use application\components\Controller;
use application\components\View;
use application\controllers\UserController;
use application\components\Model;
use application\models\User;



use application\lib\Db;

class PictureController extends Controller
{
	public function uploadAction()
	{
				// Проверяем пришел ли файл
		if( !empty( $_FILES['photo']['name'] ) ) {
		  // Проверяем, что при загрузке не произошло ошибок
		  if ( $_FILES['photo']['error'] == 0 ) {
		    // Если файл загружен успешно, то проверяем - графический ли он
		    if( substr($_FILES['photo']['type'], 0, 5) == 'image' ) {
		      // Читаем содержимое файла
		      $image = file_get_contents( $_FILES['photo']['tmp_name'] );
		      // echo $image;
		      $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
	        $str = str_shuffle($str);
	        $picName = substr($str, 0, 10);
			$fname = ROOT.'/public/test/'.$picName.'.png';
			$myfile = fopen($fname, 'x');

			// echo "after open file<br>";

			fwrite($myfile, $image);
			$user = new User();
		$userRow = $user->extractUsersByLogin($_SESSION['authorizedUser']);
		$user_id = $userRow[0]['id'];
		echo "user id = ".$user_id;

		$link = '../../public/test/'.$picName.'.png';
		echo "/n link = ".$link;


		$this->model->insertLink($user_id, $link);
		fclose($myfile);
		    }
		  }
		}
	}

	public function savePhotoAction()
	{
		// echo "called UserController<br>";

		$user = new User();
		$userRow = $user->extractUsersByLogin($_SESSION['authorizedUser']);
		$img = str_replace('data:image/png;base64,', '', $_POST['image']);
		$img = str_replace(' ', '+', $img);
		
		$img = base64_decode($img);
		// echo "after base64 img<br>";
		$str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
        $str = str_shuffle($str);
        $picName = substr($str, 0, 10);
		$fname = ROOT.'/public/test/'.$picName.'.png';
		$myfile = fopen($fname, 'x');

		// echo "after open file<br>";

		fwrite($myfile, $img);

		// echo "tipe zapisali v file<br>";

		// var_dump($userRow);
		// echo "<br>";

		$user_id = $userRow[0]['id'];

		$link = '../../public/test/'.$picName.'.png';

		$this->model->insertLink($user_id, $link);
		fclose($myfile);
	}

	public function indexAction()
	{
		$this->view->render("");
	}

	public function likeAction()
	{
		$user = new User();
		$userRow = $user->extractUsersByLogin($_SESSION['authorizedUser']);
		// print_r($_POST);
		// print_r($userRow);
		// $pic = $this->model->extractPicById($_POST['link']);
		// print_r("pictue id = ".$pic);
		if ($this->model->likeCheck($_POST['link'], $userRow[0]['id']) == null)
			$this->model->likeAdd($_POST['link'], $userRow[0]['id']);
		else
			$this->model->likeDel($_POST['link'], $userRow[0]['id']);
		echo $this->model->likeCount($_POST['link']);
	}
}