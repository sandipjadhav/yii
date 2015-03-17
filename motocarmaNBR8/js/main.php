<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MotocarmaNBR8',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.modules.rights.*',
                'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'test',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
                
                'user'=>array(
                            
                        'tableUsers' => 'tbl_users',
                        'tableProfiles' => 'tbl_profiles',
                        'tableProfileFields' => 'tbl_profiles_fields',
                        
                        # encrypting method (php hash function)
                        'hash' => 'md5',
                        
                        //'class'=>'RWebUser',// Allows super users access implicitly to rights module.
             
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
                'rights'=>array(
                        'install'=>false,
                        'superuserName'=>'admin',    
                        //'userNameColumn'=>'name',
                ),
               'message' => array(
                        'userModel' => 'User',
                        'getNameMethod' => 'getFullName',
                        'getSuggestMethod' => 'getSuggest',
                        'viewPath' => '/message/fancy',
                ),
	),

	// application components
	'components'=>array(
				'user'=>array(
                    // enable cookie-based authentication
                    'class' => 'RWebUser',
                    'allowAutoLogin'=>false,
                    'loginUrl' => array('/user/login'),
                ),
                'authManager'=>array(
                    'class'=>'RDbAuthManager',
                    'connectionID'=>'db',
                    'defaultRoles'=>array('Authenticated', 'Guest'),
                ),
		'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=motocarmanbr8;',//unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
			'emulatePrepare' => true,
			'username' => 'root',
            'password' => '',
			'charset' => 'utf8',
                        'tablePrefix' => 'tbl_',
                        /*'connectionString'   => 'mysql:host=internal-db.s105453.gridserver.com;dbname=db105453_motocarma;',//unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
                        'emulatePrepare'     => true,
			'username'           => 'db105453_admin',
			'password'           => 't@u8hudaTr',
			'charset' => 'utf8',
                        'tablePrefix' => 'tbl_',*/
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>CLogger::LEVEL_TRACE,
					'logfile' => 'debug',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>CLogger::LEVEL_INFO,
					'logfile' => 'info',
				),
				array(
					'class'=>'CWebLogRoute',
					'levels'=>CLogger::LEVEL_WARNING,
				),
				array(
					'class'=>'CProfileLogRoute',
					'levels'=>CLogger::LEVEL_PROFILE,
				),
			),
		),
            'customUtility'=>array(
                                    'class'=>'CustomUtility'
                                ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sandeep.kolte@gmail.com',
        'MAX_GARAGE_COUNT' => 3,
        'COMPARE_ATTRIBUTES' => array('Price', ' Make', ' Model', ' Year', ' Transmission Type', ' Fuel Type', ' Exterior Color', ' Interior Color', ' Navigation', ' Body Trim', ' Driven Wheels (2 or 4)', ' Number of Seats', ' MPG City', ' MPG Highway')
	),
);