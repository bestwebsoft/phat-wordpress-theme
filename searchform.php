<?php
/**
 * The template for displaying search form
 * @subpackage Phat
 * @since Phat 1.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/') ); ?>">
    <input type="text" name="s" id="s"  value="<?php _e( 'Enter search keyword', 'phat' ); ?>" onfocus="if ( this.value == '<?php _e( 'Enter search keyword', 'phat' ); ?>' ) { this.value = ''; }" 
    onblur="if ( this.value == '' ) { this.value = '<?php _e( 'Enter search keyword', 'phat'); ?>'; }" />
</form>
