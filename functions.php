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

//Plugs into the twentynineteen theme and overrides the function
function twentynineteen_the_posts_navigation()
{
  the_posts_pagination(
    array(
      'mid_size'  => 2,
      'prev_text' => '&laquo; <span class="nav-prev-text">Newer</span>',
      'next_text' => '<span class="nav-next-text">Older</span> &r aquo;',
    )
  );
}

//If a post is in the category block, add "Cat is block!:" to the start of the title when rendering
function block_titles($title, $id = null)
{
  if (in_category('block', $id)) {
    $title = "Cat is Block!: " . $title;
  }

  return $title;
}
add_filter('the_title', 'block_titles', 10, 2);

//Remove the author from posts.
//We are returning an empty function because the parent theme has a plugable function
function twentynineteen_posted_by()
{
  //do nothing
}


//Remove functionality from parent theme after theme setup
function remove_parent_functionality()
{
  remove_action('widgets_init', 'twentynineteen_widgets_init');
}

add_action('after_setup_theme', 'remove_parent_functionality');