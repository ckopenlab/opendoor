<div class="box" id="user_<?= $user->id ?>">
	<span class="username <?= $user->level ?>">
		<?= $user->username ? $user->username : '游客' . $user->id ?>
	</span>
    <span class="time"><?= Time::interval( $user->time ) ?></span>
    <span class="token"><?= $user->model ?> (<?= $user->udid ?>)</span>
    <div class="buttons">
    <?php 
    $this->widget( 'Buttons', array( 
    	'options' => array( 'size' => 'normal', 'class' => 'fl' ),
    	'buttons' => array(
    		array( 'title' => '通过', 'name' => 'access', 'highlight' => true ),
    		array( 'title' => '拒绝', 'name' => 'remove' ),
    	)
    ) );
    ?>
    </div>
</div>