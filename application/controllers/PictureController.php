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
	// public function uploadAction()
	// {
	// 	// Проверяем пришел ли файл
	// 	var_dump($_FILES['photo']['size']);
	// 	if(!empty($_FILES['photo']['name']) && $_FILES['photo']['size'] > 0 && $_FILES['photo']['size'] < 5242880) {
	// 		// echo "TUT0";
	// 	  // Проверяем, что при загрузке не произошло ошибок
	// 		if ( $_FILES['photo']['error'] == 0 ) {
	// 		// Если файл загружен успешно, то проверяем - графический ли он
	// 			if( substr($_FILES['photo']['type'], 0, 5) == 'image' ) {
	// 			  // Читаем содержимое файла
	// 				$image = file_get_contents( $_FILES['photo']['tmp_name'] );
	// 			  // echo $image;
	// 				$str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
	// 				$str = str_shuffle($str);
	// 				$picName = substr($str, 0, 10);
	// 				$fname = ROOT.'/public/test/'.$picName.'.png';
	// 				$myfile = fopen($fname, 'x');

	// 				// echo "after open file<br>";

	// 				fwrite($myfile, $image);
	// 				$user = new User();
	// 				$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
	// 				$user_id = $userRow[0]['id'];
	// 				// echo "user id = ".$user_id;

	// 				$link = '../../public/test/'.$picName.'.png';
	// 				// echo "/n link = ".$link;


	// 				$this->model->insertLink($user_id, $link);
	// 				fclose($myfile);
	// 			}
	// 		}
	// 	}
	// }

	public function savePhotoAction()
	{
		// echo "called UserController<br>";
		// var_dump($_POST);
		$user = new User();
		$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
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
		if (isset($_SESSION['isUser']))
			$this->view->render("");
	}

	public function likeAction()
	{
		$user = new User();
		$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
		if ($this->model->likeCheck($_POST['pic_id'], $userRow[0]['id']) == true)
			$this->model->likeAdd($_POST['pic_id'], $userRow[0]['id']);
		else
			$this->model->likeDel($_POST['pic_id'], $userRow[0]['id']);
		echo $this->model->likeCount($_POST['pic_id']);
	}
	
	public function singlePhotoAction()
	{
		$url = trim($_SERVER['REQUEST_URI'], '/');
		$url = "../..".substr($url, 11);
		$row = $this->model->extractPicByLink($url);
		if (isset($_SESSION['isUser']))
			$this->view->render('picture/singlePhoto', $row);
	}

	public function commentAction()
	{
		$txt = htmlspecialchars($_POST['txt'], ENT_QUOTES);
		$id_pic = intval($_POST['id_pic']);

		$user = new User();
		$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
		$picLink = $this->model->extractPicById($id_pic);
		$picLink = substr($picLink[0]['link'], 6);
		$whoPictureBelongs = $user->extractLoginByPic($id_pic);
		$params = array("login" => $whoPictureBelongs, "checkComment" => "yes");
		if ($user->checkSubscription($params) === true && $whoPictureBelongs !== $_SESSION['authorizedUser'])
		{
			$mail_to = $user->extractUserByLogin($whoPictureBelongs);
			$mail_to = $mail_to[0]['email'];
			$mail_subject = 'You got new comment (=^-^=)';
			$mail_message = 'Hey, '.$whoPictureBelongs.'<br>Your <a href="http://localhost:8070/singlePhoto/'.$picLink.'">photo</a> was commented by '.$_SESSION['authorizedUser'].': "'.$_POST['txt'].'".<br>Best regurds, Cramata';
			UserController::sendMail($mail_to, $mail_subject, $mail_message);
		}
		$this->model->insertComment($id_pic, $userRow[0]['id'], $txt);
		echo "<div class='comment-who'>".$_SESSION['authorizedUser'].": </div><div class='comment-txt'>".$txt."</div>";
	}

	public function dellAction()
	{
		if (!empty($_POST) && $_POST['author'] === $_SESSION['authorizedUser'])
		{
			$this->model->dellPic($_POST['toDell']);
		}
	}
}