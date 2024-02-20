<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package umova
 */

 $exists = get_field('exists', 'option');
 $sidebar_color = get_field('sidebar_color', 'option');
 if ($exists == 'left') {
	if ($sidebar_color == 'first') {
		$sidebar_bg = get_field('sidebar_bg_color_one', 'option');
		$side_color = 'side-color--1';
	} else {
		$sidebar_bg = get_field('sidebar_bg_color_two', 'option');
		$side_color = 'side-color--2';
	}
?>


<aside id="secondary" class="widget-area <?php echo $side_color; ?>" style="background: <?php echo $sidebar_bg; ?>">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>
</aside><!-- #secondary -->
<?php } ?>