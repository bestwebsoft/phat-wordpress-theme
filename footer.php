<?php
/**
 * The template for displaying the footer.
 * @subpackage Phat
 * @since Phat 1.0
 */
?> 
		<footer>
			<?php wp_footer() ?>
			<div class='footer'>
				<div class='siteinfo'>
					<p>	<?php _e( 'Created by', 'phat' ); ?> 
						<a class='siteinfo' href="<?php echo wp_get_theme()->get( 'AuthorURI' ); ?>" target="_blank"><?php printf( 'BestWebSoft ', '' ); ?></a>
						<?php _e( 'and powered by', 'phat' ); ?>
						<a class='siteinfo' href="http://www.wordpress.org" target="_blank"><?php _e( 'WordPress,', 'phat' ); ?></a>
						<?php echo ( date( 'Y' ) ); ?>
					</p>				
				</div> <!-- .siteinfo -->
			</div> <!-- .footer -->
		</footer> <!-- footer -->
		</div> <!-- #wrapper -->
	</body>
</html>
