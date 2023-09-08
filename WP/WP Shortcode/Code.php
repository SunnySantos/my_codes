<?php


// PARAMETERIZED
add_shortcode('my_shortcode','shortcode_func');

function shortcode_func($attributes) {

    $attributes = shortcode_atts(array(
        'first_name' => 'No first name',
        'last_name' => 'No last name'
    ), $attributes, 'my_shortcode'); // default values of attributes

    echo "First Name: " . $attributes['first_name'];
    echo "Last Name: " . $attributes['last_name'];

}

[my_shortcode first_name="Fname" last_name="Lname"]
// OUTPUT:
//      First Name: Fname
//      Last Name: Lname


[my_shortcode]
// OUTPUT:
//      First Name: No first name
//      Last Name: No last name






// TAG
add_shortcode('my_shortcode_tag','shortcode_tag_func');

function shortcode_tag_func($attributes, $content) {

    echo "<a href='" . esc_attr($attributes['url']) . "' title='" . esc_attr($attributes['title']) . "'> " . $content . "</a>";
}

[my_shortcode_tag url="https://www.google.com/" title="Google" ] My Tag [/my_shortcode_tag]