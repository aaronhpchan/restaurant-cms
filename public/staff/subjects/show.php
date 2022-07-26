<?php 

require_once('../../../private/initialize.php'); 

$id = $_GET['id'] ?? '1'; 
$subject = find_subject_by_id($id);

?> 

<?php $page_title = h($subject['menu_name']); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="ms-3 text-decoration-none">&laquo; Back to List</a>
</div>
<div class="attributes mx-auto">
    <h2 class="my-3 text-center">Subject: <?php echo h($subject['menu_name']); ?></h2>
    <div class="mx-auto">
        <?php $page = find_page_by_id($subject['page_id']); ?>
        <dl>
            <dt>Page</dt>
            <dd><?php echo h($page['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Name</dt>
            <dd><?php echo h($subject['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($subject['position']); ?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
        </dl>
        <dl>
            <dt>Content</dt>
            <dd><?php echo $subject['content'] != '' ? h($subject['content']) : 'nil'; ?></dd>
        </dl>
    </div>
    <div class="mb-4">
        <a href="<?php echo url_for('/index.php?id=' . h(u($subject['page_id'])) . '&preview=true'); ?>" target="_blank" class="text-decoration-none">Preview</a>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>