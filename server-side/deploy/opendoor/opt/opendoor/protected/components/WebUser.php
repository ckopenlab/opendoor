<?php
class WebUser extends CWebUser
{
	public function init()
	{
		parent::init();
		if ( !$this->hasState( 'isAdmin' ) ) {
			$this->setState( 'isAdmin', false );	
		}
	}	
}