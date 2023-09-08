<?php


$conditions = array(
    'post_type' => 'post',
    'post_type' => array('post', 'product'), // Display multiple post type
    'post_status' => 'publish',

    // BY POST
    'p' => 1, // Display post by ID
    'name' => 'post-name', // Use post_name or post slug

    // BY PAGE
    'page_id' => 1,
    'pagename' => 'sample-post', // Use page slug

    // BY AUTHOR
    'author' => 1, // Post of author id 1 will be displayed.
    'author' => -1, // Display all posts of the authors except author with ID of 1. The value should have negative sign.
    'author' => "1,2" // Display all posts created by author ID 1 and 2
    'author_name' => 'admin', // Display the created post of nickname admin
    'author_name' => 'admin, admin2', // Display the created post of nickname admin and nickname admin2
    'author__in' => array(1,2), // Display all posts of the author included in the array of author ID
    'author__not_in' => array(1,2), // Display all posts of the author except in the array of author ID
    
    // BY CATEGORY
    'cat' => 1,
    'cat' => "2,3",
    'cat' => -1,
    'category_name' => "php-framework", // Use category slug
    'category_name' => "php-frameworkm, wordpress", // Use category slug
    'category__in' => array(1,2),
    'category__not_in' => array(1,2),

    // BY TAG
    'tag_id' => 1,
    'tag_id' => "2,3",
    'tag_id' => -1,
    'tag' => 'cakephp', // Use tag slug
    'tag' => 'cakephp, wordpress-tag', // Use tag slug
    'tag__in' => array(2,3),
    'tag__not_in' => array(2,3),

    // SEARCH
    's' => 'keyword' // URL: www.website.com/?s=keyword
                    // Keyword will match to post title and post content

)

$the_query = new WP_Query($conditions);