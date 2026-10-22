<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Extension\ThemeSettingsProvider;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\kiso\RegionContent;
use Drupal\node\NodeInterface;
use Drupal\twig_real_content\TwigRealContentTwigExtension;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * Hook implementations used to preprocess html variables.
 */
class PreprocessHtmlHooks {

  /**
   * The region content service.
   *
   * @var \Drupal\kiso\RegionContent
   */
  private readonly RegionContent $regionContent;

  /**
   * Constructor for PreprocessHtmlHooks.
   *
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   * @param \Drupal\Core\Routing\RouteMatchInterface $routeMatch
   *   The route match service.
   * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
   *   The language manager service.
   * @param \Drupal\Core\Extension\ThemeSettingsProvider $themeSettings
   *   The theme settings provider service.
   * @param \Drupal\twig_real_content\TwigRealContentTwigExtension|null $realContentExtension
   *   The Twig real content extension service.
   */
  public function __construct(
    RendererInterface $renderer,
    protected readonly RouteMatchInterface $routeMatch,
    protected readonly LanguageManagerInterface $languageManager,
    protected readonly ThemeSettingsProvider $themeSettings,
    #[Autowire(service: 'twig_real_content.twig_extension')]
    ?TwigRealContentTwigExtension $realContentExtension = NULL,
  ) {
    $this->regionContent = new RegionContent($renderer, $realContentExtension);
  }

  /**
   * Implements hook_preprocess_HOOK() for html.html.twig.
   */
  #[Hook('preprocess_html')]
  public function preprocessHtml(array &$variables): void {
    $variables['page_navigation'] = $this->regionContent->renderRegion($variables['page']['navigation'] ?? []);
    $variables['page_complementary'] = $this->regionContent->renderRegion($variables['page']['complementary'] ?? []);
    $has_navigation = $this->regionContent->hasRegion($variables['page_navigation']);
    $has_complementary = $this->regionContent->hasRegion($variables['page_complementary']);
    // Added body classes when sidebar(s) has (have) content.
    if ($has_navigation && $has_complementary) {
      $variables['attributes']['class'][] = 'sidebar';
      $variables['attributes']['class'][] = 'two-sidebars';
    }
    elseif ($has_navigation) {
      $variables['attributes']['class'][] = 'sidebar';
      $variables['attributes']['class'][] = 'one-sidebar';
      $variables['attributes']['class'][] = 'is-visible--navigation';
    }
    elseif ($has_complementary) {
      $variables['attributes']['class'][] = 'sidebar';
      $variables['attributes']['class'][] = 'one-sidebar';
      $variables['attributes']['class'][] = 'is-visible--complementary';
    }
    else {
      $variables['attributes']['class'][] = 'no-sidebars';
    }
    // Add body classes related to node content.
    $node = $this->routeMatch->getParameter('node');
    if ($node instanceof NodeInterface) {
      // Set the a class on unpublished nodes.
      if (!$node->status->value) {
        $variables['attributes']['class'][] = 'page--node--unpublished';
      }
    }
    // WCAG 2.0 - Guideline 3.1.1 – Language of Page (Level A).
    // Sufficient Technique H57: Using language attributes on the html element.
    $language = $this->languageManager->getCurrentLanguage();
    if (!$variables['html_attributes']->offsetExists('lang')) {
      $language_id = $language->getId();
      $variables['html_attributes']->setAttribute('lang', $language_id);
    }
    // Keyboard Focus Tracking (What Input) library.
    // Disable persisting input/intent across pages.
    $theme_settings = $this->themeSettings;
    if ($theme_settings->getSetting('trackfocus_enable') && $theme_settings->getSetting('trackfocus_disable_persist')) {
      $variables['html_attributes']->setAttribute('data-whatpersist', 'false');
    }
  }

}
