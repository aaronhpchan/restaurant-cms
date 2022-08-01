<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    $result = delete_admin($id);
    $_SESSION['message'] = 'Admin has been deleted.'; // store message in the session
    redirect_to(url_for('/staff/admins/index.php'));
} else {
    $admin = find_admin_by_id($id);
}

?>

<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="ps-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto">
    <h2 class="mb-3 text-center">Delete Admin</h2>
    <p class="text-center">Are you sure you want to delete this admin?</p>
    <p class="mb-4 text-center h5">"<?php echo h($admin['username']); ?>"</p>
    <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
        <div class="d-flex justify-content-around">
            <input type="submit" name="commit" value="Delete" class="btn btn-danger" />
            <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
