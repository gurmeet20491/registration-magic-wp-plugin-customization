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


?>