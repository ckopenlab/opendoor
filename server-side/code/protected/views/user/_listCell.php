<div class="box" id="user_<?= $user->id ?>">
	<span class="username <?= $user->level ?>">
		<?= $user->username ? $user->username : '游客' . $user->id ?>
		(<?= $user->levelName ?>)
	</span>
	<?php if ( $user->expire > time() ):?>
    <span class="time"><?= Time::interval( $user->expire ) ?>过期</span>
    <?php else:?>
    <span class="time expired">已过期</span>
    <?php endif;?>
    <span class="token"><?= $user->model ?> (<?= $user->udid ?>)</span>
    <div class="buttons">
    <?php 
    $this->widget( 'Buttons', array( 
    	'options' => array( 'size' => 'normal', 'class' => 'fl' ),
    	'buttons' => array(
    		array( 'title' => '续期', 'name' => 'access', 'highlight' => true ),
    		array( 'title' => '删除', 'name' => 'remove', 'confirm' => true, 'display' => $user->level != 'admin' ),
    	)
    ) );
    ?>
    </div>
</div>