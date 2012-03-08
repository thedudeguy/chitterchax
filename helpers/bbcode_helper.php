<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* CodeIgniter BBCode Helpers
*
* @package  CodeIgniter
* @subpackage Helpers
* @category Helpers
* @author  Philip Sturgeon
* @changes  MpaK http://mrak7.com
* @link  http://codeigniter.com/wiki/BBCode_Helper/
*/

// ------------------------------------------------------------------------

/**
* parse_bbcode
*
* Converts BBCode style tags into basic HTML
*
* @access public
* @param string unparsed string
* @param int max image width
* @return string
*/
function parse_bbcode($str = '', $max_images = 0) {
    // Max image size eh? Better shrink that pic!
    if($max_images > 0):
        $str_max = "style=\"max-width:".$max_images."px; width: [removed]this.width > ".$max_images." ? ".$max_images.": true);\"";
    endif;

    $find = array(
      "'\[b\](.*?)\[/b\]'is",
      "'\[i\](.*?)\[/i\]'is",
      "'\[u\](.*?)\[/u\]'is",
      "'\[s\](.*?)\[/s\]'is",
      "'\[img\](.*?)\[/img\]'i",
      "'\[url\](.*?)\[/url\]'i",
      "'\[url=(.*?)\](.*?)\[/url\]'i",
      "'\[link\](.*?)\[/link\]'i",
      "'\[link=(.*?)\](.*?)\[/link\]'i",
      "'\[color=(.*?)\](.*?)\[/color\]'i",
    );

    $replace = array(
      '<strong>\\1</strong>',
      '<em>\\1</em>',
      '<u>\\1</u>',
      '<s>\\1</s>',
      '<img src="\\1" alt="" />',
      '<a href="\\1">\\1</a>',
      '<a href="\\1">\\2</a>',
      '<a href="\\1">\\1</a>',
      '<a href="\\1">\\2</a>',
      '<span style="color:\\1;">\\2</span>'
    );

    return preg_replace($find, $replace, $str);

}
