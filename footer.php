	<footer class="clearfix" id="colophon" role="contentinfo">
		<?php dynamic_sidebar( 'Footer Area' ); ?>
	</footer><!-- end footer -->
<?php 
//must call wp_footer right before </body> for JS and plugins to run!
wp_footer();  ?>
</body>
</html>