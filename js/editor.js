
/****** Remove Gutenberg Buttons styles *****/

  wp.domReady( () => {
	wp.blocks.unregisterBlockType( 'core/media-text' );
	wp.blocks.unregisterBlockType( 'core/archives' );
	wp.blocks.unregisterBlockType( 'core/social-link' );
	wp.blocks.unregisterBlockType( 'core/verse' );
	wp.blocks.unregisterBlockType( 'core/pullquote' );
	wp.blocks.unregisterBlockType( 'core/table' );
	wp.blocks.unregisterBlockType( 'core/more' );
	wp.blocks.unregisterBlockType( 'core/html' );
	wp.blocks.unregisterBlockType( 'core/latest-comments' );
	wp.blocks.unregisterBlockType( 'core/categories' );
	wp.blocks.unregisterBlockType( 'core/classic' );
	wp.blocks.unregisterBlockType( 'core/nextpage' );
	wp.blocks.unregisterBlockType( 'core/rss' );
	wp.blocks.unregisterBlockType( 'core/tag-cloud' );
	wp.blocks.unregisterBlockType( 'core/calendar' );
	wp.blocks.unregisterBlockType( 'core/subhead' );	
	
} );

/****** Set custom font sizes  *****/
wp.domReady( () => {

	wp.blocks.registerBlockStyle( 'core/paragraph', [ 
		{
			name: 'small',
			label: 'small',
			isDefault: true,
		},
		{
			name: 'normal',
			label: 'normal',
		}
	]);
} );