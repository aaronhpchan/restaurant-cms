<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Humphrey's Doughnuts</a>
</div>
<div class="mx-auto">
    <h2 class="my-3">Main Menu</h2>
    <ul>
        <li><a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="text-decoration-none">Pages</a></li>
        <li><a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="text-decoration-none">Subjects</a></li>
        <li><a href="<?php echo url_for('/staff/products/index.php'); ?>" class="text-decoration-none">Products</a></li>
    </ul>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>