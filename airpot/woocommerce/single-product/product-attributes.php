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

$jsonFilePath = file_get_contents('wp-content/themes/airpot/js/showProductAttributeImages.json');
$productAttributSlugArr = json_decode($jsonFilePath, true);
$productAttributSlugArrJS = json_encode($productAttributSlugArr);
//echo "var javascript_array = ". $productAttributSlugArrJS . ";\n";
?>
<script type="text/javascript">
<!--
var productAttributSlugArr = <?php echo $productAttributSlugArrJS;?>;
//-->
</script>
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
		if(!empty(get_field('products_iframe'))):
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
					if( ($attribute['name']=="pa_stroke") || ($attribute['name']=="pa_stroke-mm") ){
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );								
						//echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
						echo "<select name='".$attribute['name']."' id='selectStrokeList'  onchange='showPartNumber()'>";
						foreach ($values as $value){
							echo number_format(($value/10),1);
							echo '<option value="'.sprintf("%0.1f",$value).'">'.sprintf("%0.1f",$value).'</option>';
						}
						echo  "</select>";						

					}elseif( ($attribute['name']=="pa_inputs") ){
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );								
						//echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
						echo "<select name='".$attribute['name']."' id='selectInputsList'  onchange='showPartNumber()'>";
						echo '<option value=""> </option>';
						foreach ($values as $value){
							echo $value;
							preg_match('#\((.*?)\)#', $value, $inputsMatch);
							echo '<option value="'.sprintf($inputsMatch[1]).'">'.sprintf($value).'</option>';
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
							echo '<li><div class="col-xs-2"><input type="checkbox" id="OPTIONCHECKNEW" onclick="setOptionsCheckNew()" class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label></div></li>";
							
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
		<?php else:
			if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
			continue;
		} else {
			$has_row = true;
		}
		?>
		<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt' ; ?>">
			<th><?php echo wc_attribute_label( $attribute['name'] ); ?>
			<?php if( ($attribute['name']=="pa_stroke") || ($attribute['name']=="pa_stroke-mm") ) echo '<span class="config_warning" style="display: none; color: #ff0000; font-weight: bold;">&nbsp; &nbsp; « Please select an option</span>';?>
			</th>
			
		</tr>
		<tr>
			<td><?php
				if ( $attribute['is_taxonomy'] ) {
				//print_R($attribute);
					if( ($attribute['name']=="pa_stroke") || ($attribute['name']=="pa_stroke-mm") ){
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );								
						echo "<select name='".$attribute['name']."' id='selectStrokeiframe' class='Stroke'>";
						echo '<option value=""> </option>';
						foreach ($values as $value){
							echo number_format(($value/10),1);
							echo '<option value="'.sprintf("%0.1f",$value).'">'.sprintf("%0.1f",$value).'</option>';
						}
						echo  "</select>";						
						
					}elseif($attribute['name']=="pa_optional-sensor-tracks") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						echo "<ul class='productvar'>";
						foreach ($values as $value){
							echo '<li><div class="col-xs-2"><input type="checkbox" id="cb-'.$value.'"  onclick="setOptionalCheckIframe(this.id)" class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label></div></li>";
							
						}
						echo "</ul>";						
						
					}elseif($attribute['name']=="pa_optional-piston-magnet") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						echo "<ul class='productvar magnet'>";
						foreach ($values as $value){
							echo '<li><div class="col-xs-2"><input type="checkbox" id="cb-'.$value.'" onclick="setMagnetCheckIframe(this.id)" class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label></div></li>";
							
						}
						echo "</ul>";						
						
					}elseif($attribute['name']=="pa_click-the-et-box") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						echo "<ul class='productvar'>";
						foreach ($values as $value){
							echo '<li><div class="col-xs-2"><input type="checkbox" id="cb_'.$value.'" onclick="setOptionsET(this.id)" class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label>&nbsp;&nbsp;&nbsp;(Note: -ET and non -ET part numbers generate the same CAD drawing)</div></li>";
							
						}
						echo "</ul>";
					}elseif($attribute['name']=="pa_2-cylinder-seals") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						echo "<ul class='productvar'>";
						foreach ($values as $value){
							echo '<li><div class="col-xs-2"><input type="checkbox" id="cb_'.$value.'" onclick="setOptionsJ2(this.id)" class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label></div></li>";
							
						}
						echo "</ul>";
					}elseif($attribute['name']=="pa_custom-stroke") {
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						custom_stroke($values,$attribute['name']);
					
					}				
					else{
						$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
						echo "<ul class='productvar'>";
						foreach ($values as $value){
							echo '<li><div class="col-xs-2"><input type="checkbox"  class="'.$attribute['name'].'" name="'.$attribute['name'].'" value="'.$value.'"></div><div class="col-xs-10"><label>'.$value."</label></div></li>";
							
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
	<?php endif; endforeach; ?>

</table>
<?php

function getProductAttributeSlug($productAttributes, $value){
	global $productAttributeSlugarray;
	$productAttributeSlugarray = array();

	foreach ($productAttributes as $productAttribute){
		//if($productAttribute->slug == 'plain-end')$productAttribute->slug = 'plain-end-058';
		//else if($productAttribute->slug == 'plain-end-058')$productAttribute->slug = 'plain-end';
		if( ($productAttribute->name ==  $value) && (!in_array($productAttribute->slug, $productAttributeSlugarray))){
			//echo $productAttribute->slug;
			$productAttributeSlugarray[] = $productAttribute->slug;
			return $productAttribute->slug;
		}
	}
}

function rodconfiguration($values,$name){
	$productAttributes = get_the_terms( $product->id, $name );
	usort($productAttributes, function($a, $b) { return $b->term_id - $a->term_id; });
	echo "<ul class='productvar'>";
	
	foreach ($values as $value){
		$helpTextForAttribute = '';
		$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));	
		if($value===".058 DIA 304 STAINLESS STEEL" || $value===".187 DIA. ALUMINUM" || $value===".250 DIA S.S - STANDARD"){
			$append=constant($define);
			// Help text for the attributes
			if($value===".058 DIA 304 STAINLESS STEEL") $helpTextForAttribute = '';
			if($value===".187 DIA. ALUMINUM") $helpTextForAttribute = ' ( Supply pressures to 100 psi max )';
			
			echo "<li onmousemove='showProductAttributeImage(".'"'.getProductAttributeSlug($productAttributes, $value).'"'.",productAttributSlugArr)'>
			<div class='row'>
			<div class='col-xs-11'><strong>".$value."</strong>".$helpTextForAttribute."</div>
			<div class='col-xs-1'>  <font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		}else{
			echo '<li onmousemove="showProductAttributeImage('."'".getProductAttributeSlug($productAttributes, $value)."'".',productAttributSlugArr)">
			<div class="row">
			<div class="col-xs-11">
			<div class="col-xs-2"><input type="radio" id="'.$name.'" name="'.$name.'" value="'.$append.','.constant($define).'" onclick="setRodCombo('."'".$append."'".','."'".constant($define)."'".',1.36)"></div>
			<div class="col-xs-9">'.$value."</div></div>
			<div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		}
	}
	echo "</ul>";
}
function select_damping_direction($values,$name){
	$productAttributes = get_the_terms( $product->id, $name );
	echo "<ul class='productvar'>";
	foreach ($values as $value){			
			$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
			echo '<li onmousemove="showProductAttributeImage('."'".getProductAttributeSlug($productAttributes, $value)."'".',productAttributSlugArr)">
			<div class="row">
			<div class="col-xs-2"><input type="radio" id="selectConfigDampingDirectionType" onclick="showPartNumber()" name="'.$name.'" value="'.constant($define).'"></div>
			<div class="col-xs-9">'.$value."</div>
			<div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		
	}
	echo "</ul>";
}

