<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="assets/font-awesome.min.css" rel="stylesheet">
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <style>
        .custom-form-group {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="pull-left">
        <div class="logo"><a href="#"><span>Admin Panel</span></a></div>
        <div class="hamburger sidebar-toggle">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>
</div>
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>Ürün ekle</h4>
                            </div>
                            <div class="card-body">
                                <div class="menu-upload-form">
                                    <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ürün adı</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="urun_ad"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ürün detayı</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="urun_detay" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group custom-form-group">
                                            <label class="col-sm-2 control-label">Ürün<br>kategorisi seçin</label>
                                            <div class="col-sm-10">
                                                <select name="kategori_id" data-toggle="dropdown" class="form-control">
                                                    <option value="Sıcak içecekler">Sıcak İçecekler</option>
                                                    <option value="Soğuk içecekler">Soğuk içecekler</option>
                                                    <option value="Tatlılar">Tatlılar</option>
                                                    <option value="Yiyecekler">Yiyecekler</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ürün fiyatı</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="urun_fiyat"  class="form-control" placeholder="0.00₺">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ürün resmi</label>
                                            <div class="col-sm-10">
                                                <div class="form-control file-input dark-browse-input-box">
                                                    <label for="urun_resim"></label>
                                                    <input type="file" name="urun_resim" accept="image/*"><br>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10"><br>
                                                    <button type="submit" name="ekle" class="btn btn-lg btn-primary">Ekle</button>
                                                </div>
                                            </div>
                                            <?php
                                            include 'connection.php';

                                            // Form gönderimi işle
                                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ekle"])) {
                                                $urun_ad = $_POST["urun_ad"];
                                                $urun_detay = isset($_POST["urun_detay"]) ? $_POST["urun_detay"] : ""; // Eğer boşsa, boş bir string ata
                                                $kategori_id = $_POST["kategori_id"];
                                                $urun_fiyat = $_POST["urun_fiyat"];

                                                // Seçilen kategoriyi kontrol et
                                                if ($kategori_id == "Sıcak içecekler") {
                                                    $kategori_id = 1;
                                                } else if ($kategori_id == "Soğuk içecekler") {
                                                    $kategori_id = 2;
                                                } else if ($kategori_id == "Tatlılar") {
                                                    $kategori_id = 3;
                                                } else if ($kategori_id == "Yiyecekler") {
                                                    $kategori_id = 4;
                                                }

                                                // Resim yüklemeyi işle
                                                $urun_resim_data = file_get_contents($_FILES["urun_resim"]["tmp_name"]);

                                                // Resim verisini başarılı bir şekilde okunduğundan emin ol
                                                if ($urun_resim_data !== false) {
                                                    // Yeni ürün eklemek için SQL sorgusu
                                                    $sql = "INSERT INTO urun (urun_ad, kategori_id, urun_fiyat, urun_resim, urun_detay)VALUES (?, ?, ?, CONVERT(varbinary(max), ?), ?)";

                                                    // Sorguyu hazırla  
                                                    $stmt = sqlsrv_prepare($conn, $sql, array(&$urun_ad, &$kategori_id, &$urun_fiyat, &$urun_resim_data, &$urun_detay));

                                                    // Sorguyu çalıştır
                                                    $result = sqlsrv_execute($stmt);

                                                    if ($result) {
                                                        echo "Ürün başarıyla eklendi!";
                                                    } else {
                                                        echo "Hata: " . print_r(sqlsrv_errors(), true);
                                                    }
                                                } else {
                                                    echo "Resim yüklenirken hata oluştu.";
                                                }
                                            }
                                            // Bağlantıyı kapat
                                            sqlsrv_close($conn);
                                            ?>
                                    </form><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>Ürün Sil</h4>
                            </div>
                            <div class="card-body">
                                <div class="menu-upload-form">
                                    <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="menu-upload-form">
                                                <!-- Ürün kategorisi seçme -->
                                                <div class="form-group custom-form-group">
                                                    <label class="col-sm-2 control-label">Ürün<br> kategorisi seçin</label>
                                                    <div class="col-sm-10">
                                                        <select name="kategori_id_listele" data-toggle="dropdown" class="form-control">
                                                            <option value="1">Sıcak İçecekler</option>
                                                            <option value="2">Soğuk içecekler</option>
                                                            <option value="3">Tatlılar</option>
                                                            <option value="4">Yiyecekler</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Listeleme Butonu -->
                                                <div class="form-group custom-form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-lg btn-primary" name="listele">Listele</button>
                                                    </div>
                                                </div>
                                                <?php
                                                include 'connection.php';

                                                // Form gönderimi işle
                                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["listele"])) {
                                                    $kategori_id = isset($_POST["kategori_id_listele"]) ? $_POST["kategori_id_listele"] : '';

                                                    // SQL sorgusu
                                                    $sql = "SELECT urun_id, urun_ad, urun_detay, urun_fiyat, urun_resim FROM urun WHERE kategori_id = ?";

                                                    // SQL sorgusunu hazırla
                                                    $stmt = sqlsrv_prepare($conn, $sql, array(&$kategori_id)); // &$kategori_id referans olarak iletiliyor

                                                    if (sqlsrv_execute($stmt)) {
                                                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                            // Her ürün için ayrı bir form oluştur
                                                            echo '<div class="col-lg-4 col-6">';
                                                            echo '<div class="menu-item menu-grid-item">';
                                                            echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($row['urun_resim']) . '" alt="" width="250" height="250">';
                                                            echo '<h6 class="mb-0">' . $row['urun_ad'] . '</h6>';
                                                            echo '<h6 class="mb-0">' . $row['urun_detay'] . '</h6>';
                                                            echo '<div class="row align-items-center mt-4">';
                                                            echo '<div class="col-sm-6"><span class="text-md mr-4">' . $row['urun_fiyat'] . '₺</span></div><br>';

                                                            // Her ürün için ayrı bir form oluşturuldu
                                                            echo '<form method="POST" action="">';
                                                            echo '<input type="hidden" name="urun_id_sil" value="' . $row['urun_id'] . '">';
                                                            echo '<button type="submit" class="btn btn-danger btn-flat btn-md" name="sil">Sil</button>';

                                                            echo '</div>';
                                                            echo '<br></div>';
                                                            echo '</div>';
                                                            echo '</form>';
                                                        }
                                                    }
                                                    else {
                                                        die("Sorgu çalıştırma hatası: " . sqlsrv_errors()[0]['message']);
                                                    }

                                                    // Bağlantıyı kapat
                                                    sqlsrv_close($conn);
                                                }
                                                // Silme işlemi
                                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sil"])) {
                                                    $urun_id_sil = isset($_POST["urun_id_sil"]) ? $_POST["urun_id_sil"] : '';

                                                    // SQL sorgusu
                                                    $sql_sil = "DELETE FROM urun WHERE urun_id = ?";

                                                    // SQL sorgusunu hazırla
                                                    $stmt_sil = sqlsrv_prepare($conn, $sql_sil, array(&$urun_id_sil)); // &$urun_id_sil referans olarak iletiliyor

                                                    // Sorguyu çalıştır
                                                    if (sqlsrv_execute($stmt_sil)) {
                                                        echo "Ürün başarıyla silindi!";
                                                    } else {
                                                        die("Silme hatası: " . sqlsrv_errors()[0]['message']);
                                                    }

                                                    // Bağlantıyı kapat
                                                    sqlsrv_close($conn);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </form><br>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Ürün Güncelle</h4>
                                </div>
                                <div class="card-body">
                                    <div class="menu-upload-form">
                                        <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <div class="menu-upload-form">
                                                    <!-- Ürün kategorisi seçme -->
                                                    <div class="form-group custom-form-group">
                                                        <label class="col-sm-2 control-label">Ürün<br> kategorisi seçin</label>
                                                        <div class="col-sm-10">
                                                            <select name="kategori_id_listele" data-toggle="dropdown" class="form-control">
                                                                <option value="1">Sıcak İçecekler</option>
                                                                <option value="2">Soğuk içecekler</option>
                                                                <option value="3">Tatlılar</option>
                                                                <option value="4">Yiyecekler</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- Listeleme Butonu -->
                                                    <div class="form-group custom-form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" class="btn btn-lg btn-primary" name="listeleiki">Listele</button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    include 'connection.php';

                                                    // Form gönderimi işle
                                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["listeleiki"])) {
                                                        $kategori_id = isset($_POST["kategori_id_listele"]) ? $_POST["kategori_id_listele"] : '';

                                                        // SQL sorgusu
                                                        $sql = "SELECT urun_id, urun_ad, urun_detay, urun_fiyat, CONVERT(varbinary(max), urun_resim) as urun_resim_data FROM urun WHERE kategori_id = ?";

                                                        // SQL sorgusunu hazırla
                                                        $stmt = sqlsrv_prepare($conn, $sql, array(&$kategori_id));

                                                        // Sorguyu çalıştır
                                                        if (sqlsrv_execute($stmt)) {
                                                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                                echo '<form method="post" enctype="multipart/form-data">';
                                                                echo '<div class="col-lg-4 col-6">';
                                                                echo '<div class="menu-item menu-grid-item">';
                                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($row['urun_resim_data']) . '" width="250" height="250"><br>';
                                                                echo '<input type="hidden" name="urun_id_guncelle" value="' . $row['urun_id'] . '"><br>';
                                                                echo '<input type="text" name="urun_ad_guncelle" value="' . $row['urun_ad'] . '"><br>';
                                                                echo '<input type="text" name="urun_detay_guncelle" value="' . $row['urun_detay'] . '"><br>';
                                                                echo '<input type="text" name="urun_fiyat_guncelle" value="' . $row['urun_fiyat'] . '"><br>';
                                                                echo '<div class="form-group custom-form-group">
                    <div class="col-sm-10">
                        <input type="file" name="urun_resim_guncelle" accept="image/*">
                    </div>
                </div>';
                                                                echo '<button type="submit" class="btn btn-success btn-flat m-b-10 m-l-5" name="guncelle">Güncelle</button><br>';
                                                                echo '</div>';
                                                                echo '<br></div>';
                                                                echo '</form>';
                                                            }
                                                        } else {
                                                            die("Sorgu çalıştırma hatası: " . sqlsrv_errors()[0]['message']);
                                                        }

                                                        // Bağlantıyı kapat
                                                        sqlsrv_close($conn);
                                                    }

                                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guncelle"])) {
                                                        // Kullanıcıdan alınan veriler
                                                        $urun_id_guncelle = isset($_POST["urun_id_guncelle"]) ? $_POST["urun_id_guncelle"] : '';
                                                        $urun_ad_guncelle = isset($_POST["urun_ad_guncelle"]) ? $_POST["urun_ad_guncelle"] : '';
                                                        $urun_detay_guncelle = isset($_POST["urun_detay_guncelle"]) ? $_POST["urun_detay_guncelle"] : '';
                                                        $urun_fiyat_guncelle = isset($_POST["urun_fiyat_guncelle"]) ? $_POST["urun_fiyat_guncelle"] : '';

                                                        // Kullanıcıdan alınan resim dosyası
                                                        // Yeni resim yüklenmişse
                                                        if (isset($_FILES["urun_resim_guncelle"]) && $_FILES["urun_resim_guncelle"]["size"] > 0) {
                                                            $urun_resim_guncelle = file_get_contents($_FILES["urun_resim_guncelle"]["tmp_name"]);

                                                            $sql = "UPDATE urun SET urun_ad = ?, urun_detay = ?, urun_fiyat = ?, urun_resim = CONVERT(varbinary(max), ?) WHERE urun_id = ?";
                                                            $params = array($urun_ad_guncelle, $urun_detay_guncelle, $urun_fiyat_guncelle, $urun_resim_guncelle, $urun_id_guncelle);
                                                        } else {
                                                            // Yeni resim yüklenmemişse
                                                            $sql = "UPDATE urun SET urun_ad = ?, urun_detay = ?, urun_fiyat = ? WHERE urun_id = ?";
                                                            $params = array($urun_ad_guncelle, $urun_detay_guncelle, $urun_fiyat_guncelle, $urun_id_guncelle);
                                                        }

                                                        // SQL sorgusunu hazırla
                                                        $stmt = sqlsrv_prepare($conn, $sql, $params);

                                                        // Sorguyu çalıştır
                                                        if ($stmt && sqlsrv_execute($stmt)) {
                                                            echo "Ürün güncelleme başarılı!";
                                                        } else {
                                                            echo "Ürün güncelleme hatası: " . print_r(sqlsrv_errors(), true);
                                                        }

                                                        // Bağlantıyı kapat
                                                        sqlsrv_close($conn);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </form><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jquery vendor -->
<script src="assets/js/lib/jquery.min.js"></script>
<script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
<!-- nano scroller -->
<script src="assets/js/lib/menubar/sidebar.js"></script>
<script src="assets/js/lib/preloader/pace.min.js"></script>
<!-- sidebar -->
<script src="assets/js/lib/bootstrap.min.js"></script>
<!-- bootstrap -->
<script src="assets/js/lib/mmc-common.js"></script>
<script src="assets/js/lib/mmc-chat.js"></script>
<script src="assets/js/scripts.js"></script>
<!-- scripit init-->
</body>

</html>