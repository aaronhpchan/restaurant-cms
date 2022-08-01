<?php

function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    } 
    return WWW_ROOT . $script_path;
}

// Encode URL parameters
function u($string = "") {
    return urlencode($string);
}
function raw_u($string = "") {
    return rawurlencode($string);
}

// Encode for HTML
function h($string = "") {
    return htmlspecialchars($string);
}

// Modify headers
function error_404() {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}
function error_500() {
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

// Page redirection
// * Header changes and page redirects must be sent before any HTML output
function redirect_to($location) {
    header("Location: " . $location);
    exit;
}

// Detect form submission
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// Display validation errors
function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
        $output .= "<div class=\"text-danger border border-2 border-danger px-3 pt-3 mb-3\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach($errors as $error) {
            $output .= "<li>" . h($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
} 

// Status messages
function get_and_clear_session_message() {
    if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        return $msg;
    }
}
function display_session_messages() {
    $msg = get_and_clear_session_message();
    if(!is_blank($msg)) {
        return '<p class="text-success fs-5 text-center p-2 mx-3 mt-1 border border-2 border-success rounded">' . h($msg) . '</p>';
    }
}

?>