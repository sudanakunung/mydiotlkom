<?php //error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="<?php echo base_url('favicon.png')?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('favicon.png')?>" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- For google login -->
    <!-- BEGIN Pre-requisites -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
    </script>
    <!-- <script src="https://apis.google.com/js/client:platform.js?onload=start" async defer>
    </script>
    <script>
    function start() {
      gapi.load('auth2', function() {
        auth2 = gapi.auth2.init({
          client_id: '330389880017-bvil48vmvj9ev4murcfp308ak6ijpm98.apps.googleusercontent.com',
          // Scopes to request in addition to 'profile' and 'email'
          //scope: 'additional_scope'
        });
      });
    }
    </script> -->

    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    <!-- END Pre-requisites -->
    <link rel="manifest" href="<?= base_url('/'); ?>manifest.json">
    <title>
        <?php echo (isset($title) || isset($custom_title)) ? $title : 'MYDIO Sing'; ?>
    </title>
    <!-- assets -->
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('home/');?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('home/');?>css/js-offcanvas.css">
    <!-- <link href="https://vjs.zencdn.net/6.10.1/video-js.css" rel="stylesheet"> -->
    <link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets'); ?>/css/videojs-stop-button.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/videojs-overlay/1.1.4/videojs-overlay.css">
    <link rel="stylesheet" href="<?php echo base_url('home/');?>css/index.css">
    <link rel="stylesheet" href="<?php echo base_url('home/');?>css/normalize.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/owl.theme.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url('home/');?>css/styles.css">
    
    <link rel="shortcut icon" href="<?= base_url('assets/pwa_icons/icon-192x192.png'); ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/pwa_icons/icon-192x192.png'); ?>">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script>
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-117334365-4', 'auto');
        ga('send', 'pageview');
        </script>

<!-- GTranslate: https://gtranslate.io/ -->
    <style type="text/css">
        #goog-gt-tt {
          display: none !important;
        }
        
        .goog-te-banner-frame {
          display: none !important;
        }
        
        .goog-te-menu-value:hover {
          text-decoration: none !important;
        }
        
        .goog-te-gadget-icon {
          background-image: url(//gtranslate.net/flags/gt_logo_19x19.gif) !important;
            background-position: 0 0 !important;
          }
          .separator {
            font-size: 12px;
            display: flex;
            align-items: center;
            text-align: center;
          }
          .separator::before, .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
          }
          .separator::before {
            margin-right: .75em;
          }
          .separator::after {
            margin-left: .75em;
        }
        
        .poppins {
          font-family: 'Poppins', sans-serif;
        }
        
        #exampleModal15.in {
          opacity: 0.9;
        }

        .popover-body{
            color: #212563;
        }
        .vjs-poster{
          background-size: cover;
          border-radius:.3rem
        }
        </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?= base_url('home'); ?>/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/custom.css">

</head>

