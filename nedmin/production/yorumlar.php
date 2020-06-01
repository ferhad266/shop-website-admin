<?php include 'header.php';

$yorumsor = $db->prepare("SELECT * FROM yorumlar ORDER BY yorum_onay ASC ");
$yorumsor->execute();


?>

    <head>
        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>yorum Listeleme<small></small></h2>
                            <div class="clearfix"></div>
                            <div align="right">
                                <a href="yorum-ekle.php">
                                    <button class="btn btn-success btn-xs">Yeni Ekle</button>
                                </a>
                            </div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive"
                                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Sira No</th>
                                    <th>yorum</th>
                                    <th>kullanici</th>
                                    <th>Urun</th>
                                    <th>yorum Durum</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $say = 0;
                                while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++; ?>
                                    <tr>
                                        <td width="20"><?php echo $say; ?></td>
                                        <td><?php echo $yorumcek['yorum_detay']; ?></td>
                                        <td><?php

                                            $kullanici_id = $yorumcek['kullanici_id'];
                                            $kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
                                            $kullanicisor->execute(array(
                                                'id' => $kullanici_id
                                            ));
                                            $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

                                            echo $kullanicicek['kullanici_adsoyad'];
                                            ?>
                                        </td>
                                        <td><?php

                                            $urun_id = $yorumcek['urun_id'];
                                            $urunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:id");
                                            $urunsor->execute(array(
                                                'id' => $urun_id
                                            ));
                                            $uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

                                            echo $uruncek['urun_ad'];

                                            ?></td>
                                        <td>
                                            <center><?php
                                                if ($yorumcek['yorum_onay'] == 0) {
                                                    ?>
                                                    <a href="../netting/islem.php?yorum_id=<?= $yorumcek['yorum_id'] ?>&yorum_one=1&yorum_onay=ok">
                                                        <button class="btn btn-success btn-xs">Onayla</button>
                                                    </a>
                                                <?php } else if ($yorumcek['yorum_onay'] == 1) {
                                                    ?>
                                                    <a href="../netting/islem.php?yorum_id=<?= $yorumcek['yorum_id'] ?>&yorum_one=0&yorum_onay=ok">
                                                        <button class="btn btn-warning btn-xs">Kaldir</button>
                                                    </a>

                                                <?php } ?>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorumsil=ok">
                                                    <button class="btn btn-danger btn-xs">Delete</button>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Bitiyor -->

            </div>
        </div>
    </div>
    <!-- /page content -->
<?php include 'footer.php'; ?>