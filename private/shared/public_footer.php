<?php $subject_set = find_subjects_by_page(3, ['visible' => $visible]); ?>   

<footer class="navbar d-flex flex-column bg-dark py-5">
    <div class="bg-dark text-center">
        <a class="bg-dark" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram h2 mx-3 mx-sm-4 bg-dark"></i></a>
        <a class="bg-dark" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook h2 mx-3 mx-sm-4 bg-dark"></i></a>
        <a class="bg-dark" href="https://www.yelp.com/" target="_blank"><i class="fab fa-yelp h2 mx-3 mx-sm-4 bg-dark"></i></a>
        <a class="bg-dark" href="https://www.tripadvisor.com/" target="_blank"><i class="fab fa-tripadvisor h2 mx-3 mx-sm-4 bg-dark"></i></a>
    </div>
    <?php foreach($subject_set as $i => $value) { ?>
        <?php if($i < 2) { ?>
            <div class="bg-dark text-white text-center pt-3"><?php echo $value['content']; ?></div>
        <?php } ?>
    <?php } ?>
    <div class="d-flex justify-content-center align-items-center h1 scroll">&uarr;</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"> </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="<?php echo url_for('/js/app.js'); ?>"></script>
<?php if(isset($_GET['id']) && $_GET['id'] == 3) { ?>
    <script src="<?php echo url_for('/js/contact.js'); ?>"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8HahyLGxd1U4gwb34eZDBCk--S9NC-bI&callback=initMap"></script> <!-- API key is restricted -->
<?php } ?>
<?php if(isset($_GET['id']) && $_GET['id'] == 4) { ?>
    <script src="<?php echo url_for('/js/order.js'); ?>"></script>
<?php } ?>
</body>
</html>

<?php db_disconnect($db); ?>