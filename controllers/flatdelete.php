<?php
session_start();
require_once("../model/flatdel.php");


$flatId = $_GET['flatId'];

$ids = explode(" ", $flatId);

$flatId = $ids[0];
$addressId =  $ids[1];
$infoId =  $ids[2];

if (empty($infoId)) {
    $infoId = 0;
}

$delFlat = new FlatDelete();
$delFlat->deleteFlat($flatId, $addressId, $infoId);

header("Location: flatlist.php");

