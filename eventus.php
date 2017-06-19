<?php
/*
Plugin Name: eMesh_Plugin
*/

/* Adicion de opciones para la PÁGINA DE PLUGIN */
function emesh_settings_page(){
    ?>
	    <div class="wrap">
	    <h1>eMesh Panel</h1>
        <p>Aquí puede añadir el <b>nombre del evento</b> y el <b>identificado del botón</b> que usará para mostrar los tickets en la página de su evento.</p>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("emesh_plugin_options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function display_event_slug_element()
{
	?>
    	<input type="text" name="event_slug" id="event_slug" value="<?php echo get_option('event_slug'); ?>" />
    <?php
}

function display_ID_event_element()
{
	?>
    	<input type="text" name="ticket_btn_ID" id="ticket_btn_ID" value="<?php echo get_option('ticket_btn_ID'); ?>" />
    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "Datos Necesarios", null, "emesh_plugin_options");
	
	add_settings_field("event_slug", "Nombre del Evento (event-slug)", "display_event_slug_element", "emesh_plugin_options", "section");
    add_settings_field("ticket_btn_ID", "ID de botón para tickets", "display_ID_event_element", "emesh_plugin_options", "section");

    register_setting("section", "event_slug");
    register_setting("section", "ticket_btn_ID");
}

add_action("admin_init", "display_theme_panel_fields");


/* Adición de ITEM DE MENU en panel de control */
// Ejemplo tomado de:  
http://www.codigonexo.com/blog/wordpress-programadores/menus-y-submenus-en-el-panel-admin-de-wordpress/

// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

function emesh_custom_menu() {
    add_menu_page ( 'eMesh Panel', 'eMesh Panel', 'read', 'emesh', 'emesh_settings_page', '', 101);
}

add_action( 'admin_menu', 'emesh_custom_menu');


/* Adición de script emesh */



/* Adición de script emesh */
function emesh_script() {
    ?>
    <script src="https://djucwc9s0p8ku.cloudfront.net/static/website/js/emesh.js"></script>
    <script>
	Emesh.settings('<?php echo get_option('event_slug'); ?>','<?php echo get_option('ticket_btn_ID'); ?>');
    </script>
   <?php
   
}
add_action( 'wp_footer', 'emesh_script' );


// https://codex.wordpress.org/Creating_Options_Pages