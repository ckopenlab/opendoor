<?
//确认开始
if ( $this->confirm ) {
    echo 'if(confirm(\'' . ( strlen( $this->confirm ) > 1 ? $this->confirm : '您确定吗?' ) . '\')){';
}
//直接给出代码
if ( $this->click ) {
	echo $this->click;
}
//ajax调用
else if ( $this->ajax ) {
	?>$.ajax({
		type:'POST',
		url:'<?= $this->ajax ?>',
		<?if ( is_array( $this->data ) ):?>
		data:'<?= WeipaiURLHelper::mergeParams( $this->data ) ?>',
		<?elseif ( is_string( $this->data ) ):?>
		data:<?= $this->data ?>,
		<?endif;?>
		<?if ( $this->success ):?>
		success:function(){<?= $this->success ?>},
		<?else:?>
		dataType:'script',
		<?endif;?>
		error:function(e){alert(e.responseText)}
		})<?
}
//url跳转
else if ( $this->url ) {
    echo 'location.href=\'' . $this->url . '\'';
}
//确认结束
if ( $this->confirm ) {
    echo '}';
}
?>