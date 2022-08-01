<?php 

require_once('../../../private/initialize.php'); 

$id = $_GET['id'] ?? '1'; 
$admin = find_admin_by_id($id);

?> 

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/admins/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="mx-auto">
    <h2 class="my-3 text-center">Admin: <?php echo h($admin['username']); ?></h2>
    <div class="mx-auto">
        <dl>
            <dt>First Name</dt>
            <dd><?php echo h($admin['first_name']); ?></dd>
        </dl>
        <dl>
            <dt>Last Name</dt>
            <dd><?php echo h($admin['last_name']); ?></dd>
        </dl>
        <dl>
            <dt>Email</dt>
            <dd><?php echo h($admin['email']); ?></dd>
        </dl>
        <dl>
            <dt>Username</dt>
            <dd><?php echo h($admin['username']); ?></dd>
        </dl>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>