<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $bhs = null;
	var $url = null;

	public function __construct()
	{
		parent::__construct();
		
		// if (!$this->session->has_userdata('memberLogin')) {
		// 	redirect('login','refresh');
		// }
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->library('curl');
		$this->client = new \GuzzleHttp\Client(['verify' => false , 'http_errors' => false]);
		$this->url_api = 'https://dev.mydiosing.com/mydio'; // untuk dev, besok dicomment

		$this->load->model('M_general', 'general');
		$this->bhs = $this->uri->segment(1);
		if ($this->bhs=='en') {
             $this->lang->load($this->bhs, 'custom');
             $this->url = 'en';
		}else{
             $this->lang->load('id', 'custom');
             $this->bhs= 'id';
             $this->url= '';
         }
	}

	public function index()
	{
		$this->load->library('google'); 
		$linkOuthGoogle = $this->google->createAuthUrl();
		$headers =  getallheaders();
		$datasaver = false;
		foreach($headers as $key=>$val){
		    if(strtolower($key) == 'save-data' && $val == 'on'){
		        $datasaver = true;
		    }
		}
		$this->load->library('user_agent');
		$data['url'] = $this->url;
		// $data['berita'] = $this->general->recentNews()->row_array();
		$data['bahasa'] = $this->myDioLang('en', '');
		$data['mobile'] = ($this->agent->is_mobile() == true) ? true:false;
		$data['datasaver'] = $datasaver;

		// if (!$this->session->has_userdata('memberLogin')) {
		// 	$data['like_exist'] = 0;
		// } else {
		// 	$this->db->where('user_id', $this->session->userdata('userId'));
		// 	$this->db->or_where('ip_address', $this->input->ip_address());
		// 	$cekUserExist = $this->db->get('video_like')->num_rows();

		// 	if($cekUserExist > 0){
		// 		$data['like_exist'] = 1;
		// 	} else {
		// 		$data['like_exist'] = 0;
		// 	}
		// }

		$ipAddress = $this->input->ip_address();
		// $ipAddress = '114.124.201.112';
		
		// $param = [
		// 	'action' => 'today',
		// 	'remoteIpAddr' => $ipAddress
		// ];
		// $dataBannerSlider = $this->curl->simple_get(''.$this->url_api.'/Banner?'.http_build_query($param));
		// $data['banner_slider'] = json_decode($dataBannerSlider, true);

		$dataBannerSlider = $this->curl->simple_get(''.$this->url_api.'/Banner?action=today&remoteIpAddr='.$ipAddress.'');
		$data['banner_slider'] = json_decode($dataBannerSlider, true);

		// $this->load->library('mydio');
		
		// $featured = array(
		// 	'type' => 'featured',
		// 	'query' => '',
		// 	'offset' => 0,
		// 	'limit' => 10
		// );
		// $featured = $this->mydio->qsong($featured);
		
		// $newsong = array(
		// 	'type' => 'newsong',
		// 	'query' => '',
		// 	'offset' => 0,
		// 	'limit' => 10
		// );
		// $newsong = $this->mydio->qsong($newsong);
		
		// $mostrecent = array(
		// 	'type' => 'mostrecent',
		// 	'query' => '',
		// 	'offset' => 0,
		// 	'limit' => 10
		// );
		// $mostrecent = $this->mydio->qsong($mostrecent);
		
		// $karafie = array(
		// 	'type' => 'karafie',
		// 	'query' => '',
		// 	'offset' => 0,
		// 	'limit' => 12
		// );
		// $karafie = $this->mydio->song($karafie);
		
		// $karaclip = array(
		// 	'type' => 'karaclip',
		// 	'query' => '',
		// 	'offset' => 0,
		// 	'limit' => 12
		// );
		// $karaclip = $this->mydio->song($karaclip);
		
		// $this->output->cache(5);
		
		$this->load->view('header');
		$this->load->view('index', compact('data', 'linkOuthGoogle'));

		$showScrollTop = true;
		$this->load->view('footer', compact('showScrollTop'));
	}

	public function myDioLang($en, $id)
	{
		$data['en'] = $en;
		$data['id'] = $id;
		return $data;
	}

	public function news()
	{
		$lang = $this->uri->segment(1);
		if ($lang == 'news') {
			$lang = 'id';
		} else {
			$lang = $lang;
		}
		$data['title'] = $this->lang->line('News');
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/news', 'news');
		$data['featured'] = $this->general->newsFeatured($lang);
		$data['list'] = $this->general->newsListing($lang);
		$data['lang'] = $lang;
		
		// $this->output->cache(60);
		$this->load->view('news', $data);
	}

	public function all()
	{
		$this->load->library('mydio');
		$type = null;
		if ($this->bhs == 'en') {
			$type = $this->uri->segment(3);
		}else{
			$type = $this->uri->segment(2);
		}
		
		$param = array(
			'type' => $type,
			'query' => '',
			'offset' => 0,
			'limit' => 10
		);
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/all/karafie', 'all/karafie');
		$data['type'] = $type;
		$data['data'] = $this->mydio->song($param);
		
		// $this->output->cache(60);
		$this->load->view('karafie', $data);
	}

	public function karafie()
	{
		$this->load->library('mydio');
		$no = $this->input->post('no', true);
		$type = $this->input->post('type', true);
		$param = array(
			'type' => $type,
			'query' => '',
			'offset' => $no,
			'limit' => 10
		);
		$data = $this->mydio->song($param);
		$html = '';
		foreach ($data['array'] as $key => $value) {
			$html.= '<div class="col-md-3 col-xs-6 border-carafie" 
			onClick="mydiosingplay(\''.$value['urlM3U8'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\')">
				<div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="dummy"></div>
                        <div class="in" style="background-image: url('.$value['urlPoster'].')">
                        </div>
                    </div>
                    <div class="row margin-title">
                        <div class="col-md-12">
                            <p class="title">'.$value['title'].'</p>
                            <span class="like"><i class="fa fa-eye"></i> '.$value['countListen'].'</span> <span class="like"><i class="fa fa-heart"></i> '.$value['countLike'].'</span>
                        </div>
                    </div>
                </div>
			</div>';
		}
		echo $html;
	}

	public function video()
	{
		$this->load->library('mydio');
		$type = null;
		if ($this->bhs == 'en') {
			$type = $this->uri->segment(3);
		}else{
			$type = $this->uri->segment(2);
		}
		$name = $type;
		switch ($type) {
			case 'trending':
				$type = 'mostrecent';
				break;
			case 'recommended':
				$type = 'featured';
				break;
			default:
				# code...
				break;
		}
		$trending = array(
			'type' => $type,
			'query' => '',
			'offset' => 0,
			'limit' => 10
		);
		$data['type'] = $name;
		$data['typeparam'] = $type;
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/all/recommended', 'all/recommended');
		$data['data'] = $this->mydio->qsong($trending);
		
		// $this->output->cache(60);
		$this->load->view('trending', $data);
	}

	public function lazyRecord()
	{
		$this->load->library('mydio');
		
		$type = $this->uri->segment(2);
		$type_origin = $this->uri->segment(2);

		$limit = $this->input->get('limit');
		$start = $this->input->get('start');
		
		$param = array(
			'type' => $type,
			'query' => '',
			'offset' => $start,
			'limit' => $limit
		);
		
		$record = $this->mydio->song($param);

		$break_after = 3;
		$break_after_second = 9;
		$counter = 0;
		$html = '';
		foreach ($record['array'] as $key => $value) {
			
			if ($counter % $break_after == 0) {
				if ($counter == 0) {
					$class_item = "gallery";
					$html.='<div class="gallery">';
				} else {
					if ($counter % $break_after_second == 0) {
						$class_item = "gallery3";
						$html.='<div class="gallery3">';
					} else {
						$class_item = "gallery2";
						$html.='<div class="gallery2">';
					}
				}
			}

			$number = ($counter % $break_after) + 1;
				
			$html .='
			<figure class="'.$class_item.'__item--'.$number.' data-'.$type_origin.'" onClick="mydiosingplay(\''.$value['urlM3U8'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\')">
				<img src="'.$value['urlPoster'].'" class="gallery__img" songnumber="'.$type.'-'.$key.'">
			</figure>
			<p class="'.$class_item.'__icon--'.$number.'">
				<i class="fa fa-video-camera text-white" aria-hidden="true"></i>
			</p>
			';

			if ($counter % $break_after == ($break_after-1)) {
				$html.='</div>';
			}

			++$counter;
		}

		if ((($counter-1) % $break_after) != ($break_after-1)) {
			$html.='</div>';
		}

		echo $html;
	}

	public function lazyClip()
	{
		$this->load->library('mydio');
		
		$type = $this->uri->segment(2);
		$type_origin = $this->uri->segment(2);

		$limit = $this->input->get('limit');
		$start = $this->input->get('start');

		$param = array(
			'type' => $type,
			'query' => '',
			'offset' => $start,
			'limit' => $limit
		);

		$record = $this->mydio->song($param);

		$break_after = 3;
		$break_after_second = 9;
		$counter = 0;
		$html = '';
		foreach ($record['array'] as $key => $value) {
			if ($counter % $break_after == 0) {
				if ($counter == 0) {
					$class_item = "gallery";
					$html.='<div class="gallery">';
				} else {
					if ($counter % $break_after_second == 0) {
						$class_item = "gallery3";
						$html.='<div class="gallery3">';
					} else {
						$class_item = "gallery2";
						$html.='<div class="gallery2">';
					}
				}
			}

			if($value['urlRecordingAudio'] != null){
				$uri = $value['urlRecordingAudio'];
			}else{
				$uri = $value['urlM3U8'];
			}

			$number = ($counter % $break_after) + 1;
			
			$html .='
			<figure class="'.$class_item.'__item--'.$number.' data-'.$type_origin.'" onClick="mydioclip(\''.$uri.'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\', \''.$value['recordingId'].'\', \''.$value['urlPoster'].'\')" songnumber="'.$type.'-'.$key.'">
				<img src="'.$value['urlPoster'].'" class="gallery__img">
			</figure>
			<p class="'.$class_item.'__icon--'.$number.'">
				<i class="fa fa-video-camera text-white" aria-hidden="true"></i>
			</p>
			';

			if ($counter % $break_after == ($break_after-1)) {
				$html.='</div>';
			}

			++$counter;
		}

		if ((($counter-1) % $break_after) != ($break_after-1)) {
			$html.='</div>';
		}

		echo $html;
	}

	public function lazy()
	{
		$type = $this->uri->segment(2);
		$type_origin = $this->uri->segment(2);

		// $get_last_number = $this->input->get('last_items');
		// if($get_last_number){
		// 	$offset = $get_last_number;
		// } else {
		// 	$offset = 0;
		// }

		$limit = $this->input->get('limit');
		$start = $this->input->get('start');

		switch ($type) {
			case 'trending':
				$type = 'mostrecent';
				break;
			case 'recommended':
				$type = 'featured';
				break;
			case 'all':
				$type = 'newsong';
				break;
			default:
				# code...
				break;
		}

		// $this->load->library('mydio');

		$ipAddress = $this->input->ip_address();
		// $ipAddress = '114.124.201.112';

		// $recomeded = array(
		// 	'type' => $type,
		// 	'query' => '',
		// 	'offset' => $offset,
		// 	'limit' => 10,
		// 	'remoteIpAddr' => $ipAddress
		// );

		// $recomended = $this->mydio->qsong($recomeded);

		$data = $this->curl->simple_get(''.$this->url_api.'/QuerySong?type='.$type.'&query=&offset='.$start.'&limit='.$limit.'&remoteIpAddr='.$ipAddress.'');
		$recomended = json_decode($data, true);
		
		$html = '';
		foreach ($recomended['array'] as $key => $value){
			// $hide = '';
			// if ($key == 4) {
			// 	$hide = 'hide';
			// }

			if($key > 0){
				$border = 'style="border-top: solid 1px #d8d8d8;"';
			} else {
				$border = '';
			}

			// $this->db->where('video_id', $value['songId']);
			// $countLikeDatabase = $this->db->get('video_like')->num_rows();

			// if($countLikeDatabase > 0){
			// 	$likeNumber = ($value['like']+$countLikeDatabase);
			// } else {
			// 	$likeNumber = $value['like'];
			// }

			$exist_liked = 0;

           	// if ($this->session->has_userdata('memberLogin')) {
            //     $exist_liked = 0;
            // } else {
            //     $reqTime = date('YmdHis');

            //     $params = [
            //         'type' => 'status',
            //         'id' => $value['songId'],
            //         'sessionId' => $this->session->userdata('sessionId'),
            //         'reqTime' => $reqTime,
            //         'sig' => genSignature($reqTime, $this->session->userdata('salt'))
            //     ];

            //     $api_likestatus = $this->curl->simple_get(''.$this->url_api.'/Like?' . http_build_query($params));

            //     $likeStatus = json_decode($api_likestatus, true);

            //     if($likeStatus['islike'] == 1){
            //         $exist_liked = 1;
            //     } else {
            //         $exist_liked = 0;
            //     }
            // }

			$html .= '
			<div class="row py-2 data-'.$type_origin.'" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\', \''.$value['artist'].'\', \''.$value['poster'].'\', \''.$value['song'].'\', \''.$value['songId'].'\')" '.$border.' video-liked="'.$exist_liked.'" songnumber="'.$type.'-'.$key.'">
				<div class="col-4">
					<img class="poster-video" src="'.$value['poster'].'" />
					<img id="play-icon-'.$value['songId'].'" class="play-icon" src="'.base_url('assets/images/play_video.svg').'">
				</div>
				<div class="col-8 pl-0">
					<div class="row">
						<div class="col-12 title-artist">
							<span class="title">'.$value['title'].'</span>
							<br/>
							<span class="artist">'.$value['artist'].'</span>
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-4 pr-0">
							<span class="align-middle" style="font-size: 12px;">
								<img class="info-icon" src="'.base_url('assets/images/telkom/ic_view.svg').'">&nbsp;&nbsp;'.$value['view'].'
							</span>                                
						</div>
						<div class="col-4 pr-0">
							<span class="align-middle" style="font-size: 12px;">
								<img class="info-icon" src="'.base_url('assets/images/telkom/ic_love.svg').'">&nbsp;&nbsp;<span id="like-'.$value['songId'].'">'.$value['like'].'</span>
							</span>
						</div>
						<div class="col-4 pr-0">
							<span class="align-middle" style="font-size: 12px;">
								<img class="info-icon" src="'.base_url('assets/images/telkom/ic_recoding_view.svg').'">&nbsp;&nbsp;'.$value['rec'].'
							</span>
						</div>
					</div>
				</div>
			</div>
			';

            // $html.= '
            // <div class="col-md-3 col-6 border-carafie '.$hide.'" onClick="
            //                     mydiolimit(\''.$value['urlHls'].'\', \''.$value['title'].'\', \''.$value['artist'].'\', \''.$value['poster'].'\')" data-url="'.$value['urlHls'].'" data-title="'.$value['title'].'" data-artis="'.$value['artist'].'">
            //     <div class="row">
            //         <div class="col-md-12 no-padding">
            //             <div class="dummy"></div>
            //             <div class="in" style="background-image: url(\''.$value['poster'].'\')">
            //             </div>
            //         </div>
            //         <div class="row margin-title">
            //             <div class="col-md-12">
            //                 <p class="title">'.$value['title'].'</p>
            //                 <span class="like">'.$value['artist'].'</span>
            //             </div>
            //         </div>
            //     </div>
            // </div>';
        }
		
		echo $html;
	}

	public function trending()
	{
		$this->load->library('mydio');
		$no = $this->input->post('no', true);
		$type = $this->input->post('type', true);
		$param = array(
			'type' => $type,
			'query' => '',
			'offset' => $no,
			'limit' => 10
		);
		$data = $this->mydio->song($param);
		$html = '';
		foreach ($data['array'] as $key => $value) {
			$html.= '
			<div class="col-md-3 col-xs-6 border-carafie" onClick="
                    mydiolimit(\''.$value['song'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\')" data-url="'.$value['urlHls'].'" data-title="'.$value['title'].'" data-artis="'.$value['artist'].'">
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="dummy"></div>
                        <div class="in" style="background-image: url("'.$value['poster'].'")">
                        </div>
                    </div>
                    <div class="row margin-title">
                        <div class="col-md-12">
                            <p class="title">'.$value['title'].'</p>
                            <span class="like">'.$value['artist'].'</span>
                        </div>
                    </div>
                </div>
            </div>';
		}
		echo $html;
	}
	//statis page
	public function about()
	{
		$data['title'] = $this->lang->line('About');
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/about', 'about');
		
		// $this->output->cache(60);
		$this->load->view('about', $data);
	}
	public function tos()
	{
		$data['title'] = $this->lang->line('Terms Of Service');
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/tos', 'tos');
		
		// $this->output->cache(60);
		$this->load->view('tos', $data);
	}
	public function privacy()
	{
		$data['title'] = $this->lang->line('Privacy');
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/privacy', 'privacy');
		
		// $this->output->cache(60);
		$this->load->view('privacy', $data);
	}
	public function contact()
	{
		$data['title'] = $this->lang->line('Contact Us');
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en/contact', 'contact');
		// $this->output->cache(60);
		$this->load->view('contact', $data);
	}
	//end of statis page
	public function getNews()
	{
		$lang = $this->uri->segment(3);
		$offset = $this->input->post('no', TRUE);
		$data = $this->general->newsListingAjax($lang, $offset);
		$html = '';
		$key = 0;
		foreach ($data as $key => $value) {
			$html .= '<div class="single">
                            <div class="row">
                            <div class="col-md-4">
			                    <div class="post-img">
			                        <a href="#">
			                            <img src="'.base_url('plugins/kcfinder/upload/images/'.$value['thumbnail']).'" class="img-fluid" alt="" style="border-radius:4px;">
			                        </a>
			                    </div>
                			</div>
                                <div class="col-md-8">
                                    <div class="post-body">
                                        <h2 class="post-title-list"><a href="'.site_url($value['link']).'">'.$value['judul'].'</a></h2>
                                    </div>
                                    <div class="post-preview">';
							        $trimstring = '';
							         if (strlen($value['artikel']) > 300) {
							          $trimstring = substr($value['artikel'], 0, 300).'....';
							        }else{
							          $trimstring = $value['artikel'];
							        }
							        $html .= $trimstring.'</div>
						                <hr>
                			<div class="news-date">'.date_format(date_create($value['created_at']), 'j M Y').' || '.$value['author'].'
			                </div>
			             	</div>
            	</div>
            </div>';
		}

		echo json_encode(array('data'=>$html, 'key'=>$key));
	}
	public function detailNews()
	{	
		$id = $this->uri->segment(2);
		$con = array(
			'id' => $id
		);
		$data['bahasa'] = $this->myDioLang('en', '');
		$data['url'] = $this->url;
		$data['berita'] = $this->general->edit('z_artikel', $con)->row_array();
		$data['title'] = $data['berita']['judul'];
		// $this->output->cache(60);
		$this->load->view('detailnews', $data);
	}
	
	public function sendEmail()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->library('user_agent');
			$this->session->set_flashdata('pesan', 'please fill the required form');
			redirect($this->agent->referrer(),'refresh');
		} else {
			$name = $this->input->post('name', TRUE);
			$email = $this->input->post('email', TRUE);
			$subject = $this->input->post('subject', TRUE);
			$message = $this->input->post('message', TRUE);
			$this->load->library('email');
			
			$this->email->from($email, $name);
			$this->email->to('arisudarma@gmail.com');
			//$this->email->to('indra.putra@imputra.com');
			
			$this->email->subject($subject);
			$this->email->message($message);
			
			if ($this->email->send()) {
				$this->load->library('user_agent');
				$this->session->set_flashdata('pesan', 'Your email was successfully sent');
				redirect($this->agent->referrer(),'refresh');
			}
			
			//echo $this->email->print_debugger();
		}
	}
	
	public function youtube()
	{
		$data['title'] = 'YouTube Video';
		$data['bahasa'] = $this->myDioLang('en', '');
		$data['url'] = $this->url;
		$data['type'] = 'youTube';
		$data['youtubes'] = $this->general->youtube()->result_array();
		// $this->output->cache(60);
		$this->load->view('youtube', $data);
	}

	public function recordClip()
	{
		$this->load->library('mydio');
		$param = array(
			'type' => 'clips',
			'id' => $this->input->post('recordId', TRUE)
		);
		$data = $this->mydio->song($param);
		echo json_encode($data);
	}

	public function search()
	{	
		$data['query'] = $this->input->get('query', TRUE);
		$data['type'] = $this->input->get('type', TRUE);
		$data['url'] = $this->url;
		$data['bahasa'] = $this->myDioLang('en', '');
		// $this->output->cache(60);
		$this->load->view('search', $data);
	}

	public function lazySongs()
	{
		$this->load->library('mydio');
		$param = array(
			'type' => $this->input->get('type', TRUE),
			'query' => $this->input->get('query', TRUE),
			'offset' => $this->input->get('no', TRUE),
			'limit' => 10
		);
		$recomended = $this->mydio->qsong($param);
		$html = '';
		foreach ($recomended['array'] as $key => $value){
			$hide = '';
			if (!isset($value['poster']) || $value['poster']=='') {
				$value['poster'] = base_url('uploads/default.png');
			}
            $html.= '
            <div class="col-md-3 col-6 border-carafie" onClick="
                                mydiolimit(\''.$value['urlHls'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\', \''.$value['artist'].'\')" data-url="'.$value['urlHls'].'" data-title="'.$value['title'].'" data-artis="'.$value['artist'].'">
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="dummy"></div>
                        <div class="in" style="background-image: url(\''.$value['poster'].'\')">
                        </div>
                    </div>
                    <div class="row margin-title">
                        <div class="col-md-12">
                            <p class="title">'.$value['title'].'</p>
                            <span class="like">'.$value['artist'].'</span>
                        </div>
                    </div>
                </div>
            </div>';
        }
		if ($html != '') {
			echo $html;
		}else{
			echo "There are no results for ".$this->input->get('query', TRUE);
		}
	}

	public function console()
	{
		$this->load->library('mydio');
		$param = array(
			'type' => $this->input->get('type', TRUE),
			'query' => $this->input->get('query', TRUE),
			'offset' => $this->input->get('no', TRUE),
			'limit' => 10
		);
		$recomended = $this->mydio->qsong($param);
		$key = 0;
		$html = '';
		foreach ($recomended['array'] as $key => $value){
			$hide = '';
			if (!isset($value['poster']) || $value['poster']=='') {
				$value['poster'] = base_url('uploads/default.png');
			}
            $html.= '
            <div class="col-md-3 col-6 border-carafie" onClick="mydiolimit(\''.$value['urlHls'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value['title']).'\', \''.$value['artist'].'\')" data-url="'.$value['urlHls'].'" data-title="'.$value['title'].'" data-artis="'.$value['artist'].'">
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="dummy"></div>
                        <div class="in" style="background-image: url(\''.$value['poster'].'\')">
                        </div>
                    </div>
                    <div class="row margin-title">
                        <div class="col-md-12">
                            <p class="title">'.$value['title'].'</p>
                            <span class="like">'.$value['artist'].'</span>
                        </div>
                    </div>
                </div>
            </div>';
        }
		echo json_encode(array('data'=>$html, 'key' => $key));
	}

	public function lazyUsers()
	{
		$this->load->library('mydio');
		$param = array(
			'type' => 'name',
			'query' => $this->input->get('query', TRUE),
			'offset' => 0,
			'limit' => 5
		);
		$recomended = $this->mydio->users($param);
		$html = '';
		foreach ($recomended['array'] as $key => $value){
			$avatar = null;
			if (isset($value['facebookId']) && $value['facebookId'] != '') {
				$avatar = 'https://graph.facebook.com/'.$value['facebookId'].'/picture?type=large';	
			}elseif(isset($value['googleId']) && $value['googleId'] != '') {
				$avatar = 'https://plus.google.com/s2/photos/profile/'.$value['googleId'].'?sz=100';
			}else{
				if (isset($value['urlPP']) && $value['urlPP'] != '') {
					$avatar = $value['urlPP'];
				} elseif(isset($value['urlPP']) && $value['urlPP'] == ''){
					$avatar = base_url('uploads/default.png');
				}else{
					$avatar = base_url('uploads/default.png');
				}
			}
			$hide = '';
			if ($key == 4) {
				$hide = 'hide';
			}
	            $html.= '<div class="col-md-3 col-6 border-carafie '.$hide.'">
	                <div class="row">
	                    <div class="col-md-12 no-padding">
	                        <div class="dummy"></div>
	                        <div class="in" style="background-image: url(\''.$avatar.'\')">
	                        </div>
	                    </div>
	                    <div class="row margin-title">
	                        <div class="col-md-12">
	                            <p class="title">'.$value['name'].'</p>
	                        </div>
	                    </div>
	                </div>
	            </div>';
        }
       if ($html == '') {
			$html = '<center><p>Tidak ditemukan nama '.$this->input->get('query', true).' pada pengguna</p></center>';
		}
		echo $html;
	}

	public function lazyRecordings()
	{
		$this->load->library('mydio');
		$param = array(
			'type' => 'karaclip',
			'query' => '',
			'offset' => 0,
			'limit' => 10
		);
		$data = $this->mydio->song($param);
		$res = $this->customSearch($this->input->get('query', true), $data['array']);
		$value = $data['array'];
		$html = '';
		if (count($res) > 0 || $res != null ) {
			for($i = 0; $i<count($res); $i++)
			{
				$html.= '<div class="col-md-3 col-xs-6 border-carafie" 
				onClick="mydiosingplay(\''.$value[$res[$i]]['urlM3U8'].'\', \''.str_replace(array("\r\n","'"), array(" ","`"), $value[$res[$i]]['title']).'\')">
					<div class="row">
	                    <div class="col-md-12 no-padding">
	                        <div class="dummy"></div>
	                        <div class="in" style="background-image: url('.$value[$res[$i]]['urlPoster'].')">
	                        </div>
	                    </div>
	                    <div class="row margin-title">
	                        <div class="col-md-12">
	                            <p class="title">'.str_replace(array("\r\n","'"), array(" ","`"), $value[$res[$i]]['title']).'</p>
	                            <span class="like"><i class="fa fa-headphones"></i> '.$value[$res[$i]]['countListen'].'</span> <span class="like"><i class="fa fa-heart"></i> '.$value[$res[$i]]['countLike'].'</span>
	                        </div>
	                    </div>
	                </div>
				</div>';
			}
		}
		if ($html == '') {
			$html = '<center><p>Tidak ditemukan '.$this->input->get('query', true).' pada recording</p></center>';
		}
		echo $html;
	}

	public function customSearch($query, $data)
	{
		$dtkey= array();
		foreach ($data as $key => $value) {
			if( stristr( $value['title'], $query ) ){
            $dtkey[] = $key;
        	}
		}
		return $dtkey;
	}

	public function installApp()
	{
		$file_path = base_url('uploads');
		$file_name = 'app-debug.apk';
		
		header('Content-Type: application/vnd.android.package-archive');
		header("Content-length: " . filesize($file_path));
		header('Content-Disposition: attachment; filename="' . $file_name . '"');
		ob_end_flush();
		readfile($file_path);
		return true;
	}

	public function likevideo(){
		// if ($this->session->has_userdata('memberLogin')) {
		// 	$this->db->where('user_id', $this->input->post('userId'));
		// 	$fielduser = "user_id";
		// } else {			
		// 	$this->db->where('ip_address', $this->input->post('userId'));
		// 	$fielduser = "ip_address";
		// }

		// $this->db->where('video_id', $this->input->post('videoId'));
		// $checkUser = $this->db->get('video_like')->num_rows();

		// if($checkUser < 1){

		// 	$data = array(
		// 	    'video_id' => $this->input->post('videoId'),
		// 	    ''.$fielduser.'' => $this->input->post('userId'),
		// 	    'created_at' => date('Y-m-d H:i:s')
		// 	);

		// 	$this->db->insert('video_like', $data);

		// 	$status = 200;
		// 	$message = 'Video successfully liked';
		// } else {
		// 	$status = 400;
		// 	$message = 'An Error Has Occurred With Your Internet Connection';
		// }

		// $this->db->where('video_id', $this->input->post('videoId'));
		// $countLikeDatabase = $this->db->get('video_like')->num_rows();


		$reqTime = date('YmdHis');

		$status = $this->input->post('status');

		if($status == "0"){
			$params = [
				'type' => 'recording',
				'id' => $this->input->post('videoId'),
				'sessionId' => $this->session->userdata('sessionId'),
				'reqTime' => $reqTime,
				'sig' => genSignature($reqTime, $this->session->userdata('salt'))
			];
		}else{
				$params = [
					'type' => 'recording',
					'unlike' => '1',
					'id' => $this->input->post('videoId'),
					'sessionId' => $this->session->userdata('sessionId'),
					'reqTime' => $reqTime,
					'sig' => genSignature($reqTime, $this->session->userdata('salt'))
				];
		}

		$api_like = $this->curl->simple_get(''.$this->url_api.'/Like?' . http_build_query($params));

		$like = json_decode($api_like, true);

		if(!empty($like)){
			if($like['countLike'] == -1){
				$status = 400;
				$message = "Unsuccessfully liked";
			} else {
				$status = 200;
				$message = "Successfully liked";
			}
		} else {
			$status = 400;
			$message = "Unsuccessfully liked";
		}

		$params_song = [
			'type' => 'extrainfo',
			'songId' => $this->input->post('videoId'),
			'sessionId' => $this->session->userdata('sessionId')
		];

		$api_song_extrainfo = $this->curl->simple_get(''.$this->url_api.'/QuerySong?' . http_build_query($params_song));

		$song_extrainfo = json_decode($api_song_extrainfo, true);

		$return = [
			"status" => $status,
			"message" => $message,
			"likeFromDatabase" => $song_extrainfo['countLike']
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}

	public function checkLikeVideo()
	{
		// if ($this->session->has_userdata('memberLogin')) {
		// 	$this->db->where('user_id', $this->session->userdata('userId'));			
		// } else {
		// 	$this->db->where('ip_address', $this->input->ip_address());
		// }

		// $this->db->where('video_id', $this->input->post('videoID'));
		// $checkUser = $this->db->get('video_like')->num_rows();

		// if($checkUser > 0){
		// 	$exist = true;
		// } else {
		// 	$exist = false;
		// }

		// $return = [
		// 	'exist' => $exist
		// ];

		if ($this->session->has_userdata('memberLogin')) {
            $status_login = "sudah";
        } else {
            $status_login = "belum";
        }

		$reqTime = date('YmdHis');

		$params = [
			'type' => 'status',
			'id' => $this->input->post('videoID'),
			'sessionId' => $this->session->userdata('sessionId'),
			'reqTime' => $reqTime,
			'sig' => genSignature($reqTime, $this->session->userdata('salt'))
		];

		$api_likestatus = $this->curl->simple_get(''.$this->url_api.'/Like?' . http_build_query($params));

		$likeStatus = json_decode($api_likestatus, true);

		if($likeStatus['islike'] == 1){
			$exist = true;
		} else {
			$exist = false;
		}

		$return = [
			'exist' => $exist,
			'status_login' => $status_login
		];

		header('Content-Type: application/json');
    	echo json_encode($return);
	}
}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */