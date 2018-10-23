<?php
// Add custom Theme Functions here


function get_user_device() {
    //Note: wp_is_mobile() detects ipad / mobile phones
    static $is_mobile, $is_tablet, $device_type;
    $is_tablet = false;

    if ( isset($is_mobile) )
        return $is_mobile;
    
    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;      
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_tablet = true;
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    if($is_mobile){
        $device_type = 'Mobile';
    }else if($is_tablet){
        $device_type = 'Tablet';
    }else{
        $device_type = 'Desktop';
    }
    
    //setcookie("current_user_device", $device_type, time()+3600);  /* expire in 1 hour */
    return $device_type;
}

/* SHOULD ALWAYS BE AT THE BOTTOM */
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
} 

function my_wp_is_mobile() {
    static $is_mobile;
    
    if ( isset($is_mobile) )
        return $is_mobile;
    
    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}
