<?php
/**
 * Site Footer
 */
?>

	<footer class="site-footer">

		<?php include '../inc/template-parts/about.php'; ?>

        <span class="site-footer__copyright">
            &copy; <?php echo date( 'Y' ); ?> <?php echo $rss->getTitle(); ?>
        </span>

        <div class="site-footer__full-site">
            <a class="site-footer__site-link" href="<?php echo $rss->getLink(); ?>" target="_blank" rel="noopener">
                <span>View The Full Site</span>
            </a>
        </div>

    </footer>
</body>
</html>
