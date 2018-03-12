<?php
include('../app/bootstrap.php');

$rows = getCurrentEvent($dbh, $_GET['roomID']);
//有可能會回傳空 array, 或兩筆以上

if(isset($_GET['ajax']) and $_GET['ajax']=='getCurrentEvent'){
    header('Content-Type: application/json');
    echo json_encode($rows);
    exit();
}

$twig->display(
    'page-room.html',
    [
        'meetingRooms' => $meetingRooms, 
        'roomID' => $_GET['roomID']
    ]
);

function getCurrentEvent($dbh, $roomID)
{
    try {
        $sql = 'SELECT * FROM events WHERE roomID=? AND NOW() BETWEEN `start` AND `end`';
        $sth = $dbh->prepare($sql);
        $sth->execute([$roomID]);
        return $sth->fetchAll();
    } catch (PDOException $e) {
        return ['errMsg' => $e->getMessage()];
    }
}