<!-- <body style="background: #9699a0"> -->
  <body>
    <?php
    if(!isset($hide_navbar)){ ?>
        <!-- <section class="bg-black d-md-none" style="<?= $show_navbar; ?> position: fixed;z-index: 99;width: 100%;"> -->

        <section class="d-md-none" style="<?= $show_navbar; ?> position: fixed;z-index: 99; width: 100%;">
          
          <!-- <div class="nav__color-strip"></div> -->
          
          <!-- <div class="container-fluid grid-contain"></div> -->
          <!-- <nav class="navbar navbar-dark" style="display: block;padding: 4px 0px;background-color: rgba(0,0,0, 0)!important"> -->

          <nav class="navbar navbar-dark" style="display: block; padding: 8px 0px; background:rgb(208, 74, 58)">
          <div style="display:flex;justify-content:space-between">
              <?php
              if(!isset($navbar_back) || isset($show_menu)){ ?>
                  <button class="navbar-toggler js-offcanvas-trigger" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" data-offcanvas-trigger="off-canvas" style="border-color: transparent !important;min-width:60px">
                      <!-- <span class="navbar-toggler-icon"></span> -->
                      <img src="<?= base_url('assets/images/menu.png'); ?>" class="img-fluid" style="height: 30px; width: auto;">
                      <?php 
                      if(isset($custom_title)){ ?>
                        &nbsp;<span class="text-white align-middle" style="font-size: 18px;"><?= $title; ?></span>
                      <?php
                      }
                      ?>
                  </button>
                
                  <?php
                  if(!isset($show_menu)){ ?>
                    <div class="input-group search-box mr-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text search-icon" id="basic-addon1">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                      </div>
                      
                      <!-- <input onclick="window.location = '<?= base_url('song-by-search') ?>';" type="text" class="form-control search" placeholder="Search Artist or Song's Title..." aria-describedby="basic-addon1" readonly="true" style="background: transparent;"> -->

                      <input id="search-input" type="text" class="form-control search" placeholder="Search Artist or Song's Title..." aria-describedby="basic-addon1" style="background: transparent; color: white;" yang-dicari="song" autocomplete="off">
                    </div>

                    <div class="kategori-chat">
                      <a href="<?= base_url('song-by-category'); ?>">
                        <img class="mr-2" src="<?= base_url('assets/images/kategori.png'); ?>" style="height: 28px; width: auto;">
                      </a>
                      <!-- <a onclick="show_list()">
                        <span id="notifchat" style="display: none;"></span>
                        <img class="mr-2" src="<?= base_url('assets/images/playlist.png'); ?>" style="height: 25px; width: auto;">
                      </a> -->
                      <a data-toggle="modal" data-target="#exampleModal5" href="Javascript.void(0)">
                        <span id="notifchat" style="display: none;"></span>
                        <img src="<?= base_url('assets/images/chat.png'); ?>" style="height: 25px; width: auto;">
                      </a>
                    </div>
                  <?php
                  } 
                  // else { ?>
                    <!-- <div class="kategori-chat" style= "text-align: right;padding-right: 10px;position: absolute;right: 0;margin: 6px">
                      <a data-toggle="modal" data-target="#exampleModal5" href="Javascript.void(0)">
                        <span id="notifchat" style="display: none;"></span>
                        <img src="<?= base_url('assets/images/chat.png'); ?>" style="height: 25px; width: auto;">
                      </a>
                    </div> -->
                  <?php
                  // }
                  ?>

              <?php
              } else { ?>

                  <!-- <button class="navbar-toggler" type="button" style="border-color: transparent !important;" onclick="window.history.go(-1); return false;">
                      <b><span class="material-icons text-white align-middle">arrow_back_ios</span></b>&nbsp;<span class="text-white align-middle" style="font-size: 18px;"><?= (isset($title_chat)) ? $title_chat : $title; ?></span>
                  </button> -->

                  <button class="navbar-toggler" type="button" style="border-color: transparent !important;" onclick="location.href = '<?= base_url(); ?>';">
                      <b><span class="material-icons text-white align-middle">arrow_back_ios</span></b>&nbsp;<span class="text-white align-middle" style="font-size: 18px;"><?= (isset($title_chat)) ? $title_chat : $title; ?></span>
                  </button>

              <?php
              }
              ?>
              </div>
              <div class="collapse navbar-collapse d-none" id="navbarCollapse">
                  <!-- 
                  <ul class="navbar-nav mr-auto">
                      <li class="search-tits" style="margin-bottom: 10px">
                                              
                          <form class="form-inline mt-2 mt-md-0" action="<?php echo site_url($url.'/search');?>" method="GET">
                              <input type="hidden" name="type" value="title">
                              <input class="form-control search-field" name="query" id="mobile-search" type="text" placeholder="Search" aria-label="Search" autofocus="autofocus" onkeyup="search($(this).val())" autocomplete="off">
                              <button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
                          </form> 
                          

                          <div class="sugest-box" id="search-result">
                              <ul style="margin-top:20px;" id="auto-complete" class="list-unstyled">
                              </ul>
                          </div>

                      </li>
                      <li class="nav-item active">
                          <a class="nav-link" onClick="mydioapp()" href="<?php echo site_url($url);?>"><?php echo $this->lang->line('Home');?> <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" onClick="mydioapp()" href="#">Top Karafie</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" onClick="mydioapp()" href="#">Top Karaclip</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" onClick="mydioapp()" href="#"><?php echo $this->lang->line('Trending');?></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" onClick="mydioapp()" href="#"><?php echo $this->lang->line('Recommended');?></a>
                      </li>
                  </ul> -->

                  <!-- 
                  <ul class="navbar-nav mr-auto d-md-none">
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo site_url($url.'/about')?>"><?php echo $this->lang->line('About');?> <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo site_url($url.'/tos')?>">Term Of Service</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo site_url($url.'/news')?>"><?php echo $this->lang->line('News');?></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo site_url($url.'/contact')?>"><?php echo $this->lang->line('Contact Us');?></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo site_url($url.'/privacy')?>"><?php echo $this->lang->line('Privacy');?></a>
                      </li>
                      <li class="nav-item">
                          <div class="row" style="margin-top: 2rem">
                              <div class="col-md-6 col-xs-12 offset-md-3 text-center">
                                  <button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-facebook"></i></button>
                                  <button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-instagram"></i></button>
                                  <button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-twitter"></i></button>
                                  <button type="button" class="btn btn-footer btn-circle btn-lg"><i class="fa fa-youtube"></i></button>
                              </div>
                          </div>
                          <div class="row" style="margin-top: 1rem">
                              <div class="col-md-12 col-xs-12 text-center">
                                  <span class="footnote" style="color:#222">&copy 2018 Mydiowork Technology. All Right Reserved.</span>
                              </div>
                          </div>
                      </li>
                  </ul> -->

                  <ul class="navbar-nav mr-auto">                      
                      <li class="nav-item">
                          <a class="nav-link text-white" href="<?php echo site_url($url.'/setting')?>">
                            <span class="material-icons align-middle">settings</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="align-middle">Setting</span>
                          </a>
                          <a class="nav-link text-white" href="<?php echo site_url($url.'/subscription')?>">
                            <span class="material-icons align-middle">subscriptions</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="align-middle">Subscription</span>
                          </a>
                      </li>
                  </ul>

                  <!-- 
                  <form class="form-inline mt-2 mt-md-0">
                      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
                  -->
              </div>

              <div class="search-sign" style="margin-right: 15px;">
              </div>
          </nav>
          <!--/.container    -->

          <div class="search-suggest container bg-white" style="display: none;">
            <div class="row">
                <div class="col-12 p-2">
                  Lagu Satu
                </div>
                <div class="col-12 p-2">
                  Lagu Satu
                </div>
                <div class="col-12 p-2">
                  Lagu Satu
                </div>
            </div>            
          </div>

      </section>

      <aside class="js-offcanvas" data-offcanvas-options='{ "modifiers": "left,overlay" }' id="off-canvas" style="background-color:rgba(0,0,0,0.6);">
          <ul class="list-unstyled">
          </ul>
      </aside>
    <?php
    }
    ?>
    <!-- GTranslate: https://gtranslate.io/ -->
    <!--   <a href="#" onclick="doGTranslate('id|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="English" /></a><a href="#" onclick="doGTranslate('id|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="French" /></a><a href="#" onclick="doGTranslate('id|de');return false;" title="German" class="gflag nturl" style="background-position:-300px -100px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="German" /></a><a href="#" onclick="doGTranslate('id|it');return false;" title="Italian" class="gflag nturl" style="background-position:-600px -100px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Italian" /></a><a href="#" onclick="doGTranslate('id|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Portuguese" /></a><a href="#" onclick="doGTranslate('id|ru');return false;" title="Russian" class="gflag nturl" style="background-position:-500px -200px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Russian" /></a><a href="#" onclick="doGTranslate('id|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;">
      <img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Spanish" /></a> -->

    <!-- <style type="text/css">

    a.gflag {vertical-align:middle;font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/16.png);}
    a.gflag img {border:0;}
    a.gflag:hover {background-image:url(//gtranslate.net/flags/16a.png);}
    #goog-gt-tt {display:none !important;}
    .goog-te-banner-frame {display:none !important;}
    .goog-te-menu-value:hover {text-decoration:none !important;}
    body {top:0 !important;}
    #google_translate_element2 {display:none!important;}
    </style> -->

    <!-- <br />
    <select onchange="doGTranslate(this);">
      <option value="">Select Language</option>
      <option value="id|af">Afrikaans</option>
      <option value="id|sq">Albanian</option>
      <option value="id|ar">Arabic</option>
      <option value="id|hy">Armenian</option>
      <option value="id|az">Azerbaijani</option>
      <option value="id|eu">Basque</option>
      <option value="id|be">Belarusian</option>
      <option value="id|bg">Bulgarian</option>
      <option value="id|ca">Catalan</option>
      <option value="id|zh-CN">Chinese (Simplified)</option>
      <option value="id|zh-TW">Chinese (Traditional)</option>
      <option value="id|hr">Croatian</option>
      <option value="id|cs">Czech</option>
      <option value="id|da">Danish</option>
      <option value="id|nl">Dutch</option>
      <option value="id|en">English</option>
      <option value="id|et">Estonian</option>
      <option value="id|tl">Filipino</option>
      <option value="id|fi">Finnish</option>
      <option value="id|fr">French</option>
      <option value="id|gl">Galician</option>
      <option value="id|ka">Georgian</option>
      <option value="id|de">German</option>
      <option value="id|el">Greek</option>
      <option value="id|ht">Haitian Creole</option>
      <option value="id|iw">Hebrew</option>
      <option value="id|hi">Hindi</option>
      <option value="id|hu">Hungarian</option>
      <option value="id|is">Icelandic</option>
      <option value="id|id">Indonesian</option>
      <option value="id|ga">Irish</option>
      <option value="id|it">Italian</option>
      <option value="id|ja">Japanese</option>
      <option value="id|ko">Korean</option>
      <option value="id|lv">Latvian</option>
      <option value="id|lt">Lithuanian</option>
      <option value="id|mk">Macedonian</option>
      <option value="id|ms">Malay</option>
      <option value="id|mt">Maltese</option>
      <option value="id|no">Norwegian</option>
      <option value="id|fa">Persian</option>
      <option value="id|pl">Polish</option>
      <option value="id|pt">Portuguese</option>
      <option value="id|ro">Romanian</option>
      <option value="id|ru">Russian</option>
      <option value="id|sr">Serbian</option>
      <option value="id|sk">Slovak</option>
      <option value="id|sl">Slovenian</option>
      <option value="id|es">Spanish</option>
      <option value="id|sw">Swahili</option>
      <option value="id|sv">Swedish</option>
      <option value="id|th">Thai</option>
      <option value="id|tr">Turkish</option>
      <option value="id|uk">Ukrainian</option>
      <option value="id|ur">Urdu</option>
      <option value="id|vi">Vietnamese</option>
      <option value="id|cy">Welsh</option>
      <option value="id|yi">Yiddish</option>
    </select><div id="google_translate_element2"></div>
     -->
    <!-- <script type="text/javascript">
    function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'id',autoDisplay: false}, 'google_translate_element2');}
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


    <script type="text/javascript">
    /* <![CDATA[ */
    eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
    /* ]]> */
    </script> -->