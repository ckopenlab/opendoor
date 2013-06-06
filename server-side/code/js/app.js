$.popin = function ( content ) {
	$( 'body' ).append( 
		'<div class="pop in">\
			<div class="wrapper">\
				<div class="popBox">\
					<a href="javascript:$.popout();" class="close"></a>\
					<div class="content">\
						' + content + '\
					</div>\
				</div>\
			</div>\
		</div>' 
	);
}

$.popout = function() {
	$( '.pop' ).addClass( 'out' );
	setTimeout(function(){
		$( '.pop' ).remove();
	},1000);
}