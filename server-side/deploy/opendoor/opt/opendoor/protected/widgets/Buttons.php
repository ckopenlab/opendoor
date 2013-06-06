<?php
class Buttons extends CWidget
{
	public $options = array();
	public $buttons = array();
	
	public function init()
	{
		
	}
	
	public function run()
	{
		foreach ( $this->buttons as $button ) {
			$this->widget( 'Button', $button );			
		} 
	}
}