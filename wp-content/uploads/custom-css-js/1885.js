<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
function read_more_js() {
    if ( is_product_category() ) {
        wp_enqueue_script( 'load-more-js', esc_url( get_template_directory_uri() ) . '/js/read-more.js', array( 'jquery' ), null, true );
    }
}


</script>
<!-- end Simple Custom CSS and JS -->
