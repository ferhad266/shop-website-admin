<?php
ob_start();
session_start();
include 'baglan.php';
include '../function.php';

if (isset($_POST['kullanicisifreguncelle'])) {

    echo $kullanici_eskipassword=trim($_POST['kullanici_eskipassword']); echo "<br>";
    echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
    echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

    $kullanici_password=md5($kullanici_eskipassword);


    $kullanicisor=$db->prepare("select * from kullanici where kullanici_password=:password");
    $kullanicisor->execute(array(
        'password' => $kullanici_password
    ));

    //dönen satır sayısını belirtir
    $say=$kullanicisor->rowCount();



    if ($say==0) {

        header("Location:../../sifre-guncelle?durum=eskisifrehata");



    } else {



        //eski şifre doğruysa başla


        if ($kullanici_passwordone==$kullanici_passwordtwo) {


            if (strlen($kullanici_passwordone)>=6) {


                //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                $password=md5($kullanici_passwordone);

                $kullanicikaydet=$db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");


                $insert=$kullanicikaydet->execute(array(
                    'kullanici_password' => $password
                ));

                if ($insert) {


                    header("Location:../../sifre-guncelle.php?durum=sifredegisti");


                    //Header("Location:../production/genel-ayarlar.php?durum=ok");

                } else {


                    header("Location:../../sifre-guncelle.php?durum=no");
                }





                // Bitiş



            } else {


                header("Location:../../sifre-guncelle.php?durum=eksiksifre");


            }



        } else {

            header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");

            exit;


        }


    }

    exit;

    if ($update) {

        header("Location:../../sifre-guncelle?durum=ok");

    } else {

        header("Location:../../sifre-guncelle?durum=no");
    }

}

if (isset($_POST['kullanicibilgiguncelle'])) {
    $kullanici_id = $_POST['kullanici_id'];

    $ayarKaydet = $db->prepare("UPDATE kullanici SET 
    kullanici_il=:kullanici_il,
    kullanici_adsoyad=:kullanici_adsoyad,
    kullanici_ilce=:kullanici_ilce
    WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $ayarKaydet->execute(array(
        'kullanici_il' => $_POST['kullanici_il'],
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
        'kullanici_ilce' => $_POST['kullanici_ilce']
    ));

    if ($update) {

        header("Location:../../hesabim.php?durum=ok");
        exit;
    } else {

        header("Location:../../hesabim.php?durum=no");
        exit;
    }
}

if (isset($_POST['kullanicikaydet'])) {
    $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);

    $kullanici_adsoyad = htmlspecialchars($_POST['kullanici_adsoyad']);

    $kullanici_passwordone = $_POST['kullanici_passwordone'];
    $kullanici_passwordtwo = $_POST['kullanici_passwordtwo'];

    if ($kullanici_passwordone == $kullanici_passwordtwo) {
        if (strlen($kullanici_passwordone) >= 6) {
            $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
            $kullanicisor->execute(array(
                'mail' => $kullanici_mail
            ));

            //dönen satır sayısını belirtir
            $say = $kullanicisor->rowCount();


            if ($say == 0) {

                //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                $password = md5($kullanici_passwordone);

                $kullanici_yetki = 1;

                //Kullanıcı kayıt işlemi yapılıyor...
                $kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
                $insert = $kullanicikaydet->execute(array(
                    'kullanici_adsoyad' => $kullanici_adsoyad,
                    'kullanici_mail' => $kullanici_mail,
                    'kullanici_password' => $password,
                    'kullanici_yetki' => $kullanici_yetki
                ));
                if ($insert) {
                    header("Location:../../index.php?durum=loginbasarili");
                    //Header("Location:../production/genel-ayarlar.php?durum=ok");
                } else {
                    header("Location:../../register.php?durum=basarisiz");
                }
            } else {
                header("Location:../../register.php?durum=mukerrerkayit");
            }
        } else {
            header("Location:../../register.php?durum=eksiksifre");
        }
    } else {
        header("Location:../../register.php?durum=farklisifre");
    }

}

