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

	'home' => [
		'controller' => 'home',
		'action' => 'index',
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

	'logout' => [
			'controller' => 'user',
			'action' => 'logout',
		],	

	'about' => [
		'controller' => 'about',
		'action' => 'view',
	],

];