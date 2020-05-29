<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SongCategory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->library('curl'); 
		$this->url_api = 'https://dev.mydiosing.com/mydio';
	}

	public function index()
	{
		$data_list_languange = $this->curl->simple_get($this->url_api.'/Language');

		$respones_list_languange = json_decode($data_list_languange, true);

		$data['list_language'] = $respones_list_languange;

		$navbar_back = true;
		$title = 'Home';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('song_category', compact('data'));
	}

	public function filter_song($keyword)
	{
		$param = [
			'type' => 'lang',
			'query' => $keyword,
			'offset' => 0,
			'limit' => 10
		];

		$data_songs = $this->curl->simple_get('https://mydiosing.com:8843/mydio/QuerySong?'.http_build_query($param));
		
		$respone_songs = json_decode($data_songs, true);

		$html = '';

		foreach ($respone_songs['array'] as $key => $value){

			if($key > 0){
				$border = 'style="border-top: solid 1px #d8d8d8;"';
			} else {
				$border = '';
			}

			$html .= '
			<div class="row py-2" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.$value['title'].'\', \''.$value['artist'].'\', \''.$value['poster'].'\')" '.$border.'>
                <div class="col-4">
                    <div style="width: 100%; height: 76px; background-image: url(\''.$value['poster'].'\'); background-position: top; background-size: cover; background-repeat: no-repeat; border-radius: 5px;">
                        <img class="play-icon" src="'.base_url('assets/images/play_video.png').'">
                    </div>
                </div>
                <div class="col-8 pl-0">
                    <div class="row">
                        <div class="col-12 title-artist">
                            <span class="title"><b>'.$value['title'].'</b></span>
                            <br/>
                            <span class="artist">'.$value['artist'].'</span>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 4px;">
                        <div class="col-4 pr-0">
                            <span class="align-middle" style="font-size: 12px;">
                                <img class="info-icon" src="'.base_url('assets/images/view.png').'">&nbsp;&nbsp;'.$value['view'].'
                            </span>                                
                        </div>
                        <div class="col-4 pr-0">
                            <span class="align-middle" style="font-size: 12px;">
                                <img class="info-icon" src="'.base_url('assets/images/love.png').'">&nbsp;&nbsp;'.$value['like'].'
                            </span>
                        </div>
                        <div class="col-4 pr-0">
                            <span class="align-middle" style="font-size: 12px;">
                                <img class="info-icon" src="'.base_url('assets/images/record.png').'">&nbsp;&nbsp;'.$value['rec'].'
                            </span>
                        </div>
                    </div>
                </div>
            </div>
			';
        }

        $return = [
        	'html' => $html,
        ];

        header('Content-Type: application/json');
    	echo json_encode($return);
	}
}