if (isset($_POST['sliderduzenle'])) {


    if ($_FILES['slider_resimyol']["size"] > 0) {


        $uploads_dir = '../../dimg/slider';
        @$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
        @$name = $_FILES['slider_resimyol']["name"];
        $benzersizsayi1 = rand(20000, 32000);
        $benzersizsayi2 = rand(20000, 32000);
        $benzersizsayi3 = rand(20000, 32000);
        $benzersizsayi4 = rand(20000, 32000);
        $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
        $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
        @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

        $duzenle = $db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum,
			slider_resimyol=:resimyol	
			WHERE slider_id={$_POST['slider_id']}");
        $update = $duzenle->execute(array(
            'ad' => $_POST['slider_ad'],
            'link' => $_POST['slider_link'],
            'sira' => $_POST['slider_sira'],
            'durum' => $_POST['slider_durum'],
            'resimyol' => $refimgyol,
        ));


        $slider_id = $_POST['slider_id'];

        if ($update) {

            $resimsilunlink = $_POST['slider_resimyol'];
            unlink("../../$resimsilunlink");

            Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

        } else {

            Header("Location:../production/slider-duzenle.php?durum=no");
        }


    } else {

        $duzenle = $db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum		
			WHERE slider_id={$_POST['slider_id']}");
        $update = $duzenle->execute(array(
            'ad' => $_POST['slider_ad'],
            'link' => $_POST['slider_link'],
            'sira' => $_POST['slider_sira'],
            'durum' => $_POST['slider_durum']
        ));

        $slider_id = $_POST['slider_id'];

        if ($update) {

            Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

        } else {

            Header("Location:../production/slider-duzenle.php?durum=no");
        }
    }

}

