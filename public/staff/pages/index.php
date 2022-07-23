<?php require_once('../../../private/initialize.php'); ?>

<?php $page_set = find_all_pages(); ?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<a href="<?php echo url_for('/staff/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to Main Menu</a>
<div class="m-auto px-3">
    <h2 class="text-center">Pages</h2>
    <a href="<?php echo url_for('/staff/pages/new.php'); ?>" class="text-decoration-none">Create New Page</a>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Name</th>
                </tr>
            </thead>

            <tbody>
            <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
                <tr>
                    <td><?php echo h($page['id']); ?></td>
                    <td class="ps-3"><?php echo h($page['position']); ?></td>
                    <td class="text-center"><?php echo $page['visible'] == 1 ? '&#10003;' : 'X'; ?></td>
                    <td><?php echo h($page['menu_name']); ?></td>
                    <td><a href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>" class="text-decoration-none">View</a></td>
                    <td><a href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>" class="text-decoration-none">Edit</a></td>
                    <td><a href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" class="text-decoration-none">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php mysqli_free_result($page_set); ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>