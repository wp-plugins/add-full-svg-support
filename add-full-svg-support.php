<?php
/**
 * Plugin Name: Add Full SVG Support
 * Plugin URI: http://www.jenskuerschner.de/svg-images-with-png-fallback-in-wordpress/
 * Description: Upload SVG files to your WordPress and use them anywhere you want via shortcode. Include a fallback image and also add style-information.
 * Version: 1.0.0
 *
 * Author: Jens K&uuml;rschner
 * Author URI: http://www.jenskuerschner.de
 *
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/*  2014 Jens K&uuml;rschner  (email : mail@jenskuerschner.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die("No script kiddies please!");


// Add functionality to upload SVG files in WordPress
function svg_upload ($svg_mime) {
    $svg_mime['svg'] = 'image/svg+xml';
    return $svg_mime;
}
add_filter( 'upload_mimes', 'svg_upload' );


// Add a shortcode to implement them with a fallback solution in any frontend editor
function generate_svg_code($atts) {
    $svga = shortcode_atts( array(
    'width' => '0px',
    'height' => '0px',
    'svg_path' => '',
    'alt_path' => '',
    'alt' => '',
    'style' => '',
    ), $atts ); 
    return '<svg xmlns="http://www.w3.org/2000/svg" style="'.htmlentities($svga['style'], ENT_QUOTES).'" width="'.htmlentities($svga['width'], ENT_QUOTES).'" height="'.htmlentities($svga['height'], ENT_QUOTES).'"><image xlink:href="'.htmlentities($svga['svg_path'], ENT_QUOTES).'" src="'.htmlentities($svga['alt_path'], ENT_QUOTES).'" width="'.htmlentities($svga['width'], ENT_QUOTES).'" height="'.htmlentities($svga['height'], ENT_QUOTES).'" alt="'.htmlentities($svga['alt'], ENT_QUOTES).'" /></svg>';
}
add_shortcode('do-svg', 'generate_svg_code');

?>