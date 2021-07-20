<?php
/**
 * Single post template file.
 *
 * @package Aquila
 */

  get_header();

?>

<div id="primary">

  <main id="main" class="site-main mt-5" role="main">
    <div class="row">
      <div class="col-md-8 col-sm-12">
      <?php
			if ( have_posts() ) :
			?>
				<div class="post-wrap">
					<?php
					if ( is_home() && ! is_front_page() ) {
					?>
						<header class="mb-5">
							<h1 class="page-title screen-reader-text">
								<?php single_post_title(); ?>
							</h1>
						</header>
						<?php
					}

          while( have_posts() ) : the_post();
            get_template_part('template-parts/content');
          endwhile;

					?>
				</div>
			<?php
			else :

				get_template_part( 'template-parts/content-none' );

			endif;

      $prev_link = get_previous_post_link();
      $next_link = get_next_post_link();
      echo <<<EOT
          <div>$prev_link</div>
          <div>$next_link</div>
          EOT;
      ?>
      </div>
      <div class="col-md-4 col-sm-12">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </main>

</div>

<?php
get_footer();