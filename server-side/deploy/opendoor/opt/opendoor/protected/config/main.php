<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'define.php';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Openlab门禁系统',
    'language'=>'zh_cn',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.forms.*',
		'application.components.*',
		'application.helpers.*',
		'application.widgets.*',
	),

	'modules'=>array(
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
			'loginUrl'=>'/site/login',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
		        'open/<token:\w+>'=>'door/open/token/<token>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
            'class'=>'system.db.CDbConnection',
		    'connectionString' => 'sqlite:protected/data/door.db',
		    'charset' => 'utf8',
		    'tablePrefix' => 'tbl_'
		),
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=opendoor',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'aoeuaoeu',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);