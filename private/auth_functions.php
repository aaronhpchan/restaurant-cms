<?php 

function log_in_admin($admin) {
    session_regenerate_id(); // protects the admin from session fixation
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];
    return true;
}

?>