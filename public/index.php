<?php
include('../app/bootstrap.php');

if (isset($_GET['ajax']) and in_array($_GET['ajax'], ['saveEvent','getEvent','delEvent'])) {
    header('Content-Type: application/json');
    switch ($_GET['ajax']) {
        case 'saveEvent':
            $result = isset($_POST['id']) ? editEvent($dbh, $_POST) : addEvent($dbh, $_POST);
            break;

        case 'getEvent':
            $result = getEvent($dbh, $_GET['id']);
            break;

        case 'delEvent':
            $result = delEvent($dbh, $_GET['id']);
            break;
    }
    echo json_encode($result);
    exit();
}elseif(!isset($_GET['roomID'])){
    redirect('index.php?roomID=1');
}

$twig->display('page-index.html', ['meetingRooms'=>$meetingRooms, 'roomID'=>$_GET['roomID']]);

function getEvent(PDO $dbh, int $id){
    try {
        $sql = 'SELECT * FROM events WHERE id=?';
        $sth = $dbh->prepare($sql);
        $sth->execute([$id]);
        return $sth->fetch();
    } catch (PDOException $e) {
        return ['errMsg' => $e->getMessage()];
    }
}

function addEvent(PDO $dbh, array $p){
    try {
        $sql = 'INSERT INTO events (`title`,`register`,`start`,`end`,roomID) VALUES (?,?,?,?,?)';
        $sth = $dbh->prepare($sql);
        $sth->execute([$p['title'],$p['register'],$p['start'],$p['end'],$p['roomID']]);
    } catch (PDOException $e) {
        return ['errMsg' => $e->getMessage()];
    }
    return ['result' => 'success'];
}

function editEvent(PDO $dbh, array $p){
    try {
        $sql = 'UPDATE events SET `title`=?, `register`=? WHERE id=?';
        $sth = $dbh->prepare($sql);
        $sth->execute([$p['title'],$p['register'],$p['id']]);
    } catch (PDOException $e) {
        return ['errMsg' => $e->getMessage()];
    }
    return ['result' => 'success'];
}

function delEvent(PDO $dbh, int $id){
    try {
        $sql = 'DELETE FROM events WHERE id=?';
        $sth = $dbh->prepare($sql);
        $sth->execute([$id]);
    } catch (PDOException $e) {
        return ['errMsg' => $e->getMessage()];
    }
    return ['result' => 'success'];
}