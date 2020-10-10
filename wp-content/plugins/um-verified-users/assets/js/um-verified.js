wp.hooks.addFilter( 'um_user_screen_block_hiding', 'um_verified_users', function( hide ) {
	hide = false;
	return hide;
}, 10 );