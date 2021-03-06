<?php

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
  return !empty(_kiso_strip_tags($cleaned_region_output, $allowed_tags));
}

/**
 * Strips html tags, except allowed, returning a trimmed clean markup.
 */
function _kiso_strip_tags(string $markup, string $allowed_tags = '') {
  $allowed_tags .= '<drupal-render-placeholder><img>';
  return trim(strip_tags($markup, $allowed_tags));
}
