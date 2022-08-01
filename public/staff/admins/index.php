<?php

require_once('../../../private/initialize.php');
$admin_set = find_all_admins();

?>

<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to Main Menu</a>
</div>
<div class="m-auto px-3">
    <h2 class="text-center">Admins</h2>
    <a href="<?php echo url_for('/staff/admins/new.php'); ?>" class="text-decoration-none">Create New Admin</a>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
            <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
                <tr>
                    <td><?php echo h($admin['id']); ?></td>
                    <td><?php echo h($admin['first_name']); ?></td>
                    <td><?php echo h($admin['last_name']); ?></td>
                    <td><?php echo h($admin['email']); ?></td>
                    <td><?php echo h($admin['username']); ?></td>
                    <td><a href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>" class="text-decoration-none">View</a></td>
                    <td><a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>" class="text-decoration-none">Edit</a></td>
                    <td><a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" class="text-decoration-none">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php mysqli_free_result($admin_set); ?>        
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>