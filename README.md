![](http://i.imgur.com/G0KQC7w.png)
## Youtube Search
> Bu class sayesinde **YoutubeAPİ v2** ile aramalarınızı kolayca yapabilirsiniz..


### Neleri arayabilirsiniz?
=============
1. Video
2. Playlist
3. Channel
4. Single Video
5. Populer Video ( Populer Video in Country )
7. more..



Nasıl Çalışır ?
=============

Sayfamıza `class.youtube.php`'ı dahil ettikten sonra sınıfımızı çalıştıralım.

    // REQUİRE
	require 'lib/class.youtube.php';
	
    // SINIF BAŞLATMA
	$youtube = new YoutubeSearch();

	## PLAYLIST ARAMA
	$data = $youtube->getPlaylistSearch("Eminem",10); // Anahtar Kelime , Limit (max 50)

	foreach ($data as $item) {
		// ÖRNEK GÖSTERİM
		echo "-> ".$item->title."<br>";

	}
    
    ## Video Search
	$data = $youtube->getVideoSearch("Rihanna - Diamonds",10); // Anahtar Kelime , Limit (max 50)

	foreach ($data as $item) {
		
		echo "-> ".$item->title."<br>";

	}


