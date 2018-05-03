<?php
// Support Groups do not have Single Post page. So redirect to the Support Group archives page.

$url = site_url( 'support-groups/' );

    wp_safe_redirect( $url, 301 );

    exit;
?>