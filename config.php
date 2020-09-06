<?php

//Silahkan Edit Bagian Ini
//Kredensial Database
$hostname = 'localhost';
$username = '';
$password = '';
$database = '';
//Kredensial Database

//Main URL Web Anda
$base_url = 'https://sms-gratis.xyz/live';
//Main URL Web Anda
//Silahkan Edit Bagian Ini

//Jangan Diubah
$source_url = 'https://bitneptune.com';
$api_url = 'https://kuysms.me';

$source_url_tmp = parse_url($source_url);
$source_url_host = $source_url_tmp['host'];

$api_url_tmp = parse_url($api_url);
$api_url_host = $api_url_tmp['host'];

$base_url_tmp = parse_url($base_url);
$url_host = $base_url_tmp['host'];
$url_path = $base_url_tmp['path'];
$base_url_host = "$url_host$url_path";
$base_url_host = rtrim($base_url_host, '/');

$base_url = rtrim($base_url, '/');
$conn = mysqli_connect($hostname, $username, $password, $database);
//Jangan Diubah