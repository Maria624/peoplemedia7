<?php
/**
 * Define fields for widgets
 *
 * @package AccessPress Mag
 */
function accesspress_mag_widgets_show_widget_field($instance = '', $widget_field = '', $athm_field_value = '') {
   
    extract($widget_field);

    switch ($accesspress_mag_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($accesspress_mag_widgets_name)); ?>"><?php echo esc_html($accesspress_mag_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($accesspress_mag_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($accesspress_mag_widgets_name)); ?>" type="text" value="<?php echo esc_attr($athm_field_value) ; ?>" />

                <?php if (isset($accesspress_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($accesspress_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;
            
        //title    
        case 'title' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($accesspress_mag_widgets_name)); ?>"><?php echo esc_html($accesspress_mag_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($accesspress_mag_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($accesspress_mag_widgets_name)); ?>" type="text" value="<?php echo esc_attr($athm_field_value) ; ?>" />

                <?php if (isset($accesspress_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($accesspress_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($accesspress_mag_widgets_name)); ?>"><?php echo esc_html($accesspress_mag_widgets_title); ?>:</label>
                <select name="<?php echo esc_attr($instance->get_field_name($accesspress_mag_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($accesspress_mag_widgets_name)); ?>" class="widefat">
                    <?php foreach ($accesspress_mag_widgets_field_options as $athm_option_name => $athm_option_title) { ?>
                        <option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id($athm_option_name)); ?>" <?php selected($athm_option_name, $athm_field_value); ?>><?php echo esc_html($athm_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($accesspress_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($accesspress_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;
    }
}

function accesspress_mag_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    // Allow only integers in number fields
    if ($accesspress_mag_widgets_field_type == 'number') {
        return absint($new_field_value);

        // Allow some tags in textareas
    } elseif ($accesspress_mag_widgets_field_type == 'textarea') {
        // Check if field array specifed allowed tags
        if (!isset($accesspress_mag_widgets_allowed_tags)) {
            // If not, fallback to default tags
            $accesspress_mag_widgets_allowed_tags = '<p><strong><em><a>';
        }
        
        return strip_tags($new_field_value, $accesspress_mag_widgets_allowed_tags);

        // No allowed tags for all other fields
    } elseif ($accesspress_mag_widgets_field_type == 'iframe_textarea') {
        // Check if field array specifed allowed tags
        if (!isset($accesspress_mag_widgets_allowed_tags)) {
            // If not, fallback to default tags
            $accesspress_mag_widgets_allowed_tags = '<iframe>';
        }
        
        return strip_tags($new_field_value, $accesspress_mag_widgets_allowed_tags);

        // No allowed tags for all other fields
    } 
    
    
    elseif ($accesspress_mag_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    }
    elseif ($accesspress_mag_widgets_field_type == 'title') {
        return wp_kses_post($new_field_value);
    }
    else {
        return strip_tags($new_field_value);
    }
}

/**
 * Enqueue scripts for file uploader
 */
function optionsframework_media_scriptss($hook) {

    if (function_exists('wp_enqueue_media'))
        wp_enqueue_media();

    wp_register_script('of-media-uploader', OPTIONS_FRAMEWORK_DIRECTORY . 'js/media-uploader.js', array('jquery'), 1.70);
    wp_enqueue_script('of-media-uploader');
    wp_localize_script('of-media-uploader', 'optionsframework_l10n', array(
        'upload' => __('Upload', 'accesspress-mag'),
        'remove' => __('Remove', 'accesspress-mag')
    ));

    wp_enqueue_style( 'accesspress-mag-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
}

add_action('admin_enqueue_scripts', 'optionsframework_media_scriptss');