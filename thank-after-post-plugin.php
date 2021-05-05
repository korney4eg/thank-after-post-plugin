<?php
/**
 * Plugin Name: Thank after post plugin
 * Description: Plugin that adds thank you after all posts
 * Version: PLUGIN_VERSION
 * Author: Aliaksei Karneyeu
 * Author URI: https://learningdevops.makvaz.com/
 */
add_action( 'the_content', 'thank_after_post' );

function thank_after_post ( $content ) {
    return $content .= '<p>Thanks for reading!<br>v PLUGIN_VERSION</p>';
}
