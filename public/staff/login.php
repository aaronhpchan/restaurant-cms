<?php 

require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // validate form data
    if(is_blank($username)) {
        $errors[] = 'Username cannot be empty.';
    }
    if(is_blank($password)) {
        $errors[] = 'Password cannot be empty.';
    }
    // try to login if no errors
    if(empty($errors)) {
        $admin = find_admin_by_username($username);
        $error_msg = 'Login unsuccessful. Please try again.';
        if($admin) {
            // verify if password matches hashed password
            if(password_verify($password, $admin['hashed_password'])) {
                // password matches
                log_in_admin($admin);
                redirect_to(url_for('/staff/index.php'));
            } else {
                // username found but password does not match
                $errors[] = $error_msg;
            }
        } else {
            // no password found
            $errors[] = $error_msg;
        }
    }
}

?>

<?php $page_title = 'Login'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to Main Menu</a>
</div>
<div class="m-auto d-flex flex-column align-items-center">
    <?php echo display_errors($errors); ?>

    <h2 class="text-center mb-3">Login</h2>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="<?php echo h($username); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" value="" class="form-control" />
        </div>
        <input type="submit" value="Submit" class="btn btn-primary w-100 mt-2" />
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>