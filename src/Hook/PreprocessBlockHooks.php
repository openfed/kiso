<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Hook\Attribute\Hook;

/**
 * Hook implementations used to preprocess block variables.
 */
class PreprocessBlockHooks {

  public function __construct(
    protected readonly EntityTypeManagerInterface $entityTypeManager,
  ) {}

  /**
   * Implements hook_preprocess_HOOK() for block.html.twig.
   */
  #[Hook('preprocess_block')]
  public function preprocessBlock(array &$variables): void {
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
          $variables['derivative_plugin_id'] = $view_mode !== 'default' ? $block_content->bundle() . '--' . $view_mode : $block_content->bundle();
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
    $block = NULL;
    if (isset($elements['#id'])) {
      $block = $this->entityTypeManager->getStorage('block')
        ->load($elements['#id']);
    }
    if ($block !== NULL) {
      $variables['block_region'] = $block->getRegion();
    }
    elseif (isset($elements['#configuration']['region'])) {
      $variables['block_region'] = $elements['#configuration']['region'];
    }
  }

}
