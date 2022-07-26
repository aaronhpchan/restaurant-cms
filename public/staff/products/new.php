<?php 

require_once('../../../private/initialize.php');  

require_login();

if(is_post_request()) {
    $product = [];
    $product['subject_id'] = $_POST['subject_id'] ?? '';
    $product['menu_name'] = $_POST['menu_name'] ?? '';
    $product['position'] = $_POST['position'] ?? '';
    $product['visible'] = $_POST['visible'] ?? '';
    $product['price'] = $_POST['price'] ?? '';
    $product['description'] = $_POST['description'] ?? '';

    $result = insert_product($product);
    if($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = 'Product has been created.'; // store message in the session
        redirect_to(url_for('/staff/products/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $product = [];
    $product['subject_id'] = '';
    $product['menu_name'] = '';
    $product['position'] = '';
    $product['visible'] = '';
    $product['price'] = '';
    $product['description'] = '';
}

$product_set = find_all_products();
$product_count = mysqli_num_rows($product_set) + 1;
mysqli_free_result($product_set);

?>

<?php $page_title = 'Create Product'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/products/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto mb-4">
    <?php echo display_errors($errors); ?>

    <h2 class="text-center mb-3">Create Product</h2>
    <form action="<?php echo url_for('staff/products/new.php'); ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Subject</label>          
            <select name="subject_id" class="form-select">
                <?php
                    $subject_set = find_all_product_types();
                    while($subject = mysqli_fetch_assoc($subject_set)) {
                        echo "<option value=\"" . h($subject['id']) . "\"";
                        if($product["subject_id"] == $subject['id']) {
                            echo " selected";
                        }
                        echo ">" . h($subject['menu_name']) . "</option>";
                    }
                    mysqli_free_result($subject_set);
                ?>
            </select>           
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="menu_name" value="<?php echo h($product['menu_name']); ?>" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Position</label>           
            <select name="position" class="form-select">
                <?php
                    for($i = 1; $i <= $product_count; $i++) {
                        echo "<option value=\"{$i}\"";
                        if($product["position"] == $i) {
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
            <input type="checkbox" name="visible" value="1"<?php if($product['visible'] == "1") { echo " checked"; } ?> class="form-check-input" />       
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Price</label>
            <div class="input-group">          
                <span class="input-group-text">$</span>
                <input type="number" name="price" min="0" max="99.99" value="<?php echo h($product['price']); ?>" step=".01" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" />
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo h($product['description']); ?></textarea>
        </div>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Submit" class="btn btn-primary" />
            <a href="<?php echo url_for('/staff/products/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>