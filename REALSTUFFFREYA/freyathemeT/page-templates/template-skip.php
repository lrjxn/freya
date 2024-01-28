<?php
/*
Template Name: Skip to Child
*/
$children = get_pages("child_of=".$post->ID."&sort_column=menu_order");
if ($children) {
   $firstchild = $children[0];
   wp_redirect(get_permalink($firstchild->ID));
} else {
   wp_redirect(get_home_url());
}
?>