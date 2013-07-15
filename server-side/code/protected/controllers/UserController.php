<?php
class UserController extends Controller
{
    public $layout = 'admin';
    
    public function accessRules()
	{
		return array(
			array( 'allow', 'users' => array( '@' ) ),
			array( 'allow', 'users' => array( '*' ), 'actions' => array( 'status', 'register' ) ),
			array( 'deny', 'users' => array( '*' ) )
		);
	}

	public function filters()
	{
		return array( 'accessControl' );
	}
	
	public function actionStatus ( $phoneUDID )
	{
		$user = User::model()->findByUDID( $phoneUDID );
		
		if ( !$user )                  $this->printStatus( 'new' );
		if ( $user->level == 'guest' ) $this->printStatus( 'review' );
		if ( $user->isExpired() )	   $this->printStatus( 'expired' );
		
		$this->printStatus( 'normal' ); 
		
	}
	
	public function actionRegister ( $phoneUDID, $phoneModel, $name )
	{
		if ( !User::isValidName( $name ) ) {
			$this->fail( ErrorCode::INVALID_PARAM, array( 'param' => 'name' ) );	
		}
		if ( User::model()->findByUDID( $phoneUDID ) || User::model()->findByName( $name ) ) {
			$this->fail( ErrorCode::REGISTERED );
		}
		User::model()->create(array(
			'username' => $name, 
			'udid'     => $phoneUDID,
			'model'    => $phoneModel
		));
		$this->success(array( 'status' => 'ok' ));
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
    
    public function printStatus ( $status )
    {
 		$this->success( array(
 			'status' => $status,
 			'notice' => Door::log() 
 		) );   	
    }
}