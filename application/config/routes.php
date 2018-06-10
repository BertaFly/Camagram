<?php

// return array(
//     '' => 'home/view',
//     'about' => 'about/view',
//     'user' => 'user/signin', //actionSignin in UserController
// );

return [

	'' => [
		'controller' => 'home',
		'action' => 'index',
	],

	'home(.*)' => [
		'controller' => 'home',
		'action' => 'index',
	],

	'picture/upload' => [
		'controller' => 'picture',
		'action' => 'upload',
	],

	'picture/like' => [
		'controller' => 'picture',
		'action' => 'like',
	],
	
	'[\w.\-\s\/]{0,25}PictureController(.*)' => [
		'controller' => 'picture',
		'action' => 'savePhoto',
	],

	'picture/camera' => [
		'controller' => 'picture',
		'action' => 'index',
	],

	'picture/comment' => [
		'controller' => 'picture',
		'action' => 'comment',
	],

	'picture/dell' => [
		'controller' => 'picture',
		'action' => 'dell',
	],

	'(.*)singlePhoto/(.*)' => [
		'controller' => 'picture',
		'action' => 'singlePhoto',
	],

	'user/login' => [
		'controller' => 'user',
		'action' => 'login',
	],

	'user/signin' => [
		'controller' => 'user',
		'action' => 'signin',
	],

	'user/confirm' => [
		'controller' => 'user',
		'action' => 'confirm',
	],

	'user/confirmEmail/(.*)' => [
		'controller' => 'user',
		'action' => 'confirmEmail',
	],

	'user/resetPass/initial(.*)' => [
		'controller' => 'user',
		'action' => 'resetPass',
	],

	'user/resetPass/after' => [
		'controller' => 'user',
		'action' => 'resetPassAfter',
	],

	'(.*)logout' => [
		'controller' => 'user',
		'action' => 'logout',
	],

	'user/cabinet' => [
		'controller' => 'user',
		'action' => 'cabinet',
	],

	'user/changeLogin' => [
		'controller' => 'user',
		'action' => 'changeLogin',
	],

	'user/changePass' => [
		'controller' => 'user',
		'action' => 'changePass',
	],

	'user/changeEmail' => [
		'controller' => 'user',
		'action' => 'changeEmail',
	],

	'user/changeSubscription(.*)' => [
		'controller' => 'user',
		'action' => 'changeSubscription',
	],

	'about' => [
		'controller' => 'about',
		'action' => 'view',
	],

];