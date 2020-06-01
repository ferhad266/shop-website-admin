<?php include 'header.php'; ?>
    <div class="container">
        <div class="clearfix"></div>
        <div class="lines"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <div class="title-bg">
            <div class="title">Alisveris sepeti</div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered chart">
                <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Urun Ad</th>
                    <th>Urun kodu.</th>
                    <th>Adet</th>
                    <th>Toplam fiyat</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $kullanici_id = $kullanicicek['kullanici_id'];
                $toplamFiyat= 0;

                $sepetsor = $db->prepare("SELECT * FROM sepet WHERE $kullanici_id=:id");
                $sepetsor->execute(array(
                    'id' => $kullanici_id
                ));
                while ($sepetcek = $sepetsor->fetch(PDO::FETCH_ASSOC)) {
                    $urun_id = $sepetcek['urun_id'];
                    $urunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:urun_id");
                    $urunsor->execute(array(
                        'urun_id' => $urun_id
                    ));
                    $uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
                    $toplamFiyat +=$uruncek['urun_fiyat'] * $sepetcek['urun_adet'];
                    ?>
                    <tr>
                        <td>
                            <form><input type="checkbox"></form>
                        </td>
                        <td><img src="images\demo-img.jpg" width="100" alt=""></td>
                        <td><?= $uruncek['urun_ad']; ?></td>
                        <td><?= $uruncek['urun_id']; ?></td>
                        <td>
                            <form><input type="text" class="form-control quantity" value="<?= $sepetcek['urun_adet']; ?>"></form>
                        </td>
                        <td><?= $uruncek['urun_fiyat']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-3 col-md-offset-3">
                <div class="subtotal-wrap">
                    <div class="total">Toplam fiyat: <span class="bigprice"><?php echo $toplamFiyat; ?></span></div>
                    <div class="clearfix"></div>
                    <a href="odeme" class="btn btn-default btn-yellow">Odeme Sayfasi</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="spacer"></div>
    </div>

<?php include 'footer.php'; ?>