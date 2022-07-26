<?php
    /* PAGES */
    function find_all_pages($options=[]) {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM pages ";
        if($visible) { $sql .= "WHERE visible = true "; }
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_page_by_id($id, $options=[]) {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM pages WHERE id='" . db_escape($db, $id) . "' ";
        if($visible) { $sql .= "AND visible = true"; }
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page; // returns an assoc array, not a result set
    } 

    function validate_page($page) {
        $errors = [];
       
        // menu_name
        if(is_blank($page['menu_name'])) {
            $errors[] = "Name cannot be blank.";
        } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }     
        // position
        $postion_int = (int) $page['position']; // Variable typecast as int
        if($postion_int <= 0) {
            $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
            $errors[] = "Position must be less than 999.";
        }    
        // visible
        $visible_str = (string) $page['visible']; // Variable typecast as string
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors[] = "Visible must be true or false.";
        }
      
        return $errors;
    }

    function insert_page($page) {
        global $db;

        $errors = validate_page($page);
        if(!empty($errors)) {
            return $errors; // return will stop the insert_page function if there are errors
        }            

        $sql = "INSERT INTO pages (menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $page['menu_name']) . "',";
        $sql .= "'" . db_escape($db, $page['position']) . "',";
        $sql .= "'" . db_escape($db, $page['visible']) . "')";
        $result = mysqli_query($db, $sql);
        // for INSERT statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_page($page) {
        global $db;

        $errors = validate_page($page);
        if(!empty($errors)) {
            return $errors; // return will stop the update_page function if there are errors
        }

        $sql = "UPDATE pages SET ";
        $sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
        $sql .= "position='" . db_escape($db, $page['position']) . "', ";
        $sql .= "visible='" . db_escape($db, $page['visible']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for UPDATE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function delete_page($id) {
        global $db;
        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for DELETE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }
    
    /* SUBJECTS */
    function find_all_subjects($options=[]) {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM subjects ";
        if($visible) { $sql .= "WHERE visible = true "; }
        $sql .= "ORDER BY page_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_subject_by_id($id) {
        global $db;
        $sql = "SELECT * FROM subjects WHERE id='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject; // returns an assoc array, not a result set
    }

    function find_subjects_by_page($page_id, $options=[]) {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM subjects WHERE page_id='" . db_escape($db, $page_id) . "' ";
        if($visible) { $sql .= "AND visible = true "; }
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_product_types($options=[]) {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM subjects WHERE product_type='1' ";
        if($visible) { $sql .= "AND visible = true "; }
        $sql .= "ORDER BY page_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function validate_subject($subject) {
        $errors = [];
        // page_id
        if(is_blank($subject['page_id'])) {
            $errors[] = "Page cannot be blank.";
        }
        // menu_name
        if(is_blank($subject['menu_name'])) {
            $errors[] = "Name cannot be blank.";
        } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }
        $current_id = $subject['id'] ?? '0';
        if(!has_unique_subject_menu_name($subject['menu_name'], $current_id)) {
            $errors[] = "Name must be unique.";
        }
        // position      
        $postion_int = (int) $subject['position']; // Variable typecast as int
        if($postion_int <= 0) {
            $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
            $errors[] = "Position must be less than 999.";
        }
        // visible
        $visible_str = (string) $subject['visible']; // Variable typecast as string
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors[] = "Visible must be true or false.";
        }
        // product_type
        $product_type_str = (string) $subject['product_type']; // Variable typecast as string
        if(!has_inclusion_of($product_type_str, ["0","1"])) {
            $errors[] = "Product_type must be true or false.";
        }
        // content
        if($subject['product_type'] == '0' && is_blank($subject['content'])) {
            $errors[] = "Content cannot be blank unless subject is a product type.";
            return $errors;
        }
    }

    function insert_subject($subject) {
        global $db;

        $errors = validate_subject($subject);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "INSERT INTO subjects ";
        $sql .= "(page_id, menu_name, position, visible, product_type, content) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $subject['page_id']) . "',";
        $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
        $sql .= "'" . db_escape($db, $subject['position']) . "',";
        $sql .= "'" . db_escape($db, $subject['visible']) . "',";
        $sql .= "'" . db_escape($db, $subject['product_type']) . "',";
        $sql .= "'" . db_escape($db, $subject['content']) . "')";
        $result = mysqli_query($db, $sql);
        // for INSERT statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_subject($subject) {
        global $db;

        $errors = validate_subject($subject);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "UPDATE subjects SET ";
        $sql .= "page_id='" . db_escape($db, $subject['page_id']) . "', ";
        $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
        $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
        $sql .= "visible='" . db_escape($db, $subject['visible']) . "', ";
        $sql .= "content='" . db_escape($db, $subject['content']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for UPDATE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function delete_subject($id) {
        global $db;
        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for DELETE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    /* PRODUCTS */
    function find_all_products() {
        global $db;
        $sql = "SELECT * FROM products ORDER BY subject_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_product_by_id($id) {
        global $db;
        $sql = "SELECT * FROM products WHERE id='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $product = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $product; // returns an assoc array, not a result set
    }

    function find_products_by_subject($subject_id, $options=[]) {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM products WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
        if($visible) { $sql .= "AND visible = true "; }
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function validate_product($product) {
        $errors = [];
        // subject_id
        if(is_blank($product['subject_id'])) {
            $errors[] = "Subject cannot be blank.";
        }
        // menu_name
        if(is_blank($product['menu_name'])) {
            $errors[] = "Name cannot be blank.";
        } elseif(!has_length($product['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }
        $current_id = $product['id'] ?? '0';
        if(!has_unique_product_menu_name($product['menu_name'], $current_id)) {
            $errors[] = "Name must be unique.";
        }
        // position      
        $postion_int = (int) $product['position']; // Variable typecast as int
        if($postion_int <= 0) {
            $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
            $errors[] = "Position must be less than 999.";
        }
        // visible
        $visible_str = (string) $product['visible']; // Variable typecast as string
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors[] = "Visible must be true or false.";
        }
        // price
        $price_float = (float) $product['price']; // Variable typecast as float
        if(is_blank($product['price'])) {
            $errors[] = "Price cannot be blank.";
        }
        if($price_float <= 0) {
            $errors[] = "Price must be greater than or equal to zero.";
        }
        if($price_float > 99.99) {
            $errors[] = "Price must be less than or equal to 99.99.";
        }
        // description
        if(is_blank($product['description'])) {
            $errors[] = "Description cannot be blank.";
        }
        return $errors;
    }

    function insert_product($product) {
        global $db;

        $errors = validate_product($product);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "INSERT INTO products ";
        $sql .= "(subject_id, menu_name, position, visible, price, description) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $product['subject_id']) . "',";
        $sql .= "'" . db_escape($db, $product['menu_name']) . "',";
        $sql .= "'" . db_escape($db, $product['position']) . "',";
        $sql .= "'" . db_escape($db, $product['visible']) . "',";
        $sql .= "'" . db_escape($db, $product['price']) . "',";
        $sql .= "'" . db_escape($db, $product['description']) . "')";
        $result = mysqli_query($db, $sql);
        // for INSERT statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_product($product) {
        global $db;

        $errors = validate_product($product);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "UPDATE products SET ";
        $sql .= "subject_id='" . db_escape($db, $product['subject_id']) . "', ";
        $sql .= "menu_name='" . db_escape($db, $product['menu_name']) . "', ";
        $sql .= "position='" . db_escape($db, $product['position']) . "', ";
        $sql .= "visible='" . db_escape($db, $product['visible']) . "', ";
        $sql .= "price='" . db_escape($db, $product['price']) . "', ";
        $sql .= "description='" . db_escape($db, $product['description']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $product['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for UPDATE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function delete_product($id) {
        global $db;
        $sql = "DELETE FROM products ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for DELETE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    /* ADMINS */
    function find_all_admins() {
        global $db;
        $sql = "SELECT * FROM admins ORDER BY last_name ASC, first_name ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_admin_by_id($id) {
        global $db;
        $sql = "SELECT * FROM admins WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin; // returns an assoc array, not a result set
    }

    function find_admin_by_username($username) {
        global $db;
        $sql = "SELECT * FROM admins WHERE username='" . db_escape($db, $username) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin; // returns an assoc array, not a result set
    }

    function validate_admin($admin, $options=[]) {
        $password_required = $options['password_required'] ?? true; // default to true if no password is sent
        
        // first_name
        if(is_blank($admin['first_name'])) {
            $errors[] = "First name cannot be blank.";
        } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
            $errors[] = "First name must be between 2 to 255 characters.";
        }
        // last_name
        if(is_blank($admin['last_name'])) {
            $errors[] = "Last name cannot be blank.";
        } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
            $errors[] = "Last name must be between 2 to 255 characters.";
        }
        // email
        if(is_blank($admin['email'])) {
            $errors[] = "Email cannot be blank.";
        } elseif (!has_length($admin['email'], array('max' => 255))) {
            $errors[] = "Email must be less than 255 characters.";
        } elseif (!has_valid_email_format($admin['email'])) {
            $errors[] = "Email must be a valid format.";
        }
        // username
        if(is_blank($admin['username'])) {
            $errors[] = "Username cannot be blank.";
        } elseif (!has_length($admin['username'], array('min' => 5, 'max' => 255))) {
            $errors[] = "Username must be between 5 to 255 characters.";
        } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
            $errors[] = "Username is not unique. Please try again.";
        }
        // password
        if($password_required) {
            if(is_blank($admin['password'])) {
                $errors[] = "Password cannot be blank.";
            } elseif (!has_length($admin['password'], array('min' => 9))) {
                $errors[] = "Password must contain 9 or more characters.";
            } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 uppercase letter.";
            } elseif (!preg_match('/[a-z]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 lowercase letter.";
            } elseif (!preg_match('/[0-9]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 number.";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 symbol.";
            }
            if(is_blank($admin['confirm_password'])) {
                $errors[] = "Confirm password cannot be blank.";
            } elseif ($admin['password'] !== $admin['confirm_password']) {
                $errors[] = "Password and confirm password must be the same.";
            }
        }
        return $errors;
    }

    function insert_admin($admin) {
        global $db;

        $errors = validate_admin($admin);
        if(!empty($errors)) {
            return $errors;
        }

        $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
        $hash = substr($hashed_password, 0, 60);

        $sql = "INSERT INTO admins ";
        $sql .= "(first_name, last_name, email, username, hashed_password) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
        $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
        $sql .= "'" . db_escape($db, $admin['email']) . "',";
        $sql .= "'" . db_escape($db, $admin['username']) . "',";
        $sql .= "'" . db_escape($db, $hash) . "')";
        $result = mysqli_query($db, $sql);
        // for INSERT statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_admin($admin) {
        global $db;

        $password_sent = !is_blank($admin['password']);

        $errors = validate_admin($admin, ['password_required' => $password_sent]);
        if(!empty($errors)) {
            return $errors;
        }

        $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
        $hash = substr($hashed_password, 0, 60);

        $sql = "UPDATE admins SET ";
        $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
        $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
        $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
        if($password_sent) {
            $sql .= "hashed_password='" . db_escape($db, $hash) . "', ";
        }      
        $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for UPDATE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function delete_admin($id) {
        global $db;
        $sql = "DELETE FROM admins ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // for DELETE statements, $result is true/false
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

?>