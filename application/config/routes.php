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

	'[\w.\-\s\/]{0,25}upload(\W|$)' => [
		'controller' => 'picture',
		'action' => 'upload',
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

	'[\w.\-\s\/]{0,25}logout(\W|$)' => [
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

	'about' => [
		'controller' => 'about',
		'action' => 'view',
	],

];