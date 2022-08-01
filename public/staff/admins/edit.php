<?php 

require_once('../../../private/initialize.php');  

if(!isset($_GET['id'])) {
    redirect_to(url_for('staff/admins/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    $admin = [];
    $admin['id'] = $id;
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

    $result = update_admin($admin);
    if($result === true) {
        $_SESSION['message'] = 'Admin has been updated.'; // store message in the session
        redirect_to(url_for('/staff/admins/show.php?id=' . $id));
    } else {
        $errors = $result;
    }
} else {
    $admin = find_admin_by_id($id);
}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto mb-4">
    <?php echo display_errors($errors); ?>

    <h2 class="text-center mb-3">Edit Admin</h2>
    <form action="<?php echo url_for('staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="<?php echo h($admin['username']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="<?php echo h($admin['email']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" value="" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" value="" class="form-control" />
            <small class="text-muted">Password must be at least 9 characters long and include at least 1 uppercase letter, lowercase letter, number, and symbol.</small>
        </div>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Submit" class="btn btn-success" />
            <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>