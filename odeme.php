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
                $toplamFiyat = 0;

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
                    $toplamFiyat += $uruncek['urun_fiyat'] * $sepetcek['urun_adet'];
                    ?>
                    <tr>

                        <td><img src="images\demo-img.jpg" width="100" alt=""></td>
                        <td><?= $uruncek['urun_ad']; ?></td>
                        <td><?= $uruncek['urun_id']; ?></td>
                        <td>
                            <form><?= $sepetcek['urun_adet']; ?></form>
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
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="tab-review">
            <ul id="myTab" class="nav nav-tabs shop-tab">
                <li class="active"><a href="#desc" data-toggle="tab">Kredi Karti</a></li>
                <li><a href="#rev" data-toggle="tab">Banka Havalesi</a></li>
            </ul>
            <div id="myTabContent" class="tab-content shop-tab-ct">
                <div class="tab-pane fade active in" id="desc">
                    <p>
                        Entegrasyon tamamlandi.
                    </p>
                </div>
                <div class="tab-pane fade" id="rev">
                    <form action="nedmin/netting/islem.php" method="post">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur distinctio dolore
                        necessitatibus quam
                        vel! Accusamus animi autem commodi distinctio, earum eveniet explicabo harum id magnam non rem
                        sed, unde vero?
                        Accusantium animi debitis dolorem earum, eligendi est explicabo facilis hic in, maiores modi
                        nobis nostrum nulla,
                        provident quia quo reiciendis tempore unde ut vel! Aliquid architecto atque aut ex
                        exercitationem explicabo fuga
                        fugiat fugit minus necessitatibus possimus quae quaerat quas quasi quos ratione reiciendis sit
                        tempore tenetur totam
                        ullam, velit voluptatem. Adipisci autem doloremque explicabo fuga iusto libero magni molestias,
                        neque, nisi non odit
                        quidem. Ab amet asperiores assumenda atque delectus deleniti ea earum esse eveniet illum in
                        itaque, laudantium maxime
                        minima modi necessitatibus nesciunt nihil provident quae quasi quisquam sint sit soluta ullam ut
                        veritatis voluptatum!
                        Aliquid dicta molestiae obcaecati officiis pariatur rem temporibus totam unde? Aut autem
                        blanditiis cupiditate delectus
                        deleniti distinctio dolor dolorum eaque earum error eum eveniet harum minus nihil non nulla
                        pariatur quae reiciendis,
                        repellat sapiente suscipit unde voluptatem voluptatum! Accusantium aperiam, cum dignissimos
                        error impedit laudantium quas
                        sequi, suscipit totam veniam veritatis voluptas, voluptatem voluptatibus. Asperiores corporis
                        cupiditate dicta ea, error
                        fugit hic impedit inventore ipsam magnam, magni molestias nostrum praesentium quibusdam
                        voluptatem! Ab architecto, beatae ear
                        um fuga ipsa labore modi nisi nulla quas quo repellat sed sit? Aperiam architecto consectetur
                        consequatur dolor doloremque ei
                        us et expedita fugit id ipsam magni minima nemo nisi, obcaecati officiis provident recusandae
                        sapiente tempora vitae voluptas!
                        Ab corporis cum ducimus illo, in odit quam quisquam veniam. Assumenda delectus deleniti dicta
                        dignissimos doloremque doloribus
                        illum ipsam laboriosam maiores minima nemo nisi omnis quia quo quos, saepe sed sequi sunt,
                        tenetur totam ullam unde veritatis,
                        vero. Architecto dolores pariatur possimus similique unde! Assumenda at commodi itaque modi nam
                        nostrum obcaecati officiis, quod
                        ! Est eum laboriosam pariatur. Aspernatur assumenda culpa deserunt dolor dolorum nihil quo
                        similique sint, soluta suscipit tempora
                        unde veritatis voluptatibus? A ad alias aspernatur culpa, debitis deserunt dolore est id illo
                        incidunt ipsam itaque maiores minima modi,
                        molestiae mollitia, nam non praesentium quae quia quis ratione recusandae repellendus
                        reprehenderit suscipit vitae voluptatibus! Harum,
                        minima qui! Aliquid autem ea earum eos illum impedit ipsum minima quos repudiandae, voluptatum.
                        Accusamus ad adipisci, assumenda atque
                        autem commodi consequatur corporis cum debitis delectus dolor dolore dolorem doloremque dolores
                        ea eaque, enim eveniet, explicabo facere
                        fugit illo inventore magnam maxime nisi non odit officia omnis quibusdam quos recusandae
                        reprehenderit sed sint tempore vel velit veniam
                        voluptatibus. Accusamus cum deserunt distinctio dolore, eaque error eum fugiat in libero,
                        maiores, nemo officia quas quod sint voluptatum.
                        Accusamus aliquid distinctio est ipsum, iste magni nisi possimus quisquam quo tempore!
                        Blanditiis ea enim est ex molestiae nobis nostrum
                        odit possimus, quam saepe. Aperiam aut autem consequuntur delectus itaque, iusto modi neque
                        nulla odit officiis pariatur quia quibusdam rem
                        repudiandae saepe sed soluta! Aspernatur corporis dolorem incidunt nostrum? Alias consectetur
                        impedit magnam necessitatibus voluptatum.
                        Aliquid aspernatur atque autem beatae delectus ea eaque, expedita, hic id incidunt magnam
                        maiores modi mollitia nam natus necessitatibus
                        nobis non odit omnis quas, quia quod reiciendis saepe sapiente sequi soluta totam ullam unde
                        voluptate voluptates! Ab accusamus alias,
                        assumenda commodi cum cupiditate delectus dolorem dolores ducimus, exercitationem explicabo hic
                        mollitia nesciunt odit optio perspiciatis
                        quia quo quod reiciendis repellendus sequi sit sunt tempore temporibus vitae? Alias, asperiores
                        consectetur culpa distinctio dolores
                        facilis libero natus pariatur recusandae sint voluptates!
                        <br>
                        <?php
                        $bankasor = $db->prepare("SELECT * FROM banka order by banka_id ASC");
                        $bankasor->execute();

                        while ($bankacek = $bankasor->fetch(PDO::FETCH_ASSOC)) {?>

                            <input type="radio" name="banka_id" value="<?php echo $bankacek['banka_id'] ?>">
                            <?= $bankacek['banka_ad'];echo " ";?><br>

                        <?php } ?>
                    </p>
                        <hr>
                        <button class="btn btn-success" type="submit" name="sifariskaydet">Sifaris ver </button>
                    </form>

                </div>
            </div>
        </div>
        <div class="spacer"></div>
    </div>

<?php include 'footer.php'; ?>