<?php 
    //common function to get custom role :: inserted from registration magic form ////

    function get_custom_role($user_id){
        
        $user_meta = get_user_meta($user_id);
        $registration_magic_form_submission_id =  $user_meta['RM_UMETA_SUB_ID'][0];
        
    if($registration_magic_form_submission_id){
    global $wpdb;
    $row =  $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."rm_submissions WHERE submission_id =".  $registration_magic_form_submission_id);
        $data = unserialize($row->data);
        
        foreach ($data as $item) {
            if ($item->label === 'Role') {
                return $item->value;
                break;
            }
        }
    }

    }

    // Set the Global variable Custom role to be used anywhere //
    function set_status_variable() {
        global $custom_role;
        if (is_user_logged_in()) {
            $current_user_id = get_current_user_id();
            $custom_role = get_custom_role($current_user_id);
        }
    }
    add_action('wp_head', 'set_status_variable');

?>