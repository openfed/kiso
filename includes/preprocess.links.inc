<?php

/**
 * @file
 * Prepares variables for the set of links template.
 */

use Drupal\Core\Render\Markup;

/**
 * Implements hook_preprocess_HOOK() for links--language-block.html.twig.
 */
function kiso_preprocess_links__language_block(&$variables) {
  // Use language code instead of full name for language switcher block.
  //
  // Related WCAG resources:
  //  - SC 3.1.2 Language of Parts (Level AA):
  //    - H58: Using language attributes to identify changes in the human language.
  //  - SC 3.1.4 Abbreviations (Level AAA):
  //    - H28: Providing definitions for abbreviations by using the abbr element.
  //  - SC 4.1.2 Name, Role, Value (Level A):
  //    - ARIA14: Using aria-label to provide an invisible label where a visible
  //      label cannot be used 
  // 
  foreach ($variables['links'] as $langcode => &$link) {
    if ($link['link']['#url']->getRouteName() !== '<nolink>') {
      $language_name = t('@language', ['@language' => $link['text']], ['langcode' => $langcode]);
      $link['link']['#options']['attributes']['lang'] = $langcode;
      $link['link']['#options']['attributes']['aria-label'] = $language_name;
      $link['link']['#title'] = Markup::create('<abbr title="' . $language_name . '">' . strtoupper($langcode) . '</abbr>');
    }
    else {
      $link['title'] = t('@language (unavailable)', ['@language' => $link['text']], ['langcode' => $langcode]);
      $link['text_attributes']['lang'] = $langcode;
      $link['text_attributes']['aria-label'] = $link['title'];
      $link['text'] = strtoupper($langcode);
      unset($link['attributes']['data-drupal-link-system-path']);
    }
  }
}
