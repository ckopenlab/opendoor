<?php
class UserController extends Controller
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
	
    public function actionList()
    {
        $this->render( 'list', array(
            'users' => User::model()->findAll( array(
                'condition' => 'level<>"guest"', 
                'order' => 'expire asc'
            ) )
        ) );
    } 
    
    public function actionReview()
    {
        $this->render( 'review', array(
            'users' => User::model()->findAll( array(
                'condition' => 'level=:level', 
            	'params' => array( ':level' => 'guest' ),
                'order' => 'time desc'
            ) )
        ) );
    }
    
    public function actionAccess ( $id, $interval = 0 )
    {
        $user = User::model()->findById( $id );
        if ( $user->level == 'guest' ) $user->level = 'user';
        $user->expire = time() + $interval;
        $user->save();
    }
    
    public function actionRemove ( $id )
    {
        User::model()->findById( $id )->delete();
    }
}