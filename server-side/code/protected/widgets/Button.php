<?php
class Button extends CWidget
{
    //属性
	public $id;
	public $property = array();
	public $class;
	public $type = 'button';
	public $name = 'submit';

	//展示
	public $size;
	public $title = '按钮';
	public $highlight = false;
	public $display = true;
	public $badge;

	//行为
	public $url;
	public $click;
	public $ajax;
	public $data = array();
	public $success = '';
	public $confirm = false;

	//多态
	public $switch;
	public $cases = array();

	public function init()
	{
	    //如果为按钮组，先继承属性
		if ( is_a( $this->owner, 'Buttons' ) ) {
			foreach ( $this->owner->options as $key => $value ) {
				if ( !isset( $this->$key ) ) $this->$key = $value;
			}
		}

		//如为多态按钮，按条件进行选择
		if ( isset( $this->switch ) ) {
			foreach ( $this->cases[ $this->switch ] as $key => $value ) {
				$this->$key = $value;
			}
		}
	}

	public function run()
	{
		if ( $this->display ) $this->render( 'button/button' );
	}
}