//全部删除
function removeAll() {
	$( '.box' ).each(function( index, box ){
		var id = $( box ).attr( 'id' ).replace( 'user_', '' );
		remove( id );
	});
}

//删除单一用户
function remove( id ) {
	removeUser( id );
}

//全部处理
function accessAll() {
	$.popin( $( '#pop_menu' ).html() );
	$( '.pop .menu' ).undelegate( 'button', 'click' ).delegate( 'button', 'click', function ( e ) {
    	$.popout();
  		var interval = e.currentTarget.value;
  		$( '.box' ).each(function( index, box ){
  			var id = $( box ).attr( 'id' ).replace( 'user_', '' );
			accessUser( id, interval );
  		});
  });
}

//处理单一用户
function access ( id ) {
	$.popin( $( '#pop_menu' ).html() );
	$( '.pop .menu' ).undelegate( 'button', 'click' ).delegate( 'button', 'click', function ( e ) {
		$.popout();
		var interval = e.currentTarget.value;
		accessUser( id, interval );
	});
}

//ajax请求
function ajax ( url, id, callback ) {
	$.ajax({
		url: url + '/id/' + id,
		success: callback,
		error: function ( e ) {
			alert(e.responseText);
		}
	});
}

//移除
function disapear ( id ) {
	var user = $( '#user_' + id );
	$( 'button' ).css( '-webkit-animation', 'none' );
    user.fadeOut( function(){
    	user.remove();
    });
}

//绑定按钮事件
$(function(){
	$( '#page_user .box' ).delegate( 'button', 'click', function ( event ) {
	    var button = $( this );
	    var user = button.closest( '.box' ).attr( 'id' ).replace( 'user_', '' );
	    var action = button.attr( 'name' );
	    switch ( action ) {
	        case 'access' : access( user ); break;
	        case 'remove' : remove( user ); break;
	        default:
	    }
	});
});
