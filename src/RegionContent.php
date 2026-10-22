<?php

namespace Drupal\kiso;

use Drupal\Component\Render\MarkupInterface;
use Drupal\Core\DependencyInjection\AutowireTrait;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\twig_real_content\TwigRealContentTwigExtension;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * Renders regions and checks whether they contain meaningful content.
 */
class RegionContent implements ContainerInjectionInterface {

  use AutowireTrait;

  public function __construct(
    private readonly RendererInterface $renderer,
    #[Autowire(service: 'twig_real_content.twig_extension')]
    private readonly ?TwigRealContentTwigExtension $realContentExtension = NULL,
  ) {}

  /**
   * Renders a copy so the caller's region is not marked as printed.
   */
  public function renderRegion(array $region): MarkupInterface|string {
    return $this->renderer->render($region);
  }

  /**
   * Properly detect if regions are empty.
   *
   * @param string|null $markup
   *   The rendered region markup to be tested if empty.
   * @param string $allowed_tags
   *   Allowed tags to be excluded from the strip HTML tags process.
   *
   * @return bool
   *   TRUE if the region exists and is not empty, FALSE otherwise.
   */
  public function hasRegion(?string $markup, string $allowed_tags = ''): bool {
    if (empty($markup)) {
      return FALSE;
    }

    if ($this->realContentExtension !== NULL) {
      foreach ($this->realContentExtension->getFilters() as $filter) {
        if ($filter->getName() === 'real_content') {
          $callable = $filter->getCallable();
          if (!is_callable($callable)) {
            throw new \LogicException('The real_content filter must have a callable.');
          }
          return !empty($callable($markup));
        }
      }
      throw new \LogicException('The twig_real_content extension must provide the real_content filter.');
    }

    $cleaned = preg_replace('/<!--(.|\s)*?-->\s*|\r|\n/', '', $markup);
    return !empty($this->stripTags($cleaned, $allowed_tags));
  }

  /**
   * Strips wrapper tags while preserving tags that count as content.
   *
   * @param string $markup
   *   Original markup.
   * @param string|string[] $allowed_tags
   *   Tags to preserve in addition to the theme's defaults.
   */
  public function stripTags(string $markup, string|array $allowed_tags): string {
    $base = [
      '<drupal-render-placeholder>',
      '<embed>',
      '<hr>',
      '<iframe>',
      '<img>',
      '<input>',
      '<link>',
      '<object>',
      '<script>',
      '<source>',
      '<style>',
      '<video>',
    ];
    $allowed_tags = is_string($allowed_tags)
      ? $allowed_tags . implode('', $base)
      : array_merge($base, $allowed_tags);

    return trim(strip_tags($markup, $allowed_tags));
  }

}
