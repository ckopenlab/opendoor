<?php
class AdminController extends Controller
{
    public $layout = 'admin';
    
    public function accessRules()
	{
		return array(
			array( 'allow', 'users' => array( '@' ) ),
			array( 'deny', 'users' => array( '*' ) )
		);
	}

	public function filters()
	{
		return array( 'accessControl' );
	}
    
    public function actionIndex()
    {
        $this->render( 'index', array(
            'guestCount' => User::model()->countByAttributes( array( 'level' => 'guest' ) ),
            'userCount' => User::model()->count( 'level<>"guest"' )
        ) );
    }
}