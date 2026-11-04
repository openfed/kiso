<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Render\Markup;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Hook implementations used to preprocess links.
 */
class PreprocessLinksHooks {

  use StringTranslationTrait;

  public function __construct(TranslationInterface $stringTranslation) {
    $this->setStringTranslation($stringTranslation);
  }

  /**
   * Implements hook_preprocess_HOOK() for links--language-block.html.twig.
   *
   * Uses language codes instead of full language names in the language
   * switcher block, with accessible labels and language attributes.
   *
   * Related WCAG resources:
   * - SC 3.1.2 Language of Parts (Level AA), H58.
   * - SC 3.1.4 Abbreviations (Level AAA), H28.
   * - SC 4.1.2 Name, Role, Value (Level A), ARIA14.
   */
  #[Hook('preprocess_links__language_block')]
  public function preprocessLinksLanguageBlock(array &$variables): void {
    foreach ($variables['links'] as $langcode => &$link) {
      if ($link['link']['#url']->getRouteName() !== '<nolink>') {
        $language_name = $this->t('@language', [
          '@language' => $link['text'],
        ], [
          'langcode' => $langcode,
        ]);
        $link['link']['#options']['attributes']['lang'] = $langcode;
        $link['link']['#options']['attributes']['aria-label'] = $language_name;
        $link['link']['#title'] = Markup::create('<abbr title="' . $language_name . '">' . strtoupper($langcode) . '</abbr>');
      }
      else {
        $link['title'] = $this->t('@language (unavailable)', [
          '@language' => $link['text'],
        ], [
          'langcode' => $langcode,
        ]);
        $link['text_attributes']['lang'] = $langcode;
        $link['text_attributes']['aria-label'] = $link['title'];
        $link['text'] = strtoupper($langcode);
        // Remove the link to maintain compatibility with existing Twig
        // templates. Also, remove the 'data-drupal-link-system-path' attribute
        // to prevent misinterpretation when the route is '<nolink>'.
        unset($link['link'], $link['attributes']['data-drupal-link-system-path']);
      }
    }
  }

}
