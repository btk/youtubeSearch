<?php 

// REQUİRE
require 'class.YoutubeSearch.php';

// SINIF BAŞLATMA
$youtube = new YoutubeSearch();

## PLAYLIST ARAMA
$data = $youtube->getPlaylistSearch("Eminem",10); // Anahtar Kelime , Limit (max 50)

foreach ($data as $item) {
    // ÖRNEK GÖSTERİM
    echo "-> ".$item->title."<br>";

}

## VIDEO ARAMA
$data = $youtube->getVideoSearch("Rihanna - Diamonds",10); // Anahtar Kelime , Limit (max 50)

foreach ($data as $item) {
    // ÖRNEK GÖSTERİM
    echo "-> ".$item->title."<br>";

}

## KANAL ARAMA
$data = $youtube->getChannelSearch("Michael Jackson",3);

// Json Çıktısı
var_dump($data);

## VİDEO BİLGİLERİ ÇEKME
$data = $youtube->getVideoInformation("aDWfF6PSKWM"); // video id'si

// Json Çıktısı
var_dump($data);
