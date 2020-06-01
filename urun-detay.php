<?php include 'header.php';
$urunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:urun_id");
$urunsor->execute(array(
    'urun_id' => $_GET['urun_id']
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

$say = $urunsor->rowCount();

if ($say == 0) {
    header("Location:index.php?durum=oynasma");
    exit;
}

?>

<?php if ($_GET['durum'] == "ok") { ?>
    <script type="text/javascript">
        alert("Yorum Basariyla Eklendi");
    </script>
<?php } ?>

<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-9"><!--Main content-->
            <div class="title-bg">
                <div class="title"><?= $uruncek['urun_ad']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="dt-img">
                        <div class="detpricetag">
                            <div class="inner"><?= $uruncek['urun_fiyat'] ?></div>
                        </div>
                        <a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery"
                           title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt=""
                                                                   class="img-responsive"></a>
                    </div>
                    <div class="thumb-img">
                        <a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery"
                           title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt=""
                                                                   class="img-responsive"></a>
                    </div>
                    <div class="thumb-img">
                        <a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery"
                           title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt=""
                                                                   class="img-responsive"></a>
                    </div>
                    <div class="thumb-img">
                        <a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery"
                           title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt=""
                                                                   class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-md-6 det-desc">
                    <div class="productdata">
                        <div class="infospan">Urun Kodu <span><?= $uruncek['urun_id']; ?></span></div>
                        <div class="infospan">Urun Fiyat <span><?= $uruncek['urun_fiyat']; ?></span></div>
                        <div class="infospan">Manufacturer <span>Nikon</span></div>

                        <div class="clearfix"></div>
                        <hr>


                        <form action="nedmin/netting/islem.php" method="post">
                            <input type="hidden" name="kullanici_id" value="<?= $kullanicicek['kullanici_id']; ?>">
                            <input type="hidden" name="urun_id" value="<?= $uruncek['urun_id']; ?>">

                            <div class="form-group">
                                <label for="qty" class="col-sm-2 control-label">Eded</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="urun_adet" value="1">
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" name="sepeteekle" class="btn btn-default btn-red btn-sm"><span
                                                class="addchart">Sebete elave et</span></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                        <div class="sharing">
                            <div class="share-bt">
                                <div class="addthis_toolbox addthis_default_style ">
                                </div>
                                <script type="text/javascript"
                                        src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
                                <div class="clearfix"></div>
                            </div>

                            <div class="avatock"><span><?php if ($uruncek['urun_stok'] >= 1) {
                                        echo "Stok edediniz: " . $uruncek['urun_stok'];
                                    } else {
                                        echo "Urun Kalmadi";
                                    } ?>
                                    </span></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="tab-review">
                <ul id="myTab" class="nav nav-tabs shop-tab">
                    <li <?php
                    if ($_GET['durum'] != "ok") { ?>
                        class="active"
                    <?php } ?>><a href="#desc" data-toggle="tab">Aciklama</a></li>
                    <li <?php
                    if ($_GET['durum'] == "ok") { ?>
                        class="active"
                    <?php } ?>
                        <?php
                        $kullanici_id = $kullanicicek['kullanici_id'];
                        $urun_id = $uruncek['urun_id'];

                        $yorumsor = $db->prepare("SELECT * FROM yorumlar WHERE urun_id=:urun_id and yorum_onay=:yorum_onay");
                        $yorumsor->execute(array(
                            'urun_id' => $urun_id,
                            'yorum_onay' => 1
                        ));

                        ?>
                    ><a href="#rev" data-toggle="tab">Yorumlar (<?= $yorumsor->rowCount(); ?>)</a></li>
                    <li class=""><a href="#video" data-toggle="tab">Urun Video</a></li>
                </ul>
                <div id="myTabContent" class="tab-content shop-tab-ct">
                    <div class="tab-pane fade <?php
                    if ($_GET['durum'] != "ok") { ?>
                             active in
                    <?php } ?>" id="desc">
                        <p>
                            <?= $uruncek['urun_detay']; ?>
                        </p>
                    </div>
                    <div class="tab-pane fade <?php
                    if ($_GET['durum'] == "ok") { ?>
                        active in
                    <?php } ?>" id="rev">


                        <?php

                        while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) {

                            $ykullanici_id = $yorumcek['kullanici_id'];
                            $ykullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
                            $ykullanicisor->execute(array(
                                'id' => $ykullanici_id
                            ));
                            $ykullanicicek = $ykullanicisor->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <!--                        yorumlar-->
                            <p class="dash">
                                <span><?= $ykullanicicek['kullanici_adsoyad'] ?> </span><?= $yorumcek['yorum_zaman'] ?>
                                <br><br>
                                <?= $yorumcek['yorum_detay'] ?>
                            </p>
                        <?php } ?>
                        <!--                        end yorumlar-->
                        <h4>Yorum Yazin</h4>
                        <?php if (isset($_SESSION['userkullanici_mail'])) { ?>
                            <form role="form" action="nedmin/netting/islem.php" method="post">

                                <div class="form-group">
                                <textarea name="yorum_detay" class="form-control" id="text"
                                          placeholder="Please write here your comment"></textarea>
                                </div>
                                <input type="hidden" name="kullanici_id" value="<?= $kullanicicek['kullanici_id']; ?>">
                                <input type="hidden" name="gelen_url" value="<?php
                                echo "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['REQUEST_URI'] . "";
                                ?>">
                                <input type="hidden" name="urun_id" value="<?= $uruncek['urun_id']; ?>">
                                <button type="submit" name="yorumkaydet" class="btn btn-default btn-red btn-sm">Yorum
                                    Gonder
                                </button>
                            </form>
                        <?php } else { ?>
                            Yorum yazmaq ucun <a style="color: red;"
                                                 href="register.php">Kayit</a> olmali yada hesabiniza giris etmelisiniz
                        <?php } ?>

                    </div>
                    <div class="tab-pane fade " id="video">
                        <p>
                            <?php
                            $say = strlen($uruncek['urun_video']);
                            if ($say > 0) { ?>
                        <center>
                            <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/<?= $uruncek['urun_video']; ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </center>
                        <?php } else {
                            echo "Bu urune video eklenmemisdir";
                        } ?>

                        </p>
                    </div>
                </div>
            </div>

            <div id="title-bg">
                <div class="title">Benzer urunler</div>
            </div>
            <div class="row prdct"><!--Products-->
                <?php

                $kategori_id = $uruncek['kategori_id'];

                $urunaltsor = $db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by  rand() limit 3");
                $urunaltsor->execute(array(
                    'kategori_id' => $kategori_id
                ));

                while ($urunaltcek = $urunaltsor->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                    <div class="col-md-4">
                        <div class="productwrap">
                            <div class="pr-img">
                                <div class="hot"></div>
                                <a href="urun-<?= seo($urunaltcek["urun_ad"]) . '-' . $urunaltcek["urun_id"] ?>"><img
                                            src="images\sample-3.jpg" alt="" class="img-responsive"></a>
                                <div class="pricetag on-sale">
                                    <div class="inner on-sale"><span class="onsale"><span
                                                    class="oldprice"><?php echo $urunaltcek['urun_fiyat'] * 1.50 ?> TL</span><?php echo $urunaltcek['urun_fiyat'] ?> TL</span>
                                    </div>
                                </div>
                            </div>
                            <span class="smalltitle"><a
                                        href="product.htm"><?php echo $urunaltcek['urun_ad'] ?></a></span>
                            <span class="smalldesc">Ürün Kodu.: <?php echo $urunaltcek['urun_id'] ?></span>
                        </div>
                    </div>

                <?php } ?>
            </div><!--Products-->
            <div class="spacer"></div>
        </div><!--Main content-->
        <?php include 'sidebar.php'; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
