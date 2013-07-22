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
		        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
            'class'=>'system.db.CDbConnection',
		    'connectionString' => 'sqlite:' . DB_PATH,
		    'charset' => 'utf8',
		    'tablePrefix' => 'tbl_'
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
	),
);