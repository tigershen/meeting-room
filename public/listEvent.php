<?php
include('../app/bootstrap.php');

header('Content-Type: application/json');
$result = [];

if(isset($_GET['start']) and isset($_GET['end'])){
    $result = listEvent($dbh, $_GET);
}
echo json_encode($result);
exit();

function listEvent(PDO $dbh, array $g){
    try {
        $sql = 'SELECT `id`,`title`,`start`,`end` FROM events WHERE roomID=? '
            .'AND `start` BETWEEN ? AND ?';
        $sth = $dbh->prepare($sql);
        $sth->execute([$g['roomID'], $g['start'], $g['end']]);
        return $sth->fetchAll();
    } catch (PDOException $e) {
        return ['errMsg' => $e->getMessage()];
    }
}