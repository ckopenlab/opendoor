<?php
class DoorController extends Controller
{
    public $layout = 'simple';
    
    public function actionOpen ( $token )
    {
        $user = User::model()->findByAttributes( array( 'token' => $token ) );
        
        //如token未记录则为访客，跳转到欢迎页面
        if ( !$user ) {
            $this->actionWelcome( $token );
            Yii::app()->end();   
        }
        
        //如果token未过期则开门
        if ( $this->checkAccess( $user ) ) {
            Door::open();
            $this->render( 'opened' );
        }
    }
    
    public function actionWelcome ( $token )
    {
        User::model()->create( array( 'token' => $token ) );
        $this->render( 'reviewing' );
    }
    
    private function checkAccess ( $user )
    {
        //未通过审核，不能开门
        if ( $user->isGuest() ) { $this->render( 'reviewing' ); return false; }
        
        //token已过期，不能开门
        if ( $user->isExpired() ) { $this->render( 'expired' ); return false; }
        
        //权限正常，可以开门
        return true;
    }
}