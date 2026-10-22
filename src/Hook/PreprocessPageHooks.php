<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Theme\ThemeManagerInterface;
use Drupal\kiso\RegionContent;
use Drupal\twig_real_content\TwigRealContentTwigExtension;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Hook implementations used to preprocess page templates.
 */
class PreprocessPageHooks {

  /**
   * The RegionContent service.
   *
   * @var \Drupal\kiso\RegionContent
   */
  private readonly RegionContent $regionContent;

  /**
   * Constructor for PreprocessPageHooks.
   *
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   * @param \Drupal\Core\Theme\ThemeManagerInterface $themeManager
   *   The theme manager service.
   * @param \Drupal\Core\Extension\ThemeHandlerInterface $themeHandler
   *   The theme handler service.
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   The request stack service.
   * @param \Drupal\twig_real_content\TwigRealContentTwigExtension|null $realContentExtension
   *   The real content extension service.
   */
  public function __construct(
    RendererInterface $renderer,
    protected readonly ThemeManagerInterface $themeManager,
    protected readonly ThemeHandlerInterface $themeHandler,
    protected readonly RequestStack $requestStack,
    #[Autowire(service: 'twig_real_content.twig_extension')]
    ?TwigRealContentTwigExtension $realContentExtension = NULL,
  ) {
    $this->regionContent = new RegionContent($renderer, $realContentExtension);
  }

  /**
   * @file
   * Prepares variables for the page template.
   */

  /**
   * Implements hook_preprocess_HOOK() for page.html.twig.
   */
  #[Hook('preprocess_page')]
  public function preprocessPage(array &$variables): void {
    // Add boolean variables detecting if regions are empty.
    $theme = $this->themeManager->getActiveTheme()->getName();
    $regions = $this->themeHandler->getTheme($theme)->listAllRegions();
    foreach ($regions as $key => $value) {
      $variables['page_' . $key] = $this->regionContent->renderRegion($variables['page'][$key]);
      $variables['has_' . $key] = $this->regionContent->hasRegion($variables['page_' . $key]);
    }
    // Create variable for status code.
    if ($exception = $this->requestStack->getCurrentRequest()?->attributes->get('exception')) {
      $status_code = $exception->getStatusCode();
      $variables['status_code'] = $status_code;
    }
  }

}
