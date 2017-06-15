<?php
/*
Plugin Name: eMesh_Plugin
*/

function emesh_script() {
    ?>
    <script src="http://localhost:8000/static/website/js/emesh.js"></script>
    <script>
	Emesh.settings('latinity-25','#tototo');
    </script>
   <?php
   
}
add_action( 'wp_footer', 'emesh_script' );


// https://codex.wordpress.org/Creating_Options_Pages