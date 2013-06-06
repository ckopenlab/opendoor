<button
	<?php if ( $this->id ):?>
    id="<?= $this->id ?>"
    <?php endif; ?>
    class="<?php $this->render( 'button/class' )?>"
    type="<?= $this->type ?>"
    name="<?= $this->name ?>"
    onclick="<?php $this->render( 'button/onclick' )?>"
	<?php foreach ( $this->property as $key => $value ) echo ' ' . $key . '="' . $value . '" ';?>
	><?= $this->title ?>
	<?php if ( $this->badge ):?><span><?= $this->badge ?></span><?php endif;?>
</button>