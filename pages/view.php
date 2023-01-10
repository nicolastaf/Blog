<?php
    if($_GET['controller'] == 'admin') {
        include "pages/admin/includes/header.php";
    } else {
        include "pages/blog/includes/header.php";
    }
?>
<div class="container">

    <?= $content; ?>

</div>
<?php
    if($_GET['controller'] == 'admin') {
        include "pages/admin/includes/footer.php";
    } else {
        include "pages/blog/includes/footer.php";
    }
?>