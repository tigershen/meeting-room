<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$meetingRooms = [1=>'會議室一', 2=>'會議室二'];

session_start();

try {
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=UTF8',
        $_ENV['DB_HOST'],
        $_ENV['DB_DATABASE']
    );
    $dbh = new PDO($dsn, $_ENV['DB_USR'], $_ENV['DB_PWD']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$twigLoader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
$twig = new Twig_Environment($twigLoader);


function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}