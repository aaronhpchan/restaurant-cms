<?php require_once('../../../private/initialize.php'); ?>

<?php 

$id = $_GET['id'] ?? '1'; 
$product = find_product_by_id($id);
$menu_page = find_page_by_id(1);

?> 

<?php $page_title = 'Show Product'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/products/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>   
</div> 
<div class="attributes-product mx-auto">
    <h2 class="my-3 text-center">Product: <?php echo h($product['menu_name']); ?></h2>
    <div class="mx-auto">
        <?php $subject = find_subject_by_id($product['subject_id']); ?>
        <dl>
            <dt>Subject</dt>
            <dd><?php echo h($subject['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Name</dt>
            <dd><?php echo h($product['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($product['position']); ?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo $product['visible'] == '1' ? 'true' : 'false'; ?></dd>
        </dl>
        <dl>
            <dt>Price</dt>
            <dd>$<?php echo h($product['price']); ?></dd>
        </dl>
        <dl>
            <dt>Description</dt>
            <dd><?php echo h($product['description']); ?></dd>
        </dl>
    </div>

    <?php if($menu_page['menu_name'] == 'Menu') { ?>
        <div>
            <a href="<?php echo url_for('/index.php?id=1&preview=true'); ?>" target="_blank" class="text-decoration-none">Preview</a>
        </div>
    <?php } ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>