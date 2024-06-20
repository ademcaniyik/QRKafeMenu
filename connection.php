<?php
$serverName = "Server adınızı buraya yazınız"; // Sunucu adı
$connectionInfo = array(
    "Database" => "Veritabanınızın adını buraya yazınız", // Veritabanı adı
    "UID" => "", // Kullanıcı adı
    "PWD" => "" // Parola
);

// SQL Server bağlantısını oluştur
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Bağlantı kontrolü
if ($conn === false) {
    die("Bağlantı hatası: " . sqlsrv_errors()[0]['message']);
}
sqlsrv_configure('', SQLSRV_LOG_SEVERITY_ALL);
