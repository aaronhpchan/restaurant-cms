<nav>
    <div class="container-md px-3 px-md-0 pt-2 pb-3">
        <?php $nav_pages = find_all_pages(['visible' => true]); ?>
        <div class="row pages"> 
            <?php while($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
            <div class="col-6 col-lg-3 nav-btn">
                <a href="<?php echo url_for('index.php?id=' . h(u($nav_page['id']))); ?>" class="<?php if($nav_page['id'] == $page_id) { echo 'active'; } ?> nav-item nav-link text-center py-3 mt-3 mb-1 mb-lg-3 text-reset text-uppercase border border-2 border-dark">
                    <?php echo h($nav_page['menu_name']); ?>
                </a>
            </div>
            <?php } // close while loop ?> 
        </div>
    </div>
    <?php mysqli_free_result($nav_pages); ?>
</nav>