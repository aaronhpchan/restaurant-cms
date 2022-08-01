<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/products/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    $result = delete_product($id);
    $_SESSION['message'] = 'Product has been deleted.'; // store message in the session
    redirect_to(url_for('/staff/products/index.php'));
} else {
    $product = find_product_by_id($id);
}

?>

<?php $page_title = 'Delete Product'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/products/index.php'); ?>" class="ps-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="m-auto">
    <h2 class="mb-3 text-center">Delete Product</h2>
    <p class="text-center">Are you sure you want to delete this product?</p>
    <p class="mb-4 text-center h5">"<?php echo h($product['menu_name']); ?>"</p>
    <form action="<?php echo url_for('/staff/products/delete.php?id=' . h(u($product['id']))); ?>" method="post">
        <div class="d-flex justify-content-around">
            <input type="submit" name="commit" value="Delete" class="btn btn-danger" />
            <a href="<?php echo url_for('/staff/products/index.php'); ?>" class="btn btn-light border">Cancel</a>
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>