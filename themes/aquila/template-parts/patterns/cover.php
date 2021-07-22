<?php
/**
 * Cover Block Patterns Template
 *
 * @package aquila
 */

$cover_style_url = esc_url( AQUILA_BUILD_IMG_URI . '/patterns/cover.jpg' );
$cover_style = sprintf('background-image:url(%s);min-height:500px', $cover_style_url);

?>

<!-- wp:cover {"url":"<?php echo $cover_style_url ?>","id":3854,"minHeight":500,"align":"full","className":"aquila-cover"} -->
<div class="wp-block-cover alignfull has-background-dim aquila-cover" style="<?php echo esc_attr($cover_style) ?>"><div class="wp-block-cover__inner-container"><!-- wp:heading {"align":"center","level":1} -->
		<h1 class="has-text-align-center"><strong>Never let your memories be greater than your dreams</strong></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","textColor":"cyan-bluish-gray"} -->
		<p class="has-text-align-center has-cyan-bluish-gray-color has-text-color">A mind that is stretched by a new experience can never go back to its old dimensions.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"align":"center"} -->
		<div class="wp-block-buttons aligncenter"><!-- wp:button {"textColor":"cyan-bluish-gray","className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-cyan-bluish-gray-color has-text-color">Blogs</a></div>
			<!-- /wp:button --></div>
		<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

