<?php

    // is_blank('abcd')
    // * uses trim() so whitespace doesn't count
    // * better than empty() which considers "0" to be empty
    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    // has_presence('abcd')
    // * validate data presence
    // * reverse of is_blank()
    function has_presence($value) {
        return !is_blank($value);
    }

    // has_length_greater_than('abcd', 3)
    // * spaces count towards length since trim() is not used here
    // * use trim() if spaces should not count
    function has_length_greater_than($value, $min) {
        $length = strlen($value);
        return $length > $min;
    }

    // has_length_less_than('abcd', 5)
    // * spaces count towards length since trim() is not used here
    // * use trim() if spaces should not count
    function has_length_less_than($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }

    // has_length_exactly('abcd', 4)
    // * spaces count towards length since trim() is not used here
    // * use trim() if spaces should not count
    function has_length_exactly($value, $exact) {
        $length = strlen($value);
        return $length == $exact;
    }

    // has_length('abcd', ['min' => 3, 'max' => 5])
    // * combines functions_greater_than, _less_than, _exactly
    // * spaces count towards length since trim() is not used here
    // * use trim() if spaces should not count
    function has_length($value, $options) {
        if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
            return false;
        } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
            return false;
        } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
            return false;
        } else {
            return true;
        }
    }

    // has_inclusion_of( 5, [1,3,5,7,9] )
    // * validate inclusion in a set
    function has_inclusion_of($value, $set) {
        return in_array($value, $set); // PHP built-in function which checks if $value is in the array of $set
    }

    // has_exclusion_of( 5, [1,3,5,7,9] )
    // * validate exclusion from a set
    function has_exclusion_of($value, $set) {
        return !in_array($value, $set);
    }

    // has_string('nobody@nowhere.com', '.com')
    // * validate inclusion of character(s)
    // * strpos returns string start position or false
    // * uses !== to prevent position 0 from being considered false
    // * strpos is faster than preg_match()
    function has_string($value, $required_string) {
        return strpos($value, $required_string) !== false;
    }

    // has_valid_email_format('nobody@nowhere.com')
    // * format: [chars]@[chars].[2+ letters]
    // * preg_match uses regular expression
    //    returns 1 for a match, 0 for no match
    function has_valid_email_format($value) {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex, $value) === 1;
    }

    // has_unique_username('johndoe')
    // * Validates uniqueness of admins.username
    // * For new records, provide only the username.
    // * For existing records, provide current ID as second arugment
    //   has_unique_username('johndoe', 4)
    function has_unique_username($username, $current_id="0") {
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
        $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

        $result = mysqli_query($db, $sql);
        $admin_count = mysqli_num_rows($result);
        mysqli_free_result($result);
        return $admin_count === 0; // if admin count is zero, then the name is unique
    }

    // has_unique_subject_menu_name('Mission')
    // * Validates uniqueness of subjects.menu_name
    // * For new records, provide only the menu_name.
    // * For existing records, provide current ID as second arugment
    //   has_unique_subject_menu_name('Mission', 4)
    function has_unique_subject_menu_name($menu_name, $current_id="0") {
        global $db;
        $sql = "SELECT * FROM subjects ";
        $sql .= "WHERE menu_name='" . db_escape($db, $menu_name) . "' ";
        $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

        $subject_set = mysqli_query($db, $sql);
        $subject_count = mysqli_num_rows($subject_set);
        mysqli_free_result($subject_set);
        return $subject_count === 0; // if subject count is zero, then the name is unique
    }

    // has_unique_product_menu_name('Strawberry Shortcake')
    // * Validates uniqueness of products.menu_name
    // * For new records, provide only the menu_name.
    // * For existing records, provide current ID as second arugment
    //   has_unique_product_menu_name('Strawberry Shortcake', 4)
    function has_unique_product_menu_name($menu_name, $current_id="0") {
        global $db;
        $sql = "SELECT * FROM products ";
        $sql .= "WHERE menu_name='" . db_escape($db, $menu_name) . "' ";
        $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

        $product_set = mysqli_query($db, $sql);
        $product_count = mysqli_num_rows($product_set);
        mysqli_free_result($product_set);
        return $product_count === 0; // if product count is zero, then the name is unique
    }

?>
