<?php 

/**
* 
*
* youtube api v2.1 GDATA
*
*
*/


class YoutubeSearch
{	
	/*
	*
	* Special elements 
	*
	*/ 
	
	private  $getPlaylist 	= "https://gdata.youtube.com/feeds/api/playlists/snippets";

	private  $getVideo	  	= "https://gdata.youtube.com/feeds/api/videos";

	private  $getVideos   	= "https://gdata.youtube.com/feeds/api/videos";

	private  $getMostSearch = "https://gdata.youtube.com/feeds/api/standardfeeds";

	private  $getChannel	= "https://gdata.youtube.com/feeds/api/channels";

	private  $version	  	= "2";

	private  $type	  	  	= "jsonc";

	private  $pageUp		= 10;

	function __construct()
	{
		if(!empty(intval(@$_GET["s"]))){
			
			$this->paginate = $_GET["s"];

			if ($this->paginate < 1) {
				
				$this->paginate = 1;
			
			} else {
				
				$this->paginate = $this->paginate * $this->pageUp;

			}
			
		}else{
			
			$this->paginate = 1;
		
		}
	}

	public function getPlaylistSearch($q,$l=10){

		
		$json = $this->get($this->getPlaylist,$q,$l);
		
		$this->items = array();

		foreach ($json->data->items as $key) {
			
			$this->items[] = $key;

		}

		return $this->items;

	}

	public function getVideoInformation($q)
	{
		$json = $this->post($this->getVideo,$q);

		return $json->data;
	}

	public function getVideoSearch($q = "Youtube",$l = 10,$s = 1)
	{
		$c = false;
		if (!$c == false) {$this->category = "&category=".$c;}else{$this->category = null;}

		$json = $this->get($this->getVideos,$q,$l);
		
		$this->items = array();

		foreach ($json->data->items as $key) {
			
			$this->items[] = $key;

		}

		return $this->items;
	}

	public function getChannelSearch($q,$l=10){

		// type change

		$this->type = "json";

		return $this->get($this->getChannel,$q,$l);
		
		$this->items = array();

		foreach ($json->feed->entry as $key) {
			
			$this->items[] = $key;

		}

		return $this->items;

	}

	public function get($url,$q = false,$limit = false)
	{
		if ($url) {
			$this->url = $url;
		}
		if ($q){
			$this->q = "?q=".$this->getEditQuery($q);

			$this->url .= $this->q;
		}
		if($limit){
			$this->limit = "&max-results=".$limit;

			$this->url .= $this->limit;
		}
		
		$this->url .= "&start-index=".$this->paginate;

		$this->url .= "&v=".$this->version;

		$this->url .= "&alt=".$this->type;
		
		$json = file_get_contents($this->url);

		$json = json_decode($json);

		return $json;
	}

	public function post($url,$q = false,$v = 2)
	{
		if ($url) {
			$this->url = $url;
		}
		if ($q){
			$this->q = "/".$q;

			$this->url .= $this->getEditQuery($q);
		}
		if($v){
			$this->v = "?v=".$v;

			$this->url .= $this->v;
		}
		

		$this->url .= "&alt=jsonc";
		
		$json = file_get_contents($this->url);

		$json = json_decode($json);

		return $json;
	}

	public function getEditQuery($text)
	{
		$text = str_replace(" ", "+", $text);

		return $text;
	}

	
}
