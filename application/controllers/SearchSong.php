<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SearchSong extends CI_Controller {
	
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
		$keyword = $this->input->get('keyword');
		
		$param = [
			'type' => 'title',
			'query' => $keyword,
			'offset' => 0,
			'limit' => 10,
		];

		$data = $this->curl->simple_get($this->url_api.'/QuerySong?'.http_build_query($param));

		$respones = json_decode($data, true);

		$navbar_back = true;
		$title = 'Back';
		$this->load->view('header', compact('navbar_back','title'));
		$this->load->view('search_songs', compact('respones','keyword'));
	}

	public function search_song()
	{
		$param = [
			'type' => 'title',
			'query' => $this->input->post('keyword'),
			'offset' => 0,
			'limit' => 10,
		];

		$data = $this->curl->simple_get($this->url_api.'/QuerySong?'.http_build_query($param));

		$respones = json_decode($data, true);

		$html = '<p>Search result for you : </p>';

		foreach ($respones['array'] as $value){

			if($key > 0){
				$border = 'style="border-top: solid 1px #d8d8d8;"';
			} else {
				$border = '';
			}

			$html .= '
			<div class="row py-2" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.addslashes($value['title']).'\', \''.addslashes($value['artist']).'\', \''.$value['poster'].'\')" '.$border.'>
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
	
	public function search_song_suggest()
	{
		$param = [
			'type' => 'litetitle',
			'query' => $this->input->post('keyword'),
			'offset' => 0,
			'limit' => 10,
		];

		$data = $this->curl->simple_get($this->url_api.'/QuerySong?'.http_build_query($param));

		$respones = json_decode($data, true);
		
		$artists = [];
		foreach ($respones['array'] as $a) {
			$artists[] = $a['artist'];
		}
		
		$artists_uniq = array_unique($artists);

		$html = '<div class="row">';

		foreach ($artists_uniq as $value){

			if($key > 0){
				$border = 'style="border-top: solid 1px #d8d8d8;"';
			} else {
				$border = '';
			}
			
			$html .= '
			<div class="artist-suggest col-12 py-3 border-top" key-word="'.addslashes(str_replace(' ', '+', $value)).'" return false;" '.$border.'>
				<span>'.addslashes($value).'</span>
			</div>
			';
        }
		
		$html .= '</div>';

        $return = [
        	'html' => $html,
        ];

        header('Content-Type: application/json');
    	echo json_encode($return);
	}
}