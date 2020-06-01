<?php include 'header.php';



$menusor = $db->prepare("SELECT * FROM menu WHERE menu_seourl=:sef");
$menusor->execute(array(
    'sef' => $_GET['sef']
));
$menucek = $menusor->fetch(PDO::FETCH_ASSOC);

?>

    <div class="container">
        <div class="row">
            <div class="col-md-9"><!--Main content-->
                <div class="title-bg">
                    <div class="title"><?php echo $menucek['menu_ad'];?></div>
                </div>
                <div class="page-content">
                    <p><?php echo $menucek['menu_detay']; ?></p>
                </div>
            </div>


            <!--        SIDEBAR BURA GELECEK-->
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="spacer"></div>
    </div>

<?php include 'footer.php'; ?>