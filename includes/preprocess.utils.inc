<?php

/**
 * Small function to render the regions without passing them by reference.
 * 
 * @param $region
 *
 * @return mixed
 */
function _kiso_render_region($region){
  return \Drupal::service('renderer')->render($region);
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
  $non_conditional_html_comments_pattern = '/<!--(.|\s)*?-->\s*|\r|\n/';
  $cleaned_region_output = preg_replace($non_conditional_html_comments_pattern, '', $markup);
  return !empty(_kiso_strip_tags($cleaned_region_output));
}

/**
 * Strips html tags, except allowed, returning a trimmed clean markup.
 */
function _kiso_strip_tags(string $markup, string $allowed_tags = '') {
  $text = strip_tags($markup, [
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
  ]);
  $text = twig_trim_filter($text);
  return $text;
}
