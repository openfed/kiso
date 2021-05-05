<?php

/**
 * @file
 * Utilities used by the theme preprocess functions.
 */

/**
 * Strips the html comments from a given markup.
 */
function _kiso_strip_comments(string $markup) {
  $non_conditional_html_comments_pattern = '/<!--(.|\s)*?-->\s*|\r|\n/';
  return preg_replace($non_conditional_html_comments_pattern, '', $markup);
}

/**
 * Strips html tags, except allowed, returning a trimmed clean markup.
 */
function _kiso_strip_tags(string $markup, string $allowed_tags = '') {
  $allowed_tags .= '<drupal-render-placeholder><img>';
  return trim(strip_tags($markup, $allowed_tags));
}
