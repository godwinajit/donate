<?php
/**
 * Filename: index-pdf.php
 * Project: WordPress PDF Templates
 * Copyright: (c) 2014-2016 Antti Kuosmanen
 * License: GPLv3
 *
 * Copy this file to your theme directory to start customising the PDF template.
*/
?>
<!DOCTYPE html>

<html>
<head>
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
  <style>
    body {
      font-size: 12px;
      line-height: 16px;
    }
  </style>
</head>

<body>
  <div class="container">
  <h1><?php the_title(); ?></h1>
	<p><?php the_content(); ?></p>
<?php
$table = get_field( 'table_template' );

if ( $table ) {

    echo '<table cellpadding="0" cellspacing="0">';

        if ( $table['header'] ) {

        echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th style="border:1px solid black;padding:10px;font:9px/14px Arial, Helvetica, sans-serif;">';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

         echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';
					foreach ( $tr as $td ) {
                        echo '<td style="border:1px solid black;padding:10px;font:10px/14px Arial, Helvetica, sans-serif;text-align: left;">';
						if ( ($td['c'] != '') && (strpos($td['c'], '[NOPOPUP]') !== false)){
							echo '<img src="/wp-content/themes/globallymealliance/images/check-li.png" style="width: 30px; display: block; margin: 0 auto;">';
						}else{
							echo $td['c'];
						}
                        echo '</td>';
					}

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}
?>

  </div>
</body>
</html>
