<?php

class BuildGrill {

	public function __construct() {
		add_action('wp', array($this, 'init'));

	}
	
	public function init() {
		$this->ajax();
	}

	function ajax() {
		if (!isset($_REQUEST['ajax'])) return;

		if ($_REQUEST['ajax'] == 'steps') {
			echo json_encode($this->getSteps());
			die;
		}

		if ($_REQUEST['ajax'] == 'result') {
			$this->buildQuery();
			get_template_part('blocks/build-a-grill/results');
			die;
		}
	}

	function buildQuery() {

		$args = array('p' => '-1'); //for empty results list by default

		if (isset($_POST['jsonData'])) {
			$data = json_decode(stripslashes($_POST['jsonData']));

			if (!empty($data)) {
				$config = $this->getSteps(false);
				if (!empty($config)) {
					$attributes = array();

					foreach ($config['steps'] as $step) {
						if (!isset($data->{$step['id']})) {
							continue;
						}

						$value = $data->{$step['id']};

						switch ($step['template']) {
							case 'one-level-options':
								foreach ($step['options'] as $option) {
									if ($option['value'] == $value) {
										if (isset($option['attributes'])) {
											foreach ($option['attributes'] as $att_name => $att_val) {
												if (isset($attributes[$att_name])) {
													$attributes[$att_name] = array_unique(array_merge($attributes[$att_name], $att_val));
												} else {
													$attributes[$att_name] = $att_val;
												}
											}
										}
									}
								}
								break;
							case 'single-option':
								$opt_atts = array();

								$option = array_shift($step['options']);
								if ($option['value1'] == $value) {
									$opt_atts = $option['attributes1'];
								} elseif ($option['value2'] == $value) {
									$opt_atts = $option['attributes2'];
								}

								if (!empty($opt_atts)) {
									foreach ($opt_atts as $att_name => $att_val) {
										if (isset($attributes[$att_name])) {
											$attributes[$att_name] = array_unique(array_merge($attributes[$att_name], $att_val));
										} else {
											$attributes[$att_name] = $att_val;
										}
									}
								}
								break;
							case 'two-level-options':
								foreach ($step['options'] as $option) {
									foreach ($option['children'] as $child) {
										if ($child['value'] == $value) {
											if (isset($child['attributes'])) {
												foreach ($child['attributes'] as $att_name => $att_val) {
													if (isset($attributes[$att_name])) {
														$attributes[$att_name] = array_unique(array_merge($attributes[$att_name], $att_val));
													} else {
														$attributes[$att_name] = $att_val;
													}
												}
											}
										}
									}
								}
								break;
						}
					}

					$tax_query = array();

					foreach ($attributes as $attr_name => $attr_values) {
						$tax_query[] = array(
							'field' => 'slug',
							'taxonomy' => 'pa_' . $attr_name,
							'terms' => $attr_values
						);
					}
					
					if ($search_cats = get_field('search_in_categories')) {
						$tax_query[] = array(
							'field' => 'id',
							'taxonomy' => 'product_cat',
							'terms' => $search_cats,
						);
					}

					$args = array(
						'post_type' => 'product',
						'posts_pre_page' => -1,
					);

					if (!empty($tax_query)) {
						$args['tax_query'] = $tax_query;
					}
				}
			}
		}

		query_posts($args);
		
	}

	function getAvailibleAttributes($all_attributes) {
		$availibleAttributes = array();
		
		if (!count($all_attributes)) return false;
		
		if (isset($_POST['jsonData'])) {
			$this->buildQuery();
		} else {
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
			);
			
			if ($search_cats = get_field('search_in_categories')) {
				$args['tax_query'] = array(array(
					'field' => 'id',
					'taxonomy' => 'product_cat',
					'terms' => $search_cats,
				));
			}

			query_posts($args);
		}
		
		while (have_posts()) {
			the_post();
			foreach ($all_attributes as $taxonomy => $atts) {
				$terms = get_the_terms(get_the_ID(), $taxonomy);
				
				if ($terms) {
					if (!isset($availibleAttributes[$taxonomy])) {
						$availibleAttributes[$taxonomy] = array();
					}
					
					foreach ($terms as $term) {
						$availibleAttributes[$taxonomy][] = $term->slug;
					}
					$availibleAttributes[$taxonomy] = array_unique($availibleAttributes[$taxonomy]);
				}
			}
		}
		
		return $availibleAttributes;
	}
	
	function checkChoiceAvailible($option, $availible) {
		if (isset($option['attributes']) && count($option['attributes'])) {
			foreach ($option['attributes'] as $tax => $atts) {
				if (!isset($availible['pa_'.$tax]) || !count(array_intersect($atts, array_values($availible['pa_'.$tax])))) {
					return false;
				}
			}
			
			return true;
			
		} elseif ((isset($option['attributes1']) || isset($option['attributes2'])) 
			&& (count($option['attributes1']) || count($option['attributes2']))) {
			for ($i=0; $i<2; $i++) {
				if (isset($option['attributes'.$i])) {
					foreach ($option['attributes'.$i] as $tax => $atts) {
						if (!isset($availible['pa_'.$tax]) || !count(array_intersect($atts, array_values($availible['pa_'.$tax])))) {
							return false;
						}
					}
				}
			}
			
			return true;
		}
		
		return true;
	}
	
	function getSteps($filter = true) {
		
		$settings = get_field('steps');
		
		$result = array(
			'steps' => array(),
			'attributes_all' => array(),
		);
		
		$result['attributes_all'] = array();
		
		if ($settings) {
			foreach ($settings as $key => $step_settings) {
				$step = array(
					'id' => 'step_' . $key,
					'name' => $step_settings['tab_label'],
					'title' => $step_settings['title'],
					'description' => $step_settings['description'],
					'template' => $step_settings['template'],
					'hidden' => $step_settings['tab_hidden'] ? true : false,
					'options' => array(),
				);
				
				switch($step['template']) {
					case 'one-level-options':
						foreach ($step_settings['choices'] as $choice_key => $choice_settings) {
							list($choice_image) = wp_get_attachment_image_src($choice_settings['image'], 'full');
							$choice = array(
								'value' => 'choice-' . $key . '-' . $choice_key,
								'title' => $choice_settings['title'],
								'image' => $choice_image,
								'attributes' => array(),
								'condition' => array(),
								'description' => $choice_settings['description'],
							);
							
							foreach ($choice_settings['attributes'] as $attribute_setting) {
								if ($attribute_setting['attribute']['taxonomy'] && $attribute_setting['attribute']['term']) {
									$choice['attributes'][$attribute_setting['attribute']['taxonomy']][] = $attribute_setting['attribute']['term'];
									
									if (!isset($result['attributes_all'][$attribute_setting['attribute']['taxonomy']])) {
										$result['attributes_all'][$attribute_setting['attribute']['taxonomy']] = array();
									}
									$result['attributes_all'][$attribute_setting['attribute']['taxonomy']][] = $attribute_setting['attribute']['term'];
								}
							}
							
							foreach ($choice['attributes'] as $tax => $terms) {
								$choice['attributes'][$tax] = array_unique($terms);
							}
							
							$condition = trim($choice_settings['condition']);
							if ($condition) {
								$condition = explode(',', $condition);
								foreach ($condition as $cond_key => $cond_num) {
									$condition[$cond_key] = intval(trim($cond_num));
									if (!$condition[$cond_key]) {
										unset($condition[$cond_key]);
									} else {
										$condition[$cond_key]--;
										$condition[$cond_key] = 'step_'.$condition[$cond_key];
									}
								}
							} else {
								$condition = array();
							}
							$choice['condition'] = $condition;
							
							$step['options'][] = $choice;
						}
						break;
					
					case 'single-option':
						list($choice_image) = wp_get_attachment_image_src($step_settings['image'], 'full');
						
						$choice = array(
							'image' => $choice_image,
							'value1' => 'choice-' . $key . '-1',
							'value2' => 'choice-' . $key . '-2',
							'title1' => $step_settings['choice_1_title'],
							'title2' => $step_settings['choice_2_title'],
							'attributes1' => array(),
							'attributes2' => array(),
							'condition1' => array(),
							'condition2' => array(),
						);
						
						//build attributes1 and attributes2 arrays
						for ($attr_num = 1; $attr_num <= 2; $attr_num ++) {
							foreach ($step_settings['choice_'.$attr_num.'_attributes'] as $attribute_setting) {
								if ($attribute_setting['attribute']['taxonomy'] && $attribute_setting['attribute']['term']) {
									$choice['attributes'.$attr_num][$attribute_setting['attribute']['taxonomy']][] = $attribute_setting['attribute']['term'];
									if (!isset($result['attributes_all'][$attribute_setting['attribute']['taxonomy']])) {
										$result['attributes_all'][$attribute_setting['attribute']['taxonomy']] = array();
									}
									$result['attributes_all'][$attribute_setting['attribute']['taxonomy']][] = $attribute_setting['attribute']['term'];
								}
							}
							
							foreach ($choice['attributes'.$attr_num] as $tax => $terms) {
								$choice['attributes'.$attr_num][$tax] = array_unique($terms);
							}
							
							$condition = trim($step_settings['choice_'.$attr_num.'_condition']);
							if ($condition) {
								$condition = explode(',', $condition);
								foreach ($condition as $cond_key => $cond_num) {
									$condition[$cond_key] = intval(trim($cond_num));
									if (!$condition[$cond_key]) {
										unset($condition[$cond_key]);
									} else {
										$condition[$cond_key]--;
										$condition[$cond_key] = 'step_'.$condition[$cond_key];
									}
								}
							} else {
								$condition = array();
							}
							$choice['condition'.$attr_num] = $condition;
						}
						
						$step['options'][] = $choice;
						
						break;
						
					case 'two-level-options':
						foreach ($step_settings['choices_2level'] as $choice_1lvl_key => $choice_1lvl_settings) {
							$choice_1lvl = array(
								'title' => $choice_1lvl_settings['title'],
								'children' => array(),
							);
							
							foreach ($choice_1lvl_settings['choices'] as $choice_key => $choice_settings) {
								list($choice_image) = wp_get_attachment_image_src($choice_settings['image'], 'full');
								$choice = array(
									'value' => 'choice-' . $key . '-' . $choice_1lvl_key . '-' . $choice_key,
									'title' => $choice_settings['title'],
									'image' => $choice_image,
									'attributes' => array(),
									'condition' => array(),
								);
								
								foreach ($choice_settings['attributes'] as $attribute_setting) {
									if ($attribute_setting['attribute']['taxonomy'] && $attribute_setting['attribute']['term']) {
										$choice['attributes'][$attribute_setting['attribute']['taxonomy']][] = $attribute_setting['attribute']['term'];
										if (!isset($result['attributes_all'][$attribute_setting['attribute']['taxonomy']])) {
											$result['attributes_all'][$attribute_setting['attribute']['taxonomy']] = array();
										}
										$result['attributes_all'][$attribute_setting['attribute']['taxonomy']][] = $attribute_setting['attribute']['term'];
									}
								}
								
								foreach ($choice['attributes'] as $tax => $terms) {
									$choice['attributes'][$tax] = array_unique($terms);
								}
								
								$condition = trim($choice_settings['condition']);
								if ($condition) {
									$condition = explode(',', $condition);
									foreach ($condition as $cond_key => $cond_num) {
										$condition[$cond_key] = intval(trim($cond_num));
										if (!$condition[$cond_key]) {
											unset($condition[$cond_key]);
										} else {
											$condition[$cond_key]--;
											$condition[$cond_key] = 'step_'.$condition[$cond_key];
										}
									}
								} else {
									$condition = array();
								}
								$choice['condition'] = $condition;
								
								$choice_1lvl['children'][] = $choice;
							}
							
							$step['options'][] = $choice_1lvl;
						}
						
						break;
				}
				
				$result['steps'][] = $step;
				
			}
		}
		
		
		$attributes_all = $result['attributes_all'];
		$result['attributes_all'] = array();
		
		foreach ($attributes_all as $key => $val) {
			$result['attributes_all']['pa_' . $key] = array_values(array_unique($attributes_all[$key]));
		}
		
		unset($attributes_all);
		
		if ($filter) {
			$availibleAttributes  = $this->getAvailibleAttributes($result['attributes_all']);
			
			foreach ($result['steps'] as $step_id => $step) {
				foreach ($step['options'] as $option_id => $option) {
					if (isset($option['children'])) {
						foreach ($option['children'] as $child_id => $child) {
							if (!$this->checkChoiceAvailible($child, $availibleAttributes)) {
								unset($result['steps'][$step_id]['options'][$option_id]['children'][$child_id]);
							}
						}
						
						if (count($result['steps'][$step_id]['options'][$option_id]['children']) < 2) {
							unset($result['steps'][$step_id]['options'][$option_id]);
						} else {
							$result['steps'][$step_id]['options'][$option_id]['children'] = array_values($result['steps'][$step_id]['options'][$option_id]['children']);
						}
					} elseif (!$this->checkChoiceAvailible($option, $availibleAttributes)) {
						unset($result['steps'][$step_id]['options'][$option_id]);
					}
				}
				
				if (!count($result['steps'][$step_id]['options'])) {
					unset($result['steps'][$step_id]);
				} else {
					$result['steps'][$step_id]['options'] = array_values($result['steps'][$step_id]['options']);
				}
			}
			
			$result['steps'] = array_values($result['steps']);
		}
		
		
		
		return $result;
	}
}

$buildGrill = new BuildGrill();