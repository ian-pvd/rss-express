<?php
/**
 * Latest Feed
 * A list of all of the latest posts.
 */

use function App\the_post_list;
?>
<div class="feed feed--latest">
	<?php the_post_list( 'latest', 'Latest News', $rss->items ); ?>
</div>
