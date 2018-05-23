<?php

namespace application\controllers;

use application\components\Controller;
use application\components\View;
use application\lib\Db;

class PictureController extends Controller
{
	public function uploadAction()
	{
				// Проверяем пришел ли файл
		if( !empty( $_FILES['image']['name'] ) ) {
		  // Проверяем, что при загрузке не произошло ошибок
		  if ( $_FILES['image']['error'] == 0 ) {
		    // Если файл загружен успешно, то проверяем - графический ли он
		    if( substr($_FILES['image']['type'], 0, 5)=='image' ) {
		      // Читаем содержимое файла
		      $image = file_get_contents( $_FILES['image']['tmp_name'] );
		      $image = base64_encode($image);
		      print_r($image);
		      $this->model->insertFile($image);
		      // Экранируем специальные символы в содержимом файла
		      // $image = mysql_escape_string( $image );
		      // Формируем запрос на добавление файла в базу данных
		      // $query="INSERT INTO pics(link)VALUES('".$image."')";
		      // После чего остается только выполнить данный запрос к базе данных
		      // mysql_query( $query );
		    }
		  }
		}
	}
}