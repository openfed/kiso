<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Hook implementations used to alter theme suggestions.
 */
class AlterThemesuggestionsHooks {

  public function __construct(
    protected readonly EntityTypeManagerInterface $entityTypeManager,
    protected readonly RequestStack $requestStack,
  ) {}

  /**
   * Implements hook_theme_suggestions_HOOK_alter() for `page` templates.
   */
  #[Hook('theme_suggestions_page_alter')]
  public function themeSuggestionsPageAlter(array &$suggestions, array $variables): void {
    // Add template suggestions for pages 40[x].
    $http_error_suggestions = [
      '401',
      '403',
      '404',
    ];
    if ($exception = $this->requestStack->getCurrentRequest()?->attributes->get('exception')) {
      $status_code = $exception->getStatusCode();
      if (in_array($status_code, $http_error_suggestions)) {
        $suggestions[] = 'page__error';
      }
    }
    // Add template suggestions for content type.
    if ($node = $this->requestStack->getCurrentRequest()?->attributes->get('node')) {
      // In revision $node is a int returned as string
      // check if $node is a numeric and check if parsing int work
      // (if not intval return 0)
      if (is_numeric($node) && intval($node) > 0) {
        $node = $this->entityTypeManager->getStorage('node')
          ->load(intval($node));
      }
      // If $node is a Node.
      if ($node instanceof NodeInterface) {
        array_splice($suggestions, 1, 0, 'page__node__' . $node->getType());
      }
    }
  }

  /**
   * Implements hook_theme_suggestions_HOOK_alter() for `block` templates.
   */
  #[Hook('theme_suggestions_block_alter')]
  public function themeSuggestionsBlockAlter(array &$suggestions, array $variables): void {
    $elements = $variables['elements'];
    $provider = $elements['#base_plugin_id'] ?? '';
    // Prepare the '$region' variable to add specific block
    // templates according to the region it is placed in.
    if (isset($elements['#id'])) {
      $block = $this->entityTypeManager->getStorage('block')
        ->load($elements['#id']);
      if ($block !== NULL) {
        $region = $block->getRegion();
      }
    }
    if (!isset($region) && isset($elements['#configuration']['region'])) {
      $region = $elements['#configuration']['region'];
    }
    // Add template suggestion for blocks which need to use HTML5 '<aside>'
    // element to assign the 'complementary' landmark role to each content
    // designed to be complementary to the main content (at a similar level
    // in the DOM hierarchy).
    if (isset($region) && $region === 'complementary') {
      $suggestions[] = 'block__' . $region . '_landmark';
    }
    // Manage blocks based on the generated module
    // (Provider) and add template suggestions.
    switch ($provider) {
      // "Language switcher" provider that needs to use HTML5 '<nav>'
      // element to assign the 'navigation' landmark role.
      case 'language_block':
        $suggestions[] = 'block__navigation_landmark';
        break;

      // "Custom block" provider.
      case 'block_content':
        if (!empty($elements['content']['#block_content'])) {
          /** @var \Drupal\block_content\BlockContentInterface $block_content */
          $block_content = $elements['content']['#block_content'];
          $view_mode = strtr($elements['#configuration']['view_mode'], '.', '_');
          $suggestions[] = 'block__block_content__' . $block_content->bundle();
          // If custom view mode(s).
          if ($view_mode !== 'default') {
            $suggestions[] = 'block__block_content__' . $view_mode;
            $suggestions[] = 'block__block_content__' . $block_content->bundle() . '__' . $view_mode;
          }
        }
        break;
    }
  }

}
