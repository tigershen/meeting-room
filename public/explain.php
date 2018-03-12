<?php
include('../app/bootstrap.php');

$twig->display('page-explain.html',['meetingRooms'=>$meetingRooms]);