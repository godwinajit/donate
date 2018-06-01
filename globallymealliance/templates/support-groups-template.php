<?php

/* Template Name: Support Groups Template */

// Support Groups is pulled via archive pages. So redirect to the Support Group archives page.

$url = site_url( 'support-groups/' );

    wp_safe_redirect( $url, 301 );

    exit;

?>