<?php

/**
 * @file
 * Prepares variables for block templates.
 */

use Drupal\block\Entity\Block;

/**
 * Implements hook_preprocess_HOOK() for block.html.twig.
 */
function kiso_preprocess_block(&$variables) {
  $elements = $variables['elements'];
  $provider = $elements['#configuration']['provider'];

  // Manage blocks based on the generated module
  // (Provider) and add a useful class.
  switch ($provider) {

    // "Custom block" provider.
    case 'block_content':
      if (!empty($variables['content']['#block_content'])) {
        /** @var \Drupal\block_content\BlockContentInterface $block_content */
        $block_content = $variables['content']['#block_content'];
        $view_mode = strtr($elements['#configuration']['view_mode'], '.', '_');
        $variables['derivative_plugin_id'] = ($view_mode !== 'default') ? $block_content->bundle() . '--' . $view_mode : $block_content->bundle();
      }
      else {
        $variables['derivative_plugin_id'] = $elements['#derivative_plugin_id'];
      }
      break;

    // Any other provider.
    default:
      if (empty($elements['#derivative_plugin_id']) && isset($elements['#id'])) {
        $variables['derivative_plugin_id'] = $elements['#id'];
      }
      break;
  }

  // Prepare the '$variables['block_region']' variable to add specific
  // block class according to the region it is placed in.
  if (isset($elements['#id'])) {
    $block = Block::load($elements['#id']);
    $variables['block_region'] = $block->getRegion();
  }
  // This 'else if' is only for 'page_manager' module.
  else if (isset($elements['#configuration']['region'])) {
    $variables['block_region'] = $elements['#configuration']['region'];
  }
}
