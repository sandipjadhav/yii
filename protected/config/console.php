<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MotocarmaNBR8',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		'db'=>array(
			/*'connectionString' => 'mysql:host=localhost;dbname=motocarmaNBR8;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',*/
                        'connectionString'   => 'mysql:host=internal-db.s105453.gridserver.com;dbname=db105453_motocarma;',//unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
                        'emulatePrepare'     => true,
			'username'           => 'db105453_admin',
			'password'           => 't@u8hudaTr',
			'charset' => 'utf8',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
    'modules'=>array(
            'user'=>array(
                # encrypting method (php hash function)
                'hash' => 'md5',
     
                # send activation email
                'sendActivationMail' => true,
     
                # allow access for non-activated users
                'loginNotActiv' => false,
     
                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,
     
                # automatically login from registration
                'autoLogin' => true,
     
                # registration path
                'registrationUrl' => array('/user/registration'),
     
                # recovery password path
                'recoveryUrl' => array('/user/recovery'),
     
                # login form path
                'loginUrl' => array('/user/login'),
     
                # page after login
                'returnUrl' => array('/user/profile'),
     
                # page after logout
                'returnLogoutUrl' => array('/user/login'),
            ),
        ),
);