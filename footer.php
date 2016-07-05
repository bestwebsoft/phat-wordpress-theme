<?php
/**
 * The template for displaying the footer.
 * @subpackage Phat
 * @since      Phat 1.0
 */
?>
	</div> <!-- .content -->
	<footer>
		<?php wp_footer() ?>
		<div class='footer'>
			<div class='siteinfo'>
				<p><?php _e( 'Created by', 'phat' ); ?>
					<a class='siteinfo' href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>" target="_blank">BestWebLayout</a>
					<?php _e( 'and powered by', 'phat' ); ?>
					<a class='siteinfo' href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank">WordPress,</a>
					<?php echo date_i18n( 'Y' ); ?>
				</p>
				<p id="back-top">
					<a href="#top"><span></span></a>
				</p>
			</div> <!-- .siteinfo -->
		</div> <!-- .footer -->
	</footer> <!-- footer -->
</div> <!-- #wrapper -->
</body>
</html>
