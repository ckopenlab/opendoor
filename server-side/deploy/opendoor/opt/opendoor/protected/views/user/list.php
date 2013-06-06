<div id="page_user">
	<div class="control">
	<?php 
	$this->widget( 'Buttons', array( 
		'options' => array( 'size' => 'big', 'class' => 'fl' ),
		'buttons' => array(
			array( 'title' => '全部续期', 'click' => 'accessAll()', 'highlight' => true ),
			array( 'title' => '返回', 'url' => '/admin' ),
		)
	) );
	?>
    </div>
    <?php
    foreach ( $users as $user ) {
        $this->renderPartial( '/user/_listCell', array( 'user' => $user ) ); 
    }
    ?>
</div>
<div id="pop_menu">
	<div class="menu">
    <?php 
    $this->widget( 'Buttons', array( 
    	'options' => array( 'size' => 'big', 'class' => 'fl' ),
    	'buttons' => array(
    		array( 'title' => '一天', 'property' => array( 'value' => Time::SECONDS_PER_DAY ) ),
    		array( 'title' => '一周', 'property' => array( 'value' => Time::SECONDS_PER_WEEK ) ),
    		array( 'title' => '一月', 'property' => array( 'value' => Time::SECONDS_PER_MONTH ) ),
    		array( 'title' => '一年', 'property' => array( 'value' => Time::SECONDS_PER_YEAR ) ),
    	)
    ) );
    ?>
    </div>
</div>
<?php Resource::loadJs( 'user' )?>
<script>
//续期
function accessUser ( id, interval ) {
	ajax( '/user/access/interval/' + interval, id, function() {
		$( '#user_' + id + ' .time' ).removeClass( 'expired' ).text( '已续期' );
	});
}
//删除
function removeUser ( id ) {
	ajax( '/user/remove', id, function() {
		disapear( id );
	} );
}
</script>