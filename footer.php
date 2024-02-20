<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package umova
 */

?>
	<?php 
		$footer_logic = get_field('footer_logic', 'option');
		if ($footer_logic == 'first') {
			$footer_bg = get_field('footer_bg_color_one', 'option');
			$footer_color = get_field('footer_text_color_one', 'option');
			$nav_color = 'nav-color--1';
		} else {
			$footer_bg = get_field('footer_bg_color_two', 'option');
			$footer_color = get_field('footer_text_color_two', 'option');
			$nav_color = 'nav-color--2';
		}
	?>
	<footer id="colophon" class="site-footer" style="background: <?php echo $footer_bg; ?>">
		<div class="site-info">
			<p class="site-title"><a style="color: <?php echo $footer_color; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		</div><!-- .site-info -->
		<div class="footer-nav <?php echo esc_attr($nav_color); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer',
				)
			);
			?>
		</div>
		<div class="copyright">
			<p style="color: <?php echo $footer_color; ?>"><?php echo wp_kses_post('&#169;'); ?> <?php esc_html_e('Copyright', 'umova') ?></p>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
