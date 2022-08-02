<?php 

require_once('../../../private/initialize.php');  

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('staff/pages/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    // Handive form values sent by new.php
    $page = [];
    $page['id'] = $id;
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';

    $result = update_page($page);
    if($result === true) {
        $_SESSION['message'] = 'Page has been updated.'; // store message in the session
        redirect_to(url_for('/staff/pages/show.php?id=' . $id));
    } else {
        $errors = $result;
        
    }
} else {
    $page = find_page_by_id($id);
}

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set);
mysqli_free_result($page_set);

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="ps-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto">
    <?php echo display_errors($errors); ?>
    
    <h2 class="mb-3 text-center">Edit Page</h2>
    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Position</label>           
            <select name="position" class="form-select w-25">
                <?php
                    for($i = 1; $i <= $page_count; $i++) {
                        echo "<option value=\"{$i}\"";
                        if($page['position'] == $i) {
                            echo " selected";
                        }
                        echo ">{$i}</option>";
                    }
                ?>    
            </select>           
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Visible</label>         
            <input type="hidden" name="visible" value="0" />
            <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; } ?> class="form-check-input" />          
        </div>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Submit" class="btn btn-success" />
            <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
