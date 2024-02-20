<?php /* 
Template Name: Contacts 
*/?>
<?php get_header(); ?>
<?php
	// Output the content, including Gutenberg blocks
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			the_content();
		}
	}
?>
<?php get_footer(); ?>