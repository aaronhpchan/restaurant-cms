<?php require_once('../../../private/initialize.php'); ?>

<?php $subject_set = find_all_subjects(); ?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to Main Menu</a>
</div>
<div class="m-auto px-3">
    <h2 class="text-center">Subjects</h2>
    <a href="<?php echo url_for('/staff/subjects/new.php'); ?>" class="text-decoration-none">Create New Subject</a>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Page</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Product Type</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
            <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
                <?php $page = find_page_by_id($subject['page_id']); ?>
                <tr>
                    <td><?php echo h($subject['id']); ?></td>
                    <td><?php echo h($page['menu_name']); ?></td>
                    <td class="ps-3"><?php echo h($subject['position']); ?></td>
                    <td class="text-center"><?php echo $subject['visible'] == 1 ? '&#10003;' : 'X'; ?></td>
                    <td class="text-center"><?php echo $subject['product_type'] == 1 ? '&#10003;' : 'X'; ?></td>
                    <td><?php echo h($subject['menu_name']); ?></td>
                    <td><a href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>" class="text-decoration-none">View</a></td>
                    <td><a href="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($subject['id']))); ?>" class="text-decoration-none">Edit</a></td>
                    <td><a href="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>" class="text-decoration-none">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php mysqli_free_result($subject_set); ?>        
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>