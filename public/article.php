<?php
/**
 * Article
 * Single post content page.
 */

include 'site-header.php';
$slug = (string) isset( $_GET['id'] ) ? $_GET['id'] : '';
$article = $rss->getArticle( $slug );
if ( ! $article ) :
	?>
	<main class="site-main site-main--404">
		<h1>404: Not Found</h1>
	</main>
	<?php
else :
	$category = $article['subject'];
	$title = $article['title'];
	$pubDate = $article['pubDate'];
	$content = $article['description'];
	$link = $article['link'];
	?>
	<main class="site-main site-main--article">

		<article class="article">
			<p class="article__category"><?php echo $category; ?></p>
			<h1><?php echo $title; ?></h1>
			<p class="article__pub-date"><?php echo $pubDate; ?></p>
			<div class="article__content">
				<?php echo $content; ?>
			</div>
			<div class="article__links">
				<a href="index.php">Back to Home</a>
				<a href="<?php echo $link; ?>" target="_blank" rel="noopener">View Original</a>
				<a href="#top">Back to Top</a>
			</div>
		</article>

	</main>
	<?php
endif;
include 'site-footer.php';
