<?php
/**
 * Category Feed
 * List of category sections with an anchor link, title, and a list of posts.
 */

use function App\the_post_list;
use function App\slugify;
?>
<div class="feed feed--category">
	<?php foreach ( $rss->category_items as $category => $items ) : ?>
		<?php the_post_list( slugify( $category ), $rss->getCategoryTitle( $category ), $items ); ?>
	<?php endforeach; ?>
</div>
