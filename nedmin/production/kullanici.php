<?php include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici");
$kullanicisor->execute();


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
                                    <th>Kayit tarihi</th>
                                    <th>Ad Soyad</th>
                                    <th>Mail</th>
                                    <th>GSM</th>
                                    <th>Duzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $say=0; while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) { $say++; ?>
                                    <tr>
                                        <td width="20"><?php echo $say; ?></td>
                                        <td><?php echo $kullanicicek['kullanici_zaman']; ?></td>
                                        <td><?php echo $kullanicicek['kullanici_adsoyad']; ?></td>
                                        <td><?php echo $kullanicicek['kullanici_mail']; ?></td>
                                        <td><?php echo $kullanicicek['kullanici_gsm']; ?></td>
                                        <td>
                                            <center>
                                                <a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>">
                                                    <button class="btn btn-primary btn-xs">Update</button>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&kullanicisil=ok">
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