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
	public function savePhotoAction()
	{
		if (isset($_SESSION['isUser']))
		{
			$user = new User();
			$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
			$img = str_replace('data:image/png;base64,', '', $_POST['image']);
			$img = str_replace(' ', '+', $img);
			$img = base64_decode($img);
			$str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
			$str = str_shuffle($str);
			$picName = substr($str, 0, 10);
			$fname = ROOT.'/public/test/'.$picName.'.png';
			$myfile = fopen($fname, 'x');
			fwrite($myfile, $img);
			$user_id = $userRow[0]['id'];
			$link = '../../public/test/'.$picName.'.png';
			$this->model->insertLink($user_id, $link);
			fclose($myfile);
		}
		else
		{
			View::errorCode(404);
			header('refresh:3; url=http://localhost:8100/user/login');
		}
	}

	public function indexAction()
	{
		if (isset($_SESSION['isUser']))
			$this->view->render("");
		else
		{
			View::errorCode(404);
			header('refresh:3; url=http://localhost:8100/user/login');
		}
	}

	public function likeAction()
	{
		if (isset($_SESSION['isUser']))
		{
			$user = new User();
			$userRow = $user->extractUserByLogin($_SESSION['authorizedUser']);
			if ($this->model->likeCheck($_POST['pic_id'], $userRow[0]['id']) == true)
				$this->model->likeAdd($_POST['pic_id'], $userRow[0]['id']);
			else
				$this->model->likeDel($_POST['pic_id'], $userRow[0]['id']);
			echo $this->model->likeCount($_POST['pic_id']);
		}
		else
		{
			View::errorCode(404);
			header('refresh:3; url=http://localhost:8100/user/login');
		}
	}
	
	public function singlePhotoAction()
	{
		if (isset($_SESSION['isUser']))
		{
			$url = trim($_SERVER['REQUEST_URI'], '/');
			$url = "../..".substr($url, 11);
			$row = $this->model->extractPicByLink($url);
			if (isset($_SESSION['isUser']))
				$this->view->render('picture/singlePhoto', $row);
		}
		else
		{
			View::errorCode(404);
			header('refresh:3; url=http://localhost:8100/user/login');
		}
	}

	public function commentAction()
	{
		if (isset($_SESSION['isUser']))
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
				$mail_message = 'Hey, '.$whoPictureBelongs.'<br>Your <a href="http://localhost:8100/singlePhoto/'.$picLink.'">photo</a> was commented by '.$_SESSION['authorizedUser'].': "'.$_POST['txt'].'".<br>Best regurds, Cramata';
				UserController::sendMail($mail_to, $mail_subject, $mail_message);
			}
			$this->model->insertComment($id_pic, $userRow[0]['id'], $txt);
			echo "<div class='comment-who'>".$_SESSION['authorizedUser'].": </div><div class='comment-txt'>".$txt."</div>";
		}
		else
		{
			View::errorCode(404);
			header('refresh:3; url=http://localhost:8100/user/login');
		}
	}

	public function dellAction()
	{
		if (!empty($_POST) && $_POST['author'] === $_SESSION['authorizedUser'])
		{
			$this->model->dellPic($_POST['toDell']);
		}
		else
		{
			View::errorCode(404);
			header('refresh:3; url=http://localhost:8100/user/login');
		}
	}
}