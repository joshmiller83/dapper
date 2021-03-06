<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

/**
 * Adds the necessary CSS for the line item summary template.
 */
function dapper_preprocess_commerce_line_item_summary(&$variables) {
  $variables['cart_link'] = check_plain(url('cart'));
  $variables['checkout_link'] = check_plain(url('checkout'));
}


/* Make the html 5 button work. */
function dapper_button($variables) {
  $element = $variables['element'];

  $element['#attributes']['type'] = 'submit';
  if ($element['#type'] == "button") {
    element_set_attributes($element, array('id', 'name', 'title'));
    return '<button' . drupal_attributes($element['#attributes']) . '>' . $element['#value'] . '</button>';

  } else {
    element_set_attributes($element, array('id', 'name', 'value'));

    $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
    if (!empty($element['#attributes']['disabled'])) {
      $element['#attributes']['class'][] = 'form-button-disabled';
    }

    return '<input' . drupal_attributes($element['#attributes']) . ' />';

  }
}

/* Tweaking forms for the theme */
function dapper_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['mobile_link']['#weight'] = -99;
    $form['mobile_link']['#markup'] = '<span class="icon-search expand_menu"></span>';
    $form['actions']['submit']['#prefix'] = '<div class="button">';
    $form['actions']['submit']['#type'] = 'button';
    $form['actions']['submit']['#title'] = 'Search';
    $form['actions']['submit']['#executes_submit_callback'] = true;
    $form['actions']['submit']['#value'] = '<span class="icon-search"></span>';
    $form['actions']['submit']['#suffix'] = '</div>';

    $form['search_block_form']['#title_display'] = 'invisible';
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
    $form['search_block_form']['#attributes']['size'] = 28;
  }
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  STARTERKIT_preprocess_html($variables, $hook);
  STARTERKIT_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function dapper_preprocess_page(&$variables, $hook) {
  // Tweak main menu
  $arr = array_reverse($variables['main_menu'], true);
  $variables['main_menu']['expand_menu'] = array(
    'attributes' => array('class'=>'icon-list'),
    'title' => '<span class="element-invisible">Menu</span>',
    'html' => true
  );
  $variables['main_menu'] = array_reverse($variables['main_menu'], true);

  // Tweak secondary menu
  // This won't work if you're using a menu_block
  $arr = array_reverse($variables['secondary_menu'], true);
  $variables['secondary_menu']['expand_menu'] = array(
    'attributes' => array('class'=>'icon-list'),
    'title' => 'Catalog',
  );
  $variables['secondary_menu'] = array_reverse($variables['secondary_menu'], true);
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

/**
* Implements hook_entity_info_alter().
*/
function dapper_entity_info_alter(&$entity_info) {
  $entity_info['node']['view modes']['dapper'] = array(
    'label' => t('Dapper Catalog'),
    'custom settings' => TRUE,
  );
}
