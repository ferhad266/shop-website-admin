<?php include 'header.php';

$yorumsor = $db->prepare("SELECT * FROM yorumlar");
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
                            <h2>Kullanici Listeleme<small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive"
                                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Sira No</th>
                                    <th>Kullanici ad soyad</th>
                                    <th>Yorum Detay</th>
                                    <th>Yorum Zaman</th>
                                    <th>Urun Ad</th>
                                    <th>Duzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $say=0; while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) { $say++;
                                    $ykullanici_id = $yorumcek['kullanici_id'];
                                    $ykullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
                                    $ykullanicisor->execute(array(
                                        'id' => $ykullanici_id
                                    ));
                                    $ykullanicicek = $ykullanicisor->fetch(PDO::FETCH_ASSOC);

                                    $yUrun_id = $yorumcek['urun_id'];
                                    $yUrunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:id");
                                    $yUrunsor->execute(array(
                                       'id' => $yUrun_id
                                    ));

                                    $yUrunCek = $yUrunsor->fetch(PDO::FETCH_ASSOC);


                                    ?>

                                    <tr>
                                        <td width="20"><?php echo $say; ?></td>
                                        <td><?= $ykullanicicek['kullanici_adsoyad'] ?></td>
                                        <td><?= $yorumcek['yorum_detay']; ?></td>
                                        <td><?= $yorumcek['yorum_zaman'] ; ?></td>
                                        <td><?= $yUrunCek['urun_ad']; ?></td>
                                        <td>
                                            <center>
                                                <a href="yorum-duzenle.php?yorum_id=<?= $yorumcek['yorum_id']; ?>">
                                                    <button class="btn btn-primary btn-xs">Update</button>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="../netting/islem.php?yorum_id=<?= $yorumcek['yorum_id']; ?>&yorumsil=ok">
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