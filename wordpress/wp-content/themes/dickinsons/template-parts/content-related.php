<?php
/**
 * The template part for displaying content
 *
 * @package Dickinsons
 * @since Dickinsons 1.0.0
 */
?>

<div class="module module--related-news">
	<h3 class="module--title">Related reads</h3>
	<ul>

		<?php
		$orig_post = $post;
		global $post;
		$tags = wp_get_post_tags($post->ID);

		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>4, // Number of related posts to display.
				'caller_get_posts'=>1
			);

			$my_query = new wp_query( $args );

			while( $my_query->have_posts() ) {
				$my_query->the_post();
				?>

				<li><a href="<? the_permalink()?>"><?php the_title(); ?></a></li>

			<?php }
		}
		$post = $orig_post;
		wp_reset_query();
		?>

	</ul>
</div>