function included_accessories($values,$name){
	$productAttributes = get_the_terms( $product->id, $name );
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
		
		echo "<li  onmousemove='showProductAttributeImage(".'"'.getProductAttributeSlug($productAttributes, $value).'"'.",productAttributSlugArr)'>
		<div class='row'><div class='col-xs-10'>".$value."</div>
		<div class='col-xs-2'>  <font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
	}
	echo "</ul>";
}

function enter_stroke($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		//$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
		echo '<li><label>'.$value."</li>";

	}
	echo '<input size="5" type="text" id="selectStroke" name="selectStroke" onchange="checkStroke(.125,11,.125)">';
	echo '<span style="margin-left: 5px; font-size: 8pt;" id="selectStrokeMsg" name="selectStrokeMsg"></span>';
	echo "</ul>";
}

function enter_retracted_mounting($values,$name){
	$productAttributes = get_the_terms( $product->id, $name );
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		echo '<li onmousemove="showProductAttributeImage('."'".getProductAttributeSlug($productAttributes, $value)."'".',productAttributSlugArr)"><label>'.$value."</li>";
	}
	echo '<input id="retractedMountingLengthMin" name="retractedMountingLengthMin" type="HIDDEN" value="">';
	echo '<input id="retractedMountingLength" name="retractedMountingLength" onblur="checkMinimumRetractedLength()" size="5" type="text">';
	echo '<span style="margin-left: 5px; font-size: 8pt;" id="retractedMountingLengthMsg" name="retractedMountingLengthMsg">
                                    </span>';
	echo "</ul>";
}

function other_options($values,$name){
	$productAttributes = get_the_terms( $product->id, $name );	
	echo "<ul class='productvar'>";
	
	foreach ($values as $value){
		$define=preg_replace("/[^A-Za-z0-9\-]+/", "", strtoupper($value));
		if($value!="CYLINDER PORT (CROSS SLOT)"):
		echo '<li onmousemove="showProductAttributeImage('."'".getProductAttributeSlug($productAttributes, $value)."'".',productAttributSlugArr)">
		<div class="row">
		<div class="col-xs-2"><input type="checkbox"  id="OPTIONCHECK" onclick="setOptionsCheck()" name="'.$name.'" value="'.constant($define).'"></div>
		<div class="col-xs-9">'.$value."</div>
		<div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		else:
		echo '<li onmousemove="showProductAttributeImage('."'".getProductAttributeSlug($productAttributes, $value)."'".',productAttributSlugArr)">
		<div class="row">
		<div class="col-xs-2"><input type="checkbox"  id="OPTIONCHECK" onclick="setOptionsCheck()" name="'.$name.'" value="'.constant($define).'"></div>
		<div class="col-xs-9">'.$value."<input id='cylinderPortDimension' name='cylinderPortDimension' onblur='showPartNumber()' size='5' type='text'>
		<br>
		
		<span class='plain-text2'> Please specify to 3 decimal places </span></div>
		<div class='col-xs-1'><font color='#f47a20'><b>".constant($define)."</b></font></div></div></li>";
		endif;
		
		
	}
	echo "</ul>";
}

function custom_stroke($values,$name){
	echo "<ul class='productvar'>";
	foreach ($values as $value){
		//echo '<li><label>'.$value."</li>";
	}
	echo '<input id="custom_stroke" name="custom_stroke" onblur="validateCustomStroke(jQuery(this));" size="5" type="text">';
	                                 
	echo "</ul>";
}
if ( $has_row ) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}
