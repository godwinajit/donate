<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$has_row    = false;
$alt        = 1;
$attributes = $product->get_attributes();

ob_start();

?>
<table class="variations">

	<?php if ( $product->enable_dimensions_display() ) : ?>

		<?php if ( $product->has_weight() ) : $has_row = true; ?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
				<th><?php _e( 'Weight', 'woocommerce' ) ?></th>
				<td class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $product->has_dimensions() ) : $has_row = true; ?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
				<th><?php _e( 'Dimensions', 'woocommerce' ) ?></th>
				<td class="product_dimensions"><?php echo $product->get_dimensions(); ?></td>
			</tr>
		<?php endif; ?>

	<?php endif; ?>

	<?php 
	
	foreach ( $attributes as $attribute ) :

		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
			continue;
		} else {
			$has_row = true;
		}
		?>
		<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt' ; ?>">
			<th><?php echo wc_attribute_label( $attribute['name'] ); ?></th>
		</tr>
		<tr>
			<td><?php
				if ( $attribute['is_taxonomy'] ) {
//print_R($attribute);
					if($attribute['name']=="pa_stroke"){
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );								
						//echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
						echo "<select name='".$attribute['name']."'>";
						foreach ($values as $value){
							echo number_format(($value/10),1);
							echo '<option value="'.sprintf("%0.1f",$value).'">'.sprintf("%0.1f",$value).'</option>';
						}
						echo  "</select>";						
					
					}elseif($attribute['name']=="pa_rod-configuration") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						rodconfiguration($values,$attribute['name']);						
						
					}elseif($attribute['name']=="pa_select-damping-direction") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						select_damping_direction($values,$attribute['name']);						
						
					}elseif($attribute['name']=="pa_included-accessories") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						included_accessories($values,$attribute['name']);						
						
					}elseif($attribute['name']=="pa_enter-stroke") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						enter_stroke($values,$attribute['name']);						
						
					}
					elseif($attribute['name']=="pa_enter-retracted-mounting") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						enter_retracted_mounting($values,$attribute['name']);
					
					}elseif($attribute['name']=="pa_other-options") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						other_options($values,$attribute['name']);
					
					}elseif($attribute['name']=="pa_custom-stroke") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						custom_stroke($values,$attribute['name']);
					
					}				
					else{
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						//echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
						echo "<ul class='productvar'>";
						foreach ($values as $value){
							echo '<li><div class="col-xs-1"><input type="checkbox" class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label></div></li>";
							
						}
						echo "</ul>";
						
					}
				
				} else {

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				}
			?></td>
		</tr>
	<?php endforeach; ?>

</table>
<?php

function rodconfiguration($values,$name){
	echo "<ul class='productvar'>";
	
	foreach ($values as $value){	
		$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));	
		if($value===".058 DIA 304 STAINLESS STEEL" || $value===".187 DIA. ALUMINUM" || $value===".250 DIA S.S - STANDARD"){
			$append=constant($define);
			echo "<li><div class='row'><div class='col-xs-10'><strong>".$value."</strong></div><div class='col-xs-1'>  <font color='#f47a20'><b>".constant($define)."</b></font></div></li>";
		}else{
			echo '<li><div class="row"><div class="col-xs-1"><input type="radio" name="'.$name.'" value="'.$append.','.constant($define).'"></div><div class="col-xs-9">'.$value."</div><div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		}
	}
	echo "</ul>";
}
function select_damping_direction($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){			
			$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
			echo '<li><div class="row"><div class="col-xs-1"><input type="radio" name="'.$name.'" value="'.constant($define).'"></div><div class="col-xs-9">'.$value."</div><div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		
	}
	echo "</ul>";
}

function included_accessories($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
		
		echo "<li><div class='row'><div class='col-xs-10'>".$value."</div><div class='col-xs-1'>  <font color='#f47a20'><b>".constant($define)."</b></font></div></li>";
	}
	echo "</ul>";
}

function enter_stroke($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		//$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
		echo '<li><label>'.$value."</li>";

	}
	echo '<input size="5" id="selectStroke" name="selectStroke" onchange="checkStroke(.125,11,.125)">';
	echo '<span style="margin-left: 5px; font-size: 8pt;" id="selectStrokeMsg" name="selectStrokeMsg"></span>';
	echo "</ul>";
}

function enter_retracted_mounting($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		echo '<li><label>'.$value."</li>";
	}
	echo '<input id="retractedMountingLengthMin" name="retractedMountingLengthMin" type="HIDDEN" value="">';
	echo '<input id="retractedMountingLength" name="retractedMountingLength" onblur="checkMinimumRetractedLength()" size="5" type="text">';
	echo '<span style="margin-left: 5px; font-size: 8pt;" id="retractedMountingLengthMsg" name="retractedMountingLengthMsg">
                                    </span>';
	echo "</ul>";
}

function other_options($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
		echo '<li><div class="col-xs-1"><input type="checkbox" name="'.$name.'" value="'.constant($define).'"></div><div class="col-xs-9">'.$value."</div><div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></li>";
		
	}
	echo "</ul>";
}

function custom_stroke($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		echo '<li><label>'.$value."</li>";
	}
	echo '<input id="custom_stroke" name="custom_stroke" onblur="validateCustomStroke($(this));" size="5" type="text">';
	                                 
	echo "</ul>";
}
if ( $has_row ) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}
