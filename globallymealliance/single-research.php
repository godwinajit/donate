<?php
// Research post type do not have Single Post page. So redirect to its external page. If empty redirect to the Research Landing page.

if( get_field('research_url') ) $redirectUrl = get_field('research_url');
else $redirectUrl = site_url( 'the-research/notable-articles' );

wp_redirect( $redirectUrl, 301 );
exit;
?>