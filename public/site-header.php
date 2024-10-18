<?php
/**
 * Site Header
 */

require __DIR__ . '/../vendor/autoload.php';

use App\RSS_Query;
use function App\the_category_links;

global $rss;
$rss = new RSS_Query( 'https://www.propublica.org/feeds/propublica/main' );

?><!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $rss->getTitle(); ?> RSS Express</title>
	<meta name="description" content="<?php echo $rss->getDescription(); ?>">
    <link rel="stylesheet" href="dist/styles.css">
	<link rel="icon" href="/favicon.ico" sizes="any">
	<meta name="theme-color" content="#1b2127">
</head>
<body>
	<header class="site-header">
		<a href="/" rel="home" class="site-header__home-link">
			<img class="site-header__image" src="<?php echo $rss->getImage()['url']; ?>" alt="<?php echo $rss->getImage()['title']; ?>">
		</a>
		<nav class="site-header__nav">
			<ul class="site-header__nav-menu">

				<?php the_category_links(); ?>

				<li>
					<a class="site-header__nav-link" href="index.php#latest">Latest</a>
				</li>
				<li>
					<a class="site-header__nav-link" href="#about">About</a>
				</li>
			</ul>
		</nav>
	</header>
