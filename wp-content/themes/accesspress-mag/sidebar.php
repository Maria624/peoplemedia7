<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package AccessPress Mag
 */

if ( ! is_active_sidebar( 'accesspress-mag-sidebar-right' ) ) {
	return;
}
?>
<div id="secondary-right-sidebar">
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'accesspress-mag-sidebar-right' ); ?>
	</div><!-- #secondary -->
</div><!-- #secondary-right-sidebar -->