<?php
/**
 * Functions
 *
 * Helper functions and template tags.
 */

namespace App;

/* Helper Functions */
function slugify( $text ) {
	return strtolower( preg_replace( '/[^A-Za-z0-9-]+/', '-', trim( $text ) ) );
}

/* Template Tags */
function the_category_links() {
	global $rss;
	foreach ( $rss->categories as $slug => $category ) {
		?>
		<li>
			<a class="site-header__nav-link" href="index.php#<?php echo $slug; ?>"><?php echo $category; ?></a>
		</li>
		<?php
	}
}

function the_post_item( $item ) {
	$title = $item['title'];
	$slug = $item['slug'];
	$pubDate = $item['pubDate'];
	$byline = $item['creator'];
	$category = $item['subject'];
	?>
	<li class="post-item">
		<article class="post-item__article">
			<h3 class="post-item__title">
				<a class="post-item__link" href="article.php?id=<?php echo $slug; ?>">
					<?php echo $title; ?>
				</a>
			</h3>
			<p class="post-item__pub-date"><?php echo $pubDate; ?></p>

			<?php if ( ! empty( $byline ) ) : ?>
				<p class="post-item__byline">
					<?php echo $byline; ?>
				</p>
			<?php endif; ?>

			<?php if ( ! empty( $category ) ) : ?>
				<p class="post-item__category"><?php echo $category; ?></p>
			<?php endif; ?>
		</article>
	</li>
	<?php
}

function the_post_list( $slug, $title, $items ) {
	?>
	<section class="post-list" id="<?php echo $slug; ?>">
		<header class="post-list__header">
			<h2 class="post-list__title">
				<?php echo $title; ?>
			</h2>
			<a href="#top" class="post-list__top">
				Back to Top
			</a>
		</header>
		<ul class="post-list__feed">
			<?php
			foreach ( $items as $item ) {
				the_post_item( $item );
			}
			?>
		</ul>
	</section>
	<?php
}
