<?php

use Twig\TwigFilter;

/**
 * Small function to render the regions without passing them by reference.
 *
 * @param $region
 *
 * @return mixed
 */
function _kiso_render_region($region) {
  return Drupal::service('renderer')->render($region);
}

/**
 * @file
 * Utilities used by the theme preprocess functions.
 */

/**
 * Properly detect if regions are empty.
 *
 * @param ?string $markup
 *   The rendered region markup to be tested if empty.
 * @param string $allowed_tags
 *   Allowed tags to be excluded from the strip HTML tags process.
 *
 * @return
 *   TRUE if the region exists and is not empty, FALSE otherwise.
 *
 * @see https://www.drupal.org/node/953034
 * @see https://drupal.stackexchange.com/questions/175389/how-do-i-properly-detect-if-region-is-empty
 */
function _kiso_has_region(?string $markup, string $allowed_tags = '') {
  if (empty($markup)) {
    return FALSE;
  }

  if (Drupal::service('module_handler')->moduleExists('twig_real_content')) {
    $filters = Drupal::service('twig_real_content.twig_extension')
      ->getFilters();
    $key = array_search('real_content', array_map(function(TwigFilter $filter) {
      return $filter->getName();
    }, $filters), TRUE);
    $callable = $filters[$key]->getCallable();

    $real_content = $callable($markup);

    return !empty($real_content);
  }
  else {
    $non_conditional_html_comments_pattern = '/<!--(.|\s)*?-->\s*|\r|\n/';
    $cleaned_region_output = preg_replace($non_conditional_html_comments_pattern, '', $markup);

    return !empty(_kiso_strip_tags($cleaned_region_output, $allowed_tags));
  }
}

/**
 * Strips html tags, except allowed, returning a trimmed clean markup.
 *
 * @param string $markup
 *  Original markup.
 * @param string|array $allowed_tags
 *  Allowed tags, can be an array of tag of a string.
 *
 * @return string
 * @throws \Twig\Error\RuntimeError
 */
function _kiso_strip_tags(string $markup, string|array $allowed_tags) {
  $allowed_tags_base = [
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

  if (is_string($allowed_tags)) {
    $allowed_tags .= implode('', $allowed_tags_base);
  }
  elseif (is_array($allowed_tags)) {
    $allowed_tags = array_merge($allowed_tags_base, $allowed_tags);
  }

  $text = strip_tags($markup, $allowed_tags);
  $text = trim($text);
  return $text;
}
