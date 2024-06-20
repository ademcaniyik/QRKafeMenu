<!DOCTYPE html>
<html lang="en">
<head>
<?php
include "connection.php";
?>
<!-- Meta -->
<meta charset=UTF-8 />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Title -->
<title>Kafemize Hoşgeldiniz</title>
<!-- Favicons -->
<link rel="shortcut icon" href="assets/img/modakafe.webp.png">
<link rel="apple-touch-icon" href="assets/img/modakafe.webp.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon_76x76.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon_120x120.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon_152x152.png">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Raleway:wght@100;200;400;500&display=swap" rel="stylesheet">
<!-- CSS Core -->
<link rel="stylesheet" href="dist/css/core.css" />
<!-- CSS Theme -->
<link id="theme" rel="stylesheet" href="dist/css/theme-beige.css" />
    <style>
        .image-container {
            width: 250px; /* İstenen genişlik değeri */
            height: 300px; /* İstenen yükseklik değeri */
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: fill; /* Resmi konteyner içinde sıkıştırma */
            /*
            Eğer farklı bir sıkıştırma istiyorsan burayı kullan
            object-fit: contain; Resmi konteyner içinde sıkıştırma
            */
        }
    </style>
</head>
<div id="body-wrapper">
    <!-- Header -->
    <header id="header" class="light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                        <a href="#">
                            <img src="assets/img/gecit.jpg" alt="Geçit Image" width="200" height="150">
                        </a>
                </div>
            </div>
        </div>
    </header>
    <header id="header-mobile" class="light">
        <div class="module module-logo ">
            <a href="#">
                <img src="assets/img/logo-horizontal-dark.svg" alt="">
            </a>
        </div>
    </header>
    <div id="content">
        <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-10 offset-md-1" role="tablist">
                        <!-- Menu Category / Hot Drinks -->
                        <div id="Drinks" class="menu-category">
                            <div class="menu-category-title collapse-toggle collapsed" role="tab" data-target="#menuDrinksContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/sıcak-icecekler.jpg" alt=""></div>
                                <h2 class="title" style="font-size: 30px">Sıcak İçecekler</h2>
                            </div>
                            <div id="menuDrinksContent" class="menu-category-content collapse">
                                <div class="p-4">
                                    <div class="row gutters-sm">
                                        <?php
                                        $sql = "SELECT urun_id, urun_ad, urun_fiyat, urun_resim, urun_detay FROM urun WHERE kategori_id=1";
                                        $result = sqlsrv_query($conn, $sql);

                                        if ($result === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }

                                        if (sqlsrv_has_rows($result)) {
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $productId = $row["urun_id"];
                                                $productName = $row["urun_ad"];
                                                $productPrice = $row["urun_fiyat"];
                                                $productDetay = $row["urun_detay"];
                                                $productImage = $row["urun_resim"];

                                                echo '<div class="col-lg-4 col-6">';
                                                echo '<div class="menu-item menu-grid-item">';
                                                echo '<div class="image-container">';
                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
                                                echo '</div>';
                                                echo '<br><h6 class="mb-0">' . $productName . '</h6><br>';
                                                echo '<h7 class="mb-0">' . $productDetay . '</h7>';
                                                echo '<div class="row align-items-center mt-4">';
                                                echo '<div class="col-sm-6"><span class="text-md mr-4">' . $productPrice . '₺</span></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "Hiç ürün bulunamadı.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Menu Category / Soğuk İçecekler -->
                        <div id="Sushi" class="menu-category">
                            <div class="menu-category-title collapse-toggle collapsed" role="tab" data-target="#menuSushiContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="assets/img/sogukicecekler.jpeg" alt=""></div>
                                <h2 style="font-size: 30px" class="title">Soğuk İçecekler</h2>
                            </div>
                            <div id="menuSushiContent" class="menu-category-content collapse">
                                <div class="p-4">
                                    <div class="row gutters-sm">
                                        <?php
                                        $sql = "SELECT urun_id, urun_ad, urun_fiyat, urun_resim, urun_detay FROM urun WHERE kategori_id=2";
                                        $result = sqlsrv_query($conn, $sql);

                                        if ($result === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }

                                        if (sqlsrv_has_rows($result)) {
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $productId = $row["urun_id"];
                                                $productName = $row["urun_ad"];
                                                $productPrice = $row["urun_fiyat"];
                                                $productDetay = $row["urun_detay"];
                                                $productImage = $row["urun_resim"];

                                                echo '<div class="col-lg-4 col-6">';
                                                echo '<div class="menu-item menu-grid-item">';
                                                echo '<div class="image-container">';
                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
                                                echo '</div>';
                                                echo '<br><h6 class="mb-0">' . $productName . '</h6><br>';
                                                echo '<h7 class="mb-0">' . $productDetay . '</h7>';
                                                echo '<div class="row align-items-center mt-4">';
                                                echo '<div class="col-sm-6"><span class="text-md mr-4">' . $productPrice . '₺</span></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "Hiç ürün bulunamadı.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Menu Category / Desserts -->
                        <div id="Desserts" class="menu-category">
                            <div class="menu-category-title collapse-toggle collapsed" role="tab" data-target="#menuDessertsContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/menu-title-desserts.jpg" alt=""></div>
                                <h2 class="title">Tatlılar</h2>
                            </div>
                            <div id="menuDessertsContent" class="menu-category-content collapse">
                                <div class="p-4">
                                    <div class="row gutters-sm">
                                        <?php
                                        $sql = "SELECT urun_id, urun_ad, urun_fiyat, urun_resim, urun_detay FROM urun WHERE kategori_id=3";
                                        $result = sqlsrv_query($conn, $sql);

                                        if ($result === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }

                                        if (sqlsrv_has_rows($result)) {
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $productId = $row["urun_id"];
                                                $productName = $row["urun_ad"];
                                                $productPrice = $row["urun_fiyat"];
                                                $productDetay = $row["urun_detay"];
                                                $productImage = $row["urun_resim"];

                                                echo '<div class="col-lg-4 col-6">';
                                                echo '<div class="menu-item menu-grid-item">';
                                                echo '<div class="image-container">';
                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
                                                echo '</div>';
                                                echo '<br><h6 class="mb-0">' . $productName . '</h6><br>';
                                                echo '<h7 class="mb-0">' . $productDetay . '</h7>';
                                                echo '<div class="row align-items-center mt-4">';
                                                echo '<div class="col-sm-6"><span class="text-md mr-4">' . $productPrice . '₺</span></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "Hiç ürün bulunamadı.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Menu Category / Burgers -->
                        <div id="Burgers" class="menu-category">
                            <div class="menu-category-title collapse-toggle collapsed" role="tab" data-target="#menuBurgersContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/menu-title-burgers.jpg" alt=""></div>
                                <h2 class="title">Yiyecekler</h2>
                            </div>
                            <div id="menuBurgersContent" class="menu-category-content collapse">
                                <div class="p-4">
                                    <div class="row gutters-sm">
                                        <?php
                                        $sql = "SELECT urun_id, urun_ad, urun_fiyat, urun_resim, urun_detay FROM urun WHERE kategori_id=4";
                                        $result = sqlsrv_query($conn, $sql);

                                        if ($result === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }

                                        if (sqlsrv_has_rows($result)) {
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $productId = $row["urun_id"];
                                                $productName = $row["urun_ad"];
                                                $productPrice = $row["urun_fiyat"];
                                                $productDetay = $row["urun_detay"];
                                                $productImage = $row["urun_resim"];

                                                echo '<div class="col-lg-4 col-6">';
                                                echo '<div class="menu-item menu-grid-item">';
                                                echo '<div class="image-container">';
                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
                                                echo '</div>';
                                                echo '<br><h6 class="mb-0">' . $productName . '</h6><br>';
                                                echo '<h7 class="mb-0">' . $productDetay . '</h7>';
                                                echo '<div class="row align-items-center mt-4">';
                                                echo '<div class="col-sm-6"><span class="text-md mr-4">' . $productPrice . '₺</span></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "Hiç ürün bulunamadı.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Menu Category / Pasta -->
                        <div id="Pasta" class="menu-category">
                            <div class="menu-category-title collapse-toggle collapsed" role="tab" data-target="#menuPastaContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/menu-title-pasta.jpg" alt=""></div>
                                <h2 class="title">Makarnalar</h2>
                            </div>
                            <div id="menuPastaContent" class="menu-category-content collapse">
                                <div class="p-4">
                                    <div class="row gutters-sm">
                                        <?php
                                        $sql = "SELECT urun_id, urun_ad, urun_fiyat, urun_resim, urun_detay FROM urun WHERE kategori_id=5";
                                        $result = sqlsrv_query($conn, $sql);

                                        if ($result === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }

                                        if (sqlsrv_has_rows($result)) {
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $productId = $row["urun_id"];
                                                $productName = $row["urun_ad"];
                                                $productPrice = $row["urun_fiyat"];
                                                $productDetay = $row["urun_detay"];
                                                $productImage = $row["urun_resim"];

                                                echo '<div class="col-lg-4 col-6">';
                                                echo '<div class="menu-item menu-grid-item">';
                                                echo '<div class="image-container">';
                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
                                                echo '</div>';
                                                echo '<br><h6 class="mb-0">' . $productName . '</h6><br>';
                                                echo '<h7 class="mb-0">' . $productDetay . '</h7>';
                                                echo '<div class="row align-items-center mt-4">';
                                                echo '<div class="col-sm-6"><span class="text-md mr-4">' . $productPrice . '₺</span></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "Hiç ürün bulunamadı.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Menu Category / Pizza -->
                        <div id="Pizza" class="menu-category">
                            <div class="menu-category-title collapse-toggle collapsed" role="tab" data-target="#menuPizzaContent" data-toggle="collapse" aria-expanded="false">
                                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/menu-title-pizza.jpg" alt=""></div>
                                <h2 class="title">Pizzalar</h2>
                            </div>
                            <div id="menuPizzaContent" class="menu-category-content collapse">
                                <div class="p-4">
                                    <div class="row gutters-sm">
                                        <?php
                                        $sql = "SELECT urun_id, urun_ad, urun_fiyat, urun_resim, urun_detay FROM urun WHERE kategori_id=6";
                                        $result = sqlsrv_query($conn, $sql);

                                        if ($result === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }

                                        if (sqlsrv_has_rows($result)) {
                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $productId = $row["urun_id"];
                                                $productName = $row["urun_ad"];
                                                $productPrice = $row["urun_fiyat"];
                                                $productDetay = $row["urun_detay"];
                                                $productImage = $row["urun_resim"];

                                                echo '<div class="col-lg-4 col-6">';
                                                echo '<div class="menu-item menu-grid-item">';
                                                echo '<div class="image-container">';
                                                echo '<img class="mb-4" src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
                                                echo '</div>';
                                                echo '<br><h6 class="mb-0">' . $productName . '</h6><br>';
                                                echo '<h7 class="mb-0">' . $productDetay . '</h7>';
                                                echo '<div class="row align-items-center mt-4">';
                                                echo '<div class="col-sm-6"><span class="text-md mr-4">' . $productPrice . '₺</span></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "Hiç ürün bulunamadı.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="dist/js/core.js"></script>
<script>
    
</script>
</body>
</html>
