<div id="login_form" class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableAjaxValidation'=>true,
	)); ?>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $form->label($model,'username'); ?></th>
        </tr>
		<tr>
			<td>
				<?php echo $form->textField($model,'username'); ?>
				<div class="error"><?php echo $form->error($model,'username'); ?></div>
			</td>
		</tr>
		<tr>
			<th><?php echo $form->label($model,'password'); ?></th>
		</tr>
        <tr>
            <td>
                <?php echo $form->passwordField($model,'password'); ?>
                <div class="error"><?php echo $form->error($model,'password'); ?></div>
            </td>
        </tr>
		<tr>
			<th>
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
			</th>
		</tr>
	</table>
    <center class="buttons">
        <?php $this->widget( 'Button', array( 'type' => 'sumbit', 'title' => '登录管理平台', 'highlight' => true ) ); ?>
    </center>
	<?php $this->endWidget(); ?>
</div>