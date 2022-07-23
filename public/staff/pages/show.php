<?php require_once('../../../private/initialize.php'); ?>

<?php 

$id = $_GET['id'] ?? '1';

$page = find_page_by_id($id);

?> 

<?php $page_title = h($page['menu_name']); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
<div class="mx-auto">
    <h2 class="my-3 text-center">Page: <?php echo h($page['menu_name']); ?></h2>
    <table class="table">
        <thead>
            <tr>               
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
            </tr>
        </thead>

        <tbody>
            <tr>              
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
            </tr>
        </tbody>
    </table>
</div>