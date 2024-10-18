<?php
/**
 * About RSS Express
 * Shows site info using metadata from the RSS feed.
 */
?>
<div id="about" class="about">
	<h1 class="about__title"><?php echo $rss->getTitle(); ?> RSS Expr<em>e</em>ss</h1>
    <p class="about__description"><?php echo $rss->getDescription(); ?></p>
</div>
