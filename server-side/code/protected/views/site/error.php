<h1>错误 <?= $code ?></h1>
<br/>
<?php echo CHtml::encode($message); ?>
<br/><br/>
<?php $this->widget( 'Button', array( 'title' => '返回', 'click' => 'history.go(-1);' ) ); ?>