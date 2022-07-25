<?php 

require_once('../../../private/initialize.php');  

if(is_post_request()) {
    $subject = [];
    $subject['page_id'] = $_POST['page_id'] ?? '';
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';
    $subject['product_type'] = $_POST['product_type'] ?? '';
    $subject['content'] = $_POST['content'] ?? '';

    $result = insert_subject($subject);
    if($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $subject = [];
    $subject['page_id'] = '';
    $subject['menu_name'] = '';
    $subject['position'] = '';
    $subject['visible'] = '';
    $subject['product_type'] = '';
    $subject['content'] = '';
}

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto mb-4">
    <?php echo display_errors($errors); ?>

    <h2 class="text-center mb-3">Create Subject</h2>
    <form action="<?php echo url_for('staff/subjects/new.php'); ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Page</label>
            <select name="page_id" class="form-select">
                <?php
                    $page_set = find_all_pages();
                    while($page = mysqli_fetch_assoc($page_set)) {
                        echo "<option value=\"" . h($page['id']) . "\"";
                        if($subject["page_id"] == $page['id']) {
                            echo " selected";
                        }
                        echo ">" . h($page['menu_name']) . "</option>";
                    }
                    mysqli_free_result($page_set);
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Position</label>          
            <select name="position" class="form-select">
                <?php
                    for($i = 1; $i <= $subject_count; $i++) {
                        echo "<option value=\"{$i}\"";
                        if($subject["position"] == $i) {
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
            <input type="checkbox" name="visible" value="1"<?php if($subject['visible'] == "1") { echo " checked"; } ?> class="form-check-input" />           
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Product Type</label>          
            <input type="hidden" name="product_type" value="0" />
            <input type="checkbox" name="product_type" value="1"<?php if($subject['product_type'] == "1") { echo " checked"; } ?> class="form-check-input" />          
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>           
            <textarea name="content" class="form-control"><?php echo h($subject['content']); ?></textarea>           
        </div>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Submit" class="btn btn-primary" />
            <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>