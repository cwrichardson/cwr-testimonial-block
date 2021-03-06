<?php
/**
 * The actual block display.
 *
 * @module cwr-testimonials-block
 */

function cwr_testimonial_render_callback( $block_attributes ) {
	wp_enqueue_script( 'cwr_testimonial_block_slider' );

	$args = array(
		'post_type' => 'cwr_testimonial_page',
	);

	$the_block = '<div class="testimonial-wrapper">No testimonials "
		. "found. Please create some first."</div>';

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		$post_count = 0;
		$the_block = <<<'EOD'
		<!-- Swiper grid wrapper -->
		<div class="swiper-grid">
		<!-- Testimonial outer wrapper -->
		<div class="swiper">
		<!-- Testimonial container -->
		<div class="swiper-wrapper">
EOD;
		while ( $the_query->have_posts() ) {
			$post_count++;
			$the_query->the_post();
			$meta = get_post_meta( get_the_id() );
			$rating = esc_html( $meta[ 'cwr_testimonial_star_rating' ][ 0 ] );

			$the_block .= '<div class="swiper-slide testimonial fade" '
				. 'data-rating="' . $rating . '">';

			if ( array_key_exists( 'cwr_testimonial_profile_pic', $meta ) ) {
				$the_block .= '<div class="image-wrap">';
				$img_ID = $meta[ 'cwr_testimonial_profile_pic' ][ 0 ];
				$the_block .=
					wp_get_attachment_image( $img_ID, 'thumbnail', false,
					array( 'alt' => get_the_title() . ' profile picture' )
				)
					. '</div>';
			}

			if ( array_key_exists( 'cwr_testimonial_star_rating', $meta ) ) {
				$the_block .= '<div class="testimonial-rating stars" '
					. 'aria-role="img" aria-label="'
					/* translators: 1: star rating (number) */
					. __( sprintf( 'Rating: %1$s out of 5 stars', $rating ) )
					. '"></div>';
			}

			$the_block .= '<div class="testimonial-content">"'
				. get_the_content() . '"</div>';
			$the_block .= '<div class="reviewer">' . get_the_title() . '</div>';

			if ( array_key_exists( 'cwr_testimonial_jobrole', $meta ) ) {
				$the_block .= '<div class="jobrole">'
					. esc_html( $meta[ 'cwr_testimonial_jobrole' ][ 0 ] )
					. '</div>';
			}

			$the_block .= '</div>';
		}

		$the_block .=<<<'EOD'
		</div> <!-- Testimonial container -->

		<!-- dots/circles -->
		<div class="swiper-pagination"></div>
EOD;

		/*
		for ( $i = 1; $i <= $post_count; $i++ ) {
			$the_block .= '<span class="testimonial-dot"></span>';
		}
		*/

		$the_block .=<<<'EOD'
	  </div> <!-- Testimonial outer wrapper -->
	  </div> <!-- Swiper grid wrapper -->
EOD;
	}

	return $the_block;
}
