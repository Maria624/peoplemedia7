<?php
/**
 * The template for displaying search results pages.
 *
 * @package AccessPress Mag
 */

get_header(); ?>

<?php do_action( 'accesspress_mag_before_body_content' ); ?>

<div class="apmag-container">
     <?php   
        $accesspress_mag_show_breadcrumbs = of_get_option( 'show_hide_breadcrumbs', '1' );
        if( !empty( $accesspress_mag_show_breadcrumbs ) && $accesspress_mag_show_breadcrumbs == '1' ) {
            accesspress_mag_breadcrumbs();
        }
        $search_result_text = of_get_option( 'trans_search_results_for', 'Search Results for' );
        if( empty( $search_result_text ) ) {
            $search_result_text = __( 'Search Results for ', 'accesspress-mag' );
        }
    ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><span><?php /* translators: %s : search keyword */ printf( esc_html($search_result_text) . esc_html__( ': %s', 'accesspress-mag' ), '</span><span>' . esc_html(get_search_query()) . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php accesspress_mag_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php 
	$sidebar_option = of_get_option( 'global_archive_sidebar', 'right-sidebar' );
	if( $sidebar_option != 'no-sidebar' ){
	    $option_value = explode( '-', $sidebar_option ); 
	    get_sidebar( $option_value[0] );
	}
?>
</div><!-- .apmag-container -->

<?php do_action( 'accesspress_mag_after_body_content' ); ?>

<?php get_footer(); ?>