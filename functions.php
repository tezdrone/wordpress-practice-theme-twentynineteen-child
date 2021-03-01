<?php

//Load the style sheets
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . "/style.css");
  wp_enqueue_style(
    'child-style',
    get_stylesheet_directory_uri() . "/style.css",
    //Force parent style to load first
    ['parent-style'],
    //Ensure the theme version is the same as the cached version
    wp_get_theme()->get('Version')
  );
}