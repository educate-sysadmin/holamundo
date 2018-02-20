<?php
/*
Plugin Name: Hola Mundo
Plugin URI: https://github.com/educate-sysadmin/holamundo
Description: Hello world test plugin
Version: 0.1
Author: b.cunningham@ucl.ac.uk
Author URI: https://educate.london
License: GPL2
*/
/* thanks http://www.wpexplorer.com/create-widget-plugin-wordpress/ */
class Hola_Mundo_Widget extends WP_Widget {

	// Main constructor
	public function __construct() {
        parent::__construct(
		    'hola_mundo_widget',
		    __( 'Hola Mundo Widget', 'text_domain' ),
		    array(
			    'customize_selective_refresh' => true,
		    )
	    );
	}

	// The widget form (for the backend )
	public function form( $instance ) {	
        // Set widget defaults
	    $defaults = array(
		    'title'    => 'Hola Mundo',
		    'text'     => 'Hola mundo',
	    );
        // Parse current settings with defaults
	    extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

        <?php // Widget Title ?>
	    <p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'text_domain' ); ?></label>
		    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	    </p>

	    <?php // Text Field ?>
	    <p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'text_domain' ); ?></label>
		    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
	    </p>
	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;
	    $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
	    $instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
	    return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {
        extract( $args );

	    // Check the widget options
	    $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
	    $text     = isset( $instance['text'] ) ? $instance['text'] : '';

	    // WordPress core before_widget hook (always include )
	    echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">'; 

		    // Display widget title if defined
		    if ( $title ) {
			    echo $before_title . $title . $after_title;
		    }

		    // Display text field
		    if ( $text ) {
			    echo '<p>' . $text . '</p>';
		    }

	    echo '</div>';

	    // WordPress core after_widget hook (always include )
	    echo $after_widget;
	}
}

// Register the widget
function register_hola_mundo_widget() {
	register_widget( 'Hola_Mundo_Widget' );
}
add_action( 'widgets_init', 'register_hola_mundo_widget' );