if (isset($_POST['kullaniciduzenle'])) {
    $kullanici_id = $_POST['kullanici_id'];

    $ayarKaydet = $db->prepare("UPDATE kullanici SET 
    kullanici_fin=:kullanici_fin,
    kullanici_adsoyad=:kullanici_adsoyad,
    kullanici_durum=:kullanici_durum
    WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $ayarKaydet->execute(array(
        'kullanici_fin' => $_POST['kullanici_fin'],
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
        'kullanici_durum' => $_POST['kullanici_durum']
    ));

    if ($update) {

        header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
        exit;
    } else {

        header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
        exit;
    }
}

if (isset($_POST['kullanicigiris'])) {

    echo $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
    echo $kullanici_password = md5($_POST['kullanici_password']);


    $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki and kullanici_password=:password and kullanici_durum=:durum");
    $kullanicisor->execute(array(
        'mail' => $kullanici_mail,
        'yetki' => 1,
        'password' => $kullanici_password,
        'durum' => 1
    ));


    $say = $kullanicisor->rowCount();


    if ($say == 1) {

        echo $_SESSION['userkullanici_mail'] = $kullanici_mail;

        header("Location:../../");
        exit;

    } else {

        header("Location:../../?durum=basarisizgiris");
        exit;
    }


}

if (isset($_POST['sliderkaydet'])) {


    $uploads_dir = '../../dimg/slider';
    @$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
    @$name = $_FILES['slider_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $kaydet = $db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_resimyol=:slider_resimyol
		");
    $insert = $kaydet->execute(array(
        'slider_ad' => $_POST['slider_ad'],
        'slider_sira' => $_POST['slider_sira'],
        'slider_link' => $_POST['slider_link'],
        'slider_resimyol' => $refimgyol
    ));

    if ($insert) {

        Header("Location:../production/slider.php?durum=ok");

    } else {

        Header("Location:../production/slider.php?durum=no");
    }


}

if (isset($_POST['logoduzenle'])) {

    $uploads_dir = '../../dimg';

    @$tmp_name = $_FILES['ayar_logo']["tmp_name"];
    @$name = $_FILES['ayar_logo']["name"];

    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");


    $duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
    $update = $duzenle->execute(array(
        'logo' => $refimgyol
    ));


    if ($update) {

        $resimsilunlink = $_POST['eski_yol'];
        unlink("../../$resimsilunlink");

        Header("Location:../production/genel-ayar.php?durum=ok");

    } else {

        Header("Location:../production/genel-ayar.php?durum=no");
    }

}

if (isset($_POST['admingiris'])) {
    $kullanici_mail = $_POST['kullanici_mail'];
    $kullanici_password = md5($_POST['kullanici_password']);

    $kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail AND kullanici_password=:password AND kullanici_yetki=:yetki");
    $kullanicisor->execute(array(
        'mail' => $kullanici_mail,
        'password' => $kullanici_password,
        'yetki' => 5
    ));

    $say = $kullanicisor->rowCount();

    if ($say == 1) {

        $_SESSION['kullanici_mail'] = $kullanici_mail;
        header("Location:../production/index.php");
        exit;

    } else {
        header("Location:../production/login.php?durum=no");
        exit;
    }

}

if (isset($_POST['genelayarkaydet'])) {
    $ayarKaydet = $db->prepare("UPDATE ayar SET 
    ayar_title=:ayar_title,
    ayar_description=:ayar_description,
    ayar_keywords=:ayar_keywords,
    ayar_author=:ayar_author
    WHERE ayar_id=0");

    $update = $ayarKaydet->execute(array(
        'ayar_title' => $_POST['ayar_title'],
        'ayar_description' => $_POST['ayar_description'],
        'ayar_keywords' => $_POST['ayar_keywords'],
        'ayar_author' => $_POST['ayar_author']
    ));

    if ($update) {
        header("Location:../production/genel-ayar.php?durum=ok");
    } else {
        header("Location:../production/genel-ayar.php?durum=no");
    }

}

if (isset($_POST['iletisimayarkaydet'])) {
    $ayarKaydet = $db->prepare("UPDATE ayar SET 
    ayar_tel=:ayar_tel,
    ayar_gsm=:ayar_gsm,
    ayar_faks=:ayar_faks,
    ayar_mail=:ayar_mail,
    ayar_ilce=:ayar_ilce,
    ayar_il=:ayar_il,
    ayar_adres=:ayar_adres,
    ayar_mesai=:ayar_mesai
    WHERE ayar_id=0");

    $update = $ayarKaydet->execute(array(
        'ayar_tel' => $_POST['ayar_tel'],
        'ayar_gsm' => $_POST['ayar_gsm'],
        'ayar_faks' => $_POST['ayar_faks'],
        'ayar_mail' => $_POST['ayar_mail'],
        'ayar_ilce' => $_POST['ayar_ilce'],
        'ayar_il' => $_POST['ayar_il'],
        'ayar_adres' => $_POST['ayar_adres'],
        'ayar_mesai' => $_POST['ayar_mesai']
    ));

    if ($update) {
        header("Location:../production/iletisim-ayarlar.php?durum=ok");
    } else {
        header("Location:../production/iletisim-ayarlar.php?durum=no");
    }

}

if (isset($_POST['apiayarkaydet'])) {
    $ayarKaydet = $db->prepare("UPDATE ayar SET 
    ayar_analystic=:ayar_analystic,
    ayar_maps=:ayar_maps,
    ayar_zopim=:ayar_zopim
    WHERE ayar_id=0");

    $update = $ayarKaydet->execute(array(
        'ayar_analystic' => $_POST['ayar_analystic'],
        'ayar_maps' => $_POST['ayar_maps'],
        'ayar_zopim' => $_POST['ayar_zopim']
    ));

    if ($update) {
        header("Location:../production/api-ayarlar.php?durum=ok");
    } else {
        header("Location:../production/api-ayarlar.php?durum=no");
    }

}

if (isset($_POST['sosyalayarkaydet'])) {
    $ayarKaydet = $db->prepare("UPDATE ayar SET 
    ayar_facebook=:ayar_facebook,
    ayar_twitter=:ayar_twitter,
    ayar_google=:ayar_google,
    ayar_youtube=:ayar_youtube
    WHERE ayar_id=0");

    $update = $ayarKaydet->execute(array(
        'ayar_facebook' => $_POST['ayar_facebook'],
        'ayar_twitter' => $_POST['ayar_twitter'],
        'ayar_google' => $_POST['ayar_google'],
        'ayar_youtube' => $_POST['ayar_youtube']
    ));

    if ($update) {
        header("Location:../production/sosyal-ayarlar.php?durum=ok");
    } else {
        header("Location:../production/sosyal-ayarlar.php?durum=no");
    }

}

if (isset($_POST['mailayarkaydet'])) {
    $ayarKaydet = $db->prepare("UPDATE ayar SET 
    ayar_smtphost=:ayar_smtphost,
    ayar_smtpuser=:ayar_smtpuser,
    ayar_smtppassword=:ayar_smtppassword,
    ayar_smtpport=:ayar_smtpport
    WHERE ayar_id=0");

    $update = $ayarKaydet->execute(array(
        'ayar_smtphost' => $_POST['ayar_smtphost'],
        'ayar_smtpuser' => $_POST['ayar_smtpuser'],
        'ayar_smtppassword' => $_POST['ayar_smtppassword'],
        'ayar_smtpport' => $_POST['ayar_smtpport']
    ));

    if ($update) {
        header("Location:../production/mail-ayarlar.php?durum=ok");
    } else {
        header("Location:../production/mail-ayarlar.php?durum=no");
    }

}

if (isset($_POST['hakkimizdakaydet'])) {
    $ayarKaydet = $db->prepare("UPDATE hakkimizda SET 
    hakkimizda_baslik=:hakkimizda_baslik,
    hakkimizda_icerik=:hakkimizda_icerik,
    hakkimizda_video=:hakkimizda_video,
    hakkimizda_vizyon=:hakkimizda_vizyon,
    hakkimizda_misyon=:hakkimizda_misyon
    WHERE hakkimizda_id=0");

    $update = $ayarKaydet->execute(array(
        'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
        'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
        'hakkimizda_video' => $_POST['hakkimizda_video'],
        'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
        'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
    ));

    if ($update) {
        header("Location:../production/hakkimizda.php?durum=ok");
    } else {
        header("Location:../production/hakkimizda.php?durum=no");
    }

}

if ($_GET['kullanicisil'] == "ok") {
    $sil = $db->prepare("DELETE FROM kullanici WHERE kullanici_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['kullanici_id']
    ));

    if ($kontrol) {
        header("Location:../production/kullanici.php?sil=ok");
        exit;
    } else {

        header("Location:../production/kullanici.php?sil=no");
        exit;
    }
}

if (isset($_POST['menuduzenle'])) {
    $menu_id = $_POST['menu_id'];

//    seo

    $menu_seourl = seo($_POST['menu_ad']);

    $ayarKaydet = $db->prepare("UPDATE menu SET 
    menu_ad=:menu_ad,
    menu_detay=:menu_detay,
    menu_url=:menu_url,
    menu_sira=:menu_sira,
    menu_seourl=:menu_seourl,
    menu_durum=:menu_durum
    WHERE menu_id={$_POST['menu_id']}");

    $update = $ayarKaydet->execute(array(
        'menu_ad' => $_POST['menu_ad'],
        'menu_detay' => $_POST['menu_detay'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seourl' => $menu_seourl,
        'menu_durum' => $_POST['menu_durum']
    ));

    if ($update) {

        header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
        exit;
    } else {

        header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
        exit;
    }
}

if (isset($_POST['menukaydet'])) {

//    seo

    $menu_seourl = seo($_POST['menu_ad']);

    $ayarEkle = $db->prepare("INSERT INTO menu SET 
    menu_ad=:menu_ad,
    menu_detay=:menu_detay,
    menu_url=:menu_url,
    menu_sira=:menu_sira,
    menu_seourl=:menu_seourl,
    menu_durum=:menu_durum");

    $insert = $ayarEkle->execute(array(
        'menu_ad' => $_POST['menu_ad'],
        'menu_detay' => $_POST['menu_detay'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seourl' => $menu_seourl,
        'menu_durum' => $_POST['menu_durum']
    ));

    if ($insert) {

        header("Location:../production/menu.php?durum=ok");
        exit;
    } else {

        header("Location:../production/menu.php?durum=no");
        exit;
    }
}

if ($_GET['slidersil'] == "ok") {
    $sil = $db->prepare("DELETE FROM slider WHERE slider_id=:id");

    $kontrol = $sil->execute(array(
        'id' => $_GET['slider_id']
    ));

    if ($kontrol) {
        header("Location:../production/slider.php?sil=ok");
        exit;
    } else {

        header("Location:../production/slider.php?sil=no");
        exit;
    }
}

if (isset($_POST['kategoriduzenle'])) {
    $kategori_id = $_POST['kategoriduzenle'];
    $kategori_seourl = seo($_POST['kategori_ad']);

    $kaydet = $db->prepare("UPDATE kategori SET
    kategori_ad=:ad,
    kategori_durum=:kategori_durum,
    kategori_seourl=:seourl,
    kategori_sira=:sira
    WHERE kategori_id={$_POST['kategori_id']}");

    $update = $kaydet->execute(array(
        'ad' => $_POST['kategori_ad'],
        'kategori_durum' => $_POST['kategori_durum'],
        'seourl' => $kategori_seourl,
        'sira' => $_POST['kategori_sira']
    ));

    if ($update) {
        header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=ok");
    } else {
        header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
    }

}

if ($_GET['kategorisil'] == "ok") {
    $sil = $db->prepare("DELETE FROM kategori WHERE kategori_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['kategori_id']
    ));

    if ($kontrol) {
        header("Location:../production/kategori.php?sil=ok");
        exit;
    } else {

        header("Location:../production/kategori.php?sil=no");
        exit;
    }
}

if ($_GET['menusil'] == "ok") {
    $sil = $db->prepare("DELETE FROM menu WHERE menu_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['menu_id']
    ));

    if ($kontrol) {
        header("Location:../production/menu.php?sil=ok");
        exit;
    } else {

        header("Location:../production/menu.php?sil=no");
        exit;
    }
}

if (isset($_POST['kategoriekle'])) {
    $kategori_seourl = seo($_POST['kategori_ad']);

    $kaydet = $db->prepare("INSERT INTO kategori SET
    kategori_ad=:ad,
    kategori_durum=:kategori_durum,
    kategori_seourl=:seourl,
    kategori_sira=:sira");

    $insert = $kaydet->execute(array(
        'ad' => $_POST['kategori_ad'],
        'kategori_durum' => $_POST['kategori_durum'],
        'seourl' => $kategori_seourl,
        'sira' => $_POST['kategori_sira']
    ));

    if ($insert) {
        header("Location:../production/kategori.php?durum=ok");
    } else {
        header("Location:../production/kategori.php?&durum=no");
    }

}

if ($_GET['urunsil'] == "ok") {
    $sil = $db->prepare("DELETE FROM urun WHERE urun_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['urun_id']
    ));

    if ($kontrol) {
        header("Location:../production/urun.php?sil=ok");
        exit;
    } else {

        header("Location:../production/urun.php?sil=no");
        exit;
    }
}

if (isset($_POST['urunEkle'])) {
    $urun_seourl = seo($_POST['urun_ad']);

    $kaydet = $db->prepare("INSERT INTO urun SET
    kategori_id=:kategori_id,
    urun_detay=:urun_detay,
    urun_fiyat=:urun_fiyat,
    urun_video=:urun_video,
    urun_keyword=:urun_keyword,
    urun_ad=:ad,
    urun_durum=:urun_durum,
    urun_stok=:urun_stok,
    urun_seourl=:seourl");

    $insert = $kaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],
        'ad' => $_POST['urun_ad'],
        'urun_fiyat' => $_POST['urun_fiyat'],
        'urun_video' => $_POST['urun_video'],
        'urun_keyword' => $_POST['urun_keyword'],
        'urun_detay' => $_POST['urun_detay'],
        'urun_durum' => $_POST['urun_durum'],
        'urun_stok' => $_POST['urun_stok'],
        'seourl' => $urun_seourl
    ));

    if ($insert) {
        header("Location:../production/urun.php?durum=ok");
    } else {
        header("Location:../production/urun.php?&durum=no");
    }

}

if (isset($_POST['urunDuzenle'])) {

    $urun_id = $_POST['urun_id'];
    $urun_seourl = seo($_POST['urun_ad']);

    $kaydet = $db->prepare("UPDATE urun SET
    kategori_id=:kategori_id,
    urun_detay=:urun_detay,
    urun_fiyat=:urun_fiyat,
    urun_video=:urun_video,
    urun_onecikar=:urun_onecikar,
    urun_keyword=:urun_keyword,
    urun_ad=:ad,
    urun_durum=:urun_durum,
    urun_stok=:urun_stok,
    urun_seourl=:seourl
    WHERE urun_id = {$_POST['urun_id']}");

    $update = $kaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],
        'ad' => $_POST['urun_ad'],
        'urun_fiyat' => $_POST['urun_fiyat'],
        'urun_video' => $_POST['urun_video'],
        'urun_onecikar' => $_POST['urun_onecikar'],
        'urun_keyword' => $_POST['urun_keyword'],
        'urun_detay' => $_POST['urun_detay'],
        'urun_durum' => $_POST['urun_durum'],
        'urun_stok' => $_POST['urun_stok'],
        'seourl' => $urun_seourl
    ));

    if ($update) {
        header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");
    } else {
        header("Location:../production/urun-duzenle.php?&durum=no&urun_id=$urun_id");
    }

}

if (isset($_POST['yorumkaydet'])) {


    $gelen_url = $_POST['gelen_url'];

    $ayarekle = $db->prepare("INSERT INTO yorumlar SET
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		
		");

    $insert = $ayarekle->execute(array(
        'yorum_detay' => $_POST['yorum_detay'],
        'kullanici_id' => $_POST['kullanici_id'],
        'urun_id' => $_POST['urun_id']

    ));


    if ($insert) {

        Header("Location:$gelen_url?durum=ok");

    } else {

        Header("Location:$gelen_url?durum=no");
    }

}

if ($_GET['yorumsil'] == "ok") {
    $sil = $db->prepare("DELETE FROM yorumlar WHERE yorum_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['yorum_id']
    ));

    if ($kontrol) {
        header("Location:../production/yorumlar.php?sil=ok");
        exit;
    } else {

        header("Location:../production/yorumlar.php?sil=no");
        exit;
    }
}

if (isset($_POST['sepeteekle'])) {

    $ayarekle = $db->prepare("INSERT INTO sepet SET
		urun_adet=:urun_adet,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id");

    $insert = $ayarekle->execute(array(
        'urun_adet' => $_POST['urun_adet'],
        'kullanici_id' => $_POST['kullanici_id'],
        'urun_id' => $_POST['urun_id']));


    if ($insert) {

        Header("Location:../../sepet?durum=ok");

    } else {

        Header("Location:../../sepet?durum=no");
    }

}

if ($_GET['urun_onecikar'] == "ok") {


    $duzenle = $db->prepare("UPDATE urun SET
		urun_onecikar=:urun_onecikar
		WHERE urun_id={$_GET['urun_id']}");
    $update = $duzenle->execute(array(
        'urun_onecikar' => $_GET['urun_one']
    ));


    if ($update) {

        Header("Location:../production/urun.php?durum=ok");

    } else {

        Header("Location:../production/urun.php?durum=no");
    }

}

if ($_GET['yorum_onay'] == "ok") {


    $duzenle = $db->prepare("UPDATE yorumlar SET
		yorum_onay=:yorum_onay
		WHERE yorum_id={$_GET['yorum_id']}");
    $update = $duzenle->execute(array(
        'yorum_onay' => $_GET['yorum_one']
    ));


    if ($update) {

        Header("Location:../production/yorumlar.php?durum=ok");

    } else {

        Header("Location:../production/yorumlar.php?durum=no");
    }

}

if (isset($_POST['bankaekle'])) {


    $kaydet = $db->prepare("INSERT INTO banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		");
    $insert = $kaydet->execute(array(
        'ad' => $_POST['banka_ad'],
        'banka_durum' => $_POST['banka_durum'],
        'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
        'banka_iban' => $_POST['banka_iban']
    ));

    if ($insert) {

        Header("Location:../production/banka.php?durum=ok");

    } else {

        Header("Location:../production/banka.php?durum=no");
    }

}

if (isset($_POST['bankaduzenle'])) {


    $kaydet = $db->prepare("UPDATE banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		WHERE banka_id={$_POST['banka_id']}");


    $update = $kaydet->execute(array(
        'ad' => $_POST['banka_ad'],
        'banka_durum' => $_POST['banka_durum'],
        'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
        'banka_iban' => $_POST['banka_iban']
    ));

    if ($update) {

        Header("Location:../production/banka-duzenle.php?durum=ok");

    } else {

        Header("Location:../production/banka-duzenle.php?durum=no");
    }

}

if ($_GET['bankasil'] == "ok") {
    $sil = $db->prepare("DELETE FROM banka WHERE banka_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['banka_id']
    ));

    if ($kontrol) {
        header("Location:../production/banka.php?sil=ok");
        exit;
    } else {

        header("Location:../production/banka.php?sil=no");
        exit;
    }
}

