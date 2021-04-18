<?php

/**
 * @file
 * Utilities used by the theme preprocess functions.
 */

/**
 * Strips the html comments from a given markup.
 */
function _kiso_strip_comments(?string $markup) {
  $non_conditional_html_comments_pattern = '/<!--(.|\s)*?-->\s*|\r|\n/';
  return preg_replace($non_conditional_html_comments_pattern, '', $markup);
}
