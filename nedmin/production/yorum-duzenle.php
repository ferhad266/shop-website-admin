<?php include 'header.php';

$yorumsor = $db->prepare("SELECT * FROM yorumlar WHERE yorum_id=:id");
$yorumsor->execute(array(
    'id' => $_GET['yorum_id']
));
$yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC);

$kullanici_id = $yorumcek['kullanici_id'];
$kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
$kullanicisor->execute(array(
    'id' => $kullanici_id
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

$urun_id = $yorumcek['urun_id'];
$urunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:id");
$urunsor->execute(array(
    'id' => $urun_id
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>yorum Duzenleme<small>

                                    <?php if ($_GET['durum'] == "ok") { ?>
                                        <b style="color: limegreen;">Islem basarili.</b>
                                    <?php } else if ($_GET['durum'] == "ok") { ?>
                                        <b style="color: red;">Islem Basarisiz.</b>
                                    <?php } ?>
                                </small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate
                                  class="form-horizontal form-label-left">

                                <?php
                                $zaman = explode(" ", $yorumcek['yorum_zaman']);
                                ?>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum
                                        Zamani
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" name="yorum_zaman" disabled id="first-name"
                                               value="<?= $zaman[0]; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3  col-xs-12" for="first-name">Yorum
                                        Saati
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="time" name="yorum_zaman" disabled id="first-name"
                                               value="<?= $zaman[1]; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum
                                        Detay
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="yorum_detay" id="first-name"
                                               value="<?= $yorumcek['yorum_detay']; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanici
                                        ad
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="kullanici_id" id="first-name" disabled
                                               value="<?= $kullanicicek['kullanici_adsoyad']; ?>"
                                               required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Urun Ad
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="urun_id" disabled id="first-name"
                                               value="<?= $uruncek['urun_ad']; ?>"
                                               required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <input type="hidden" name="yorum_id" value="<?php echo $yorumcek['yorum_id']; ?>">

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="yorumduzenle" class="btn btn-success">Guncelle
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
<?php include 'footer.php' ?>