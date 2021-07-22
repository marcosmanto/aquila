<?php
/**
 * Single post template file.
 *
 * @package Aquila
 */

  get_header();

?>

<div id="primary">

  <main id="main" class="site-main" role="main">
    <div class="row">
      <div class="col-sm-12">
          <?php

        while( have_posts() ) : the_post();
          get_template_part( 'template-parts/components/blog/entry-header' );
          the_content();
        endwhile;

        ?>
      </div>
    </div>
  </main>

</div>

<?php
get_footer();