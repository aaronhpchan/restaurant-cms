<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    $result = delete_subject($id);
    redirect_to(url_for('/staff/subjects/index.php'));
} else {
    $subject = find_subject_by_id($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="ps-3 text-decoration-none">&laquo; Back to List</a>
<div class="m-auto">
    <h2 class="mb-3 text-center">Delete Subject</h2>
    <p class="text-center">Are you sure you want to delete this subject?</p>
    <p class="mb-4 text-center h5">"<?php echo h($subject['menu_name']); ?>"</p>
    <form action="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
        <div class="d-flex justify-content-around">
            <input type="submit" name="commit" value="Delete" class="btn btn-danger" />
            <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
