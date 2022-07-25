<?php 

require_once('../../../private/initialize.php'); 

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set) + 1;
mysqli_free_result($page_set);

$page = [];
$page['position'] = $page_count; // set position to be highest position by default

if(is_post_request()) {
    // Handive form values sent by new.php
    $page = [];
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';

    $result = insert_page($page);
    if($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    // display blank form
    $page = [];
    $page["menu_name"] = '';
    $page["position"] = $page_count;
    $page["visible"] = '';
}

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto">
    <?php echo display_errors($errors); ?>

    <h2 class="text-center mb-3">Create Page</h2>
    <form action="<?php echo url_for('staff/pages/new.php'); ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="menu_name" value="" class="form-control" />
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
            <input type="checkbox" name="visible" value="1" class="form-check-input" />
        </div>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Submit" class="btn btn-primary" />
            <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
