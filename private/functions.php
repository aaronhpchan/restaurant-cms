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
        $output .= "<div class=\"errors\">";
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

?>