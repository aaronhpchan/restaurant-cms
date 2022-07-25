<?php require_once('../../../private/initialize.php'); ?>

<?php $product_set = find_all_products(); ?>

<?php $page_title = 'Products'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to Main Menu</a>
</div>
<div class="mx-auto px-3">
    <h2 class="text-center">Products</h2>
    <a href="<?php echo url_for('/staff/products/new.php'); ?>" class="text-decoration-none">Create New Product</a>
    <div class="table-responsive mb-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
            <?php while($product = mysqli_fetch_assoc($product_set)) { ?>
                <?php $subject = find_subject_by_id($product['subject_id']); ?>
                <tr>
                    <td><?php echo h($product['id']); ?></td>
                    <td><?php echo h($subject['menu_name']); ?></td>
                    <td><?php echo h($product['position']); ?></td>
                    <td><?php echo $product['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><?php echo h($product['menu_name']); ?></td>
                    <td><a href="<?php echo url_for('/staff/products/show.php?id=' . h(u($product['id']))); ?>" class="text-decoration-none">View</a></td>
                    <td><a href="<?php echo url_for('/staff/products/edit.php?id=' . h(u($product['id']))); ?>" class="text-decoration-none">Edit</a></td>
                    <td><a href="<?php echo url_for('/staff/products/delete.php?id=' . h(u($product['id']))); ?>" class="text-decoration-none">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    
    <?php mysqli_free_result($product_set); ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>