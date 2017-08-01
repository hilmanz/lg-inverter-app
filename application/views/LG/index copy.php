<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

//require "/home/berbagie/public_html/facebook_token/src/facebook.php";
require "facebook_token/src/facebook.php";

// Create our Application instance (replace this with your appId and secret).
$config = array(
  'appId'  => '541986275991929',
  'secret' => '87572abbbab46df0c7f88910941e3a5f',
);
$facebook = new Facebook($config);

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me?fields=id,first_name,last_name,picture,email,name');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

/* // Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl();
} */

// Login or logout url will be needed depending on current user state.
if ($user) {
	$params = array( 'next' => 'http://berbagi-energi.com' );

  $logoutUrl = $facebook->getLogoutUrl($params);
} else {
	$params = array(
	  'scope' => 'public_profile, email, user_posts, user_photos,user_about_me',
	  'redirect_uri' => 'http://berbagi-energi.com'
	);

  $statusUrl = $facebook->getLoginStatusUrl($params);
  $loginUrl = $facebook->getLoginUrl($params);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>LG Inverter</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.9">
        <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=base_url()?>assets/css/themify-icons.css" rel="stylesheet" type="text/css" media="all" />
        <!-- <link href="<?=base_url()?>assets/css/flexslider.css" rel="stylesheet" type="text/css" media="all" /> -->
        <link href="<?=base_url()?>assets/css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=base_url()?>assets/css/ytplayer.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=base_url()?>assets/css/theme-red.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=base_url()?>assets/css/font-opensans.css" rel="stylesheet" type="text/css" media="all" />

        <link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/flipclock.css">
		<style>
        * { box-sizing: border-box; }
        .video-background {
          background: #000;
          position: absolute;;
          top: 0; right: 0; bottom: 0; left: 0;
          z-index: 99;
        }
        .video-foreground,
        .video-background iframe {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          pointer-events: none;
        }

        @media (min-aspect-ratio: 16/9) {
          .video-foreground { height: 300%; top: -100%; }
        }
        @media (max-aspect-ratio: 16/9) {
          .video-foreground { width: 300%; left: -100%; }
        }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/flipclock.js"></script>

		<script type="text/javascript">

			$.getScript('//connect.facebook.net/en_US/all.js', function () {
				FB.init({
					appId: '541986275991929',
				});
			});


			window.twttr = (function (d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0], t = window.twttr || {};
				if (d.getElementById(id))
					return;
				js = d.createElement(s);
				js.id = id;
				js.src = "https://platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js, fjs);
				t._e = [];
				t.ready = function (f) {
					t._e.push(f);
				};
				return t;
			}(document, "script", "twitter-wjs"));


		</script>
    </head>
    <body>
        <div class="nav-container">
            <a id="top"></a>
            <nav class="absolute transparent">
                <div class="nav-bar">
                    <div class="module left">
                        <a href="<?=base_url()?>">
                            <img class="logo logo-light" alt="LG Life's Good" src="<?=base_url()?>assets/img/LG_lifesgood.png" />
                            <img class="logo logo-dark" alt="LG Life's Good" src="<?=base_url()?>assets/img/LG_lifesgood.png" />
                        </a>
                    </div>
                    <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="module-group right">
                        <div class="module left">
                            <ul class="menu">
                                <!-- <li class="has-dropdown"> -->
                                <li>
                                    <a href="index.html">
                                        Home
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="main-container">
            <section class="cover fullscreen">
                <div class="video-background">
                    <div class="video-foreground">
                      <iframe src="https://www.youtube.com/embed/W4LA6kIFYgs?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=W4LA6kIFYgs" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </section>
            <section class="image-bg overlay">
                <div class="background-image-holder">
                    <img alt="image" class="background-image" src="<?=base_url()?>assets/img/bg-red-geometric.jpg" />
                </div>
                <div class="container">
                    <div class="row v-align-children">
                        <div class="col-sm-4 mb-xs-40 text-center-xs">
                            <img src="<?=base_url()?>assets/img/lg-inverter-prod.png" alt="LG Inverter Products">
                        </div>
                        <div class="col-sm-8 text-center-xs">
                            <h3><strong>Saatnya Hemat dan #BerbagiEnergi<br />untuk Negeri Bersama LG</strong></h3>
                            <h4 class="lead mb40">Dengan tingginya tingkat penggunaan listrik di Indonesia saat ini,  LG Electronics dengan teknologi Inverter canggih ingin mengajak masyarakat untuk menghemat energi melalui kampanye potong 10% energy dari pemerintah. Melalui #BerbagiEnergi, kami ingin mejuwudkan prilaku hemat energi dengan melakukan sosialisasikan keunggulan LG Inverter melalui kegiatan yang menarik untuk publik.  </h4>
                            <a class="btn btn-lg btn-rounded" href="http://www.lg.com/id/home-appliance" target="_blank" onclick="shareFBnya()">Lihat Produk</a>
                        </div>
                    </div><!--end of row-->
                </div><!--end of container-->
            </section>
            <section class="image-bg pt20 pb20">
                <div class="background-image-holder">
                    <img alt="image" class="background-image" src="<?=base_url()?>assets/img/bg-gray-gradient.png" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 text-center">
                            <h2 class="mb40 mb-xs-24"><strong><span class="color-black">Ayo</span> <span class="color-primary">Hemat Energi Bagi Negeri</span> <span class="color-black">Bersama LG!</span></strong></h2>
                            <h4 class="lead mb64 color-gray">
                                Ayo menghemat dan #BerbagiEnergi bersama LG demi Indonesia yang lebih baik! Tunjukkan kepedulianmu dengan mengunjungi kegiatan Fun Bike #BerbagiEnergi di Bunderan HI, Sudirman, Jakarta pada tanggal 20 November 2016 dan memenangkan banyak hadiah menarik!
                            </h4>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 mb40">
                            <div class="text-center">
                                <div class="clock"></div>
                                <div class="message"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end of container-->
            </section>
            <div class="lightbox-grid square-thumbs">
                <ul>
                    <li>
                        <div class="feature feature-1 green">
                            <div class="text-center">
                                <div class="rundown">
                                    <img src="<?=base_url()?>assets/img/rundown_01.png" alt="Parade">
                                </div>
                                <h5>Fun Bike Registration</h5>
                                <h6>Pukul 5:00 - 6:00</h6>
                                <p class="thin">Plaza Barat Senayan (FX)</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="feature feature-1 orange">
                            <div class="text-center">
                                <div class="rundown">
                                    <img src="<?=base_url()?>assets/img/rundown_02.png" alt="Parade">
                                </div>
                                <h5>Fun Bike &amp; Petisi 10 Jari</h5>
                                <h6>Pukul 6:10 - 7:30</h6>
                                <p class="thin">Plaza Barat Senayan (FX) - Bundaran HI</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="feature feature-1 red-lg">
                            <div class="text-center">
                                <div class="rundown">
                                    <img src="<?=base_url()?>assets/img/rundown_03.png" alt="Parade">
                                </div>
                                <h5>Marching Band</h5>
                                <h6>Pukul 7:30 - 8:00</h6>
                                <p class="thin">Plaza Barat Senayan (FX)</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="feature feature-1 light-red">
                            <div class="text-center">
                                <div class="rundown">
                                    <img src="<?=base_url()?>assets/img/rundown_04.png" alt="Parade">
                                </div>
                                <h5>Relax - Prize - Dance</h5>
                                <h6>Pukul 8:00 - 9:00</h6>
                                <p class="thin">Plaza Barat Senayan (FX)</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="feature feature-1 light-green">
                            <div class="text-center">
                                <div class="rundown">
                                    <img src="<?=base_url()?>assets/img/rundown_05.png" alt="Parade">
                                </div>
                                <h5>Foto Bersama</h5>
                                <h6>Pukul 9:00 - 9:10</h6>
                                <p class="thin">Plaza Barat Senayan (FX)</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <section class="image-square left bg-red-02">
                <div class="col-md-6 image">
                    <div class="background-image-holder">
                        <img class="p32" src="<?=base_url()?>assets/img/phone-wave-mobile.jpg" alt="FunBike">
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1 content">
                    <h3 class="bold color-white text-center-xs">Ikuti Kompetisi Foto #BerbagiEnergi &amp;<br />
                        Menangkan Hadiah Seru!</h3>
                    <h4 class="lead color-white">
                        Ayo Hemat Energi dan ikut #BerbagiEnergi untuk Negeri demi masa depan Indonesia yang lebih baik.</h4>
                    <h4 class="lead color-white">
                        <ol class="syarat color-white">
                            <li>Datang ke acara #BerbagiEnergi di Bundaran HI, Sudirman, Jakarta</li>
                            <li>Ambil foto serumu dengan pose 10 jari yang kreatif selama acara Fun Bike berlangsung</li>
                            <li>Langsung upload fotomu melalui Instagram dengan mention @lgeindonesia beserta hashtag #BerbagiEnergi dan tag minimal 3 temanmu</li>
                        </ol>
                    </h4>
                    <h5 class="thin"><a href="<?=base_url()?>syarat" class="color-white">Syarat dan Ketentuan</a></h5>
                </div>
            </section>

            <section class="image-square left">
                <div class="col-md-6 image">
                    <div class="background-image-holder">
                        <img src="<?=base_url()?>assets/img/voucher-banner.jpg" alt="FunBike">
                    </div>
                    <!-- <div class="inner-title title-center text-center">
                        <div class="title">
                            <img src="<?=base_url()?>assets/img/LG-3D-logo.png" alt="LG - Life's Good">
                        <h3 class="bold color-black">Ikuti Fun Bike<br /><span class="color-primary">#BerbagiEnergi</span> bersama <span class="color-primary">LG</span></h3>
                        <h4 class="color-gray mb160">20 November 2016</h4>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-6 col-md-offset-1 content text-center-xs eventnya">
                    <h3 class="bold">Login ke <span class="color-primary">Facebook</span> account mu,<br />Share info <span class="color-primary">Hemat Energi</span> bagimu negeri dan  menangkan <span class="color-primary">Voucher Belanja</span></h3>
                    <!-- <h4 class="lead">
                        Login ke Facebook Account mu, klik share dan tag 3 temanmu
                    </h4> -->
                    <h4 class="lead">
                        Mau menangin voucher belanja Sodexo? Yuk kasih tau teman-temanmu tentang acara seru Fun Bike #BerbagiEnergi melalui media sosial sekarang juga!</h4>
                    <h4 class="lead">
                        Login ke akun Facebookmu, klik share, dan tag 3 temanmu!
                    </h4>
					<?php if ($user): ?>
                    <a class="btn btn-lg btn-rounded btn-filled submitevent" href="javascript:void(0)"  onclick="shareFB()">Share Sekarang</a>
					<?php else: ?>
					<a class="btn btn-lg btn-rounded btn-filled" href="<?php echo $loginUrl; ?>">Share Sekarang</a>
					<?php endif ?>
                    <h5 class="thin"><a href="<?=base_url()?>syarat">Syarat dan Ketentuan</a></h5>
                </div>
            </section>

            <footer class="footer-1 bg-primary">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-12 text-left">
                            <span class="sub">&copy; 2016 | Copyright LG Indonesia</span>
                        </div>

                    </div>
                </div>
                <!--end of container-->
                <a class="btn btn-sm fade-half back-to-top inner-link" href="#top">Top</a>
            </footer>
        </div>




        <!-- <script src="<?=base_url()?>assets/js/jquery.min.js"></script> -->
        <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
        <!-- <script src="<?=base_url()?>assets/js/flickr.js"></script> -->
        <script src="<?=base_url()?>assets/js/flexslider.min.js"></script>
        <script src="<?=base_url()?>assets/js/lightbox.min.js"></script>
        <!-- <script src="<?=base_url()?>assets/js/masonry.min.js"></script> -->
        <!-- <script src="<?=base_url()?>assets/js/twitterfetcher.min.js"></script> -->
        <!-- <script src="<?=base_url()?>assets/js/spectragram.min.js"></script> -->
        <script src="<?=base_url()?>assets/js/ytplayer.min.js"></script>
        <!-- <script src="<?=base_url()?>assets/js/countdown.min.js"></script> -->

        <script src="<?=base_url()?>assets/js/smooth-scroll.min.js"></script>
        <script src="<?=base_url()?>assets/js/parallax.js"></script>
        <script src="<?=base_url()?>assets/js/scripts.js"></script>
    </body>
</html>

<?php if ($user): ?>
 <?php print_r($user_profile['id']); ?>
<script>

shareFBnya();
function shareFBnya(){
	setTimeout(function(){
	$(".submitevent").trigger('onclick');
	}, 2000);

}
function shareFB() {

        FB.init();
        FB.ui({
            method: 'share',
            name: 'Berbagi Energi',
            href: 'http://berbagi-energi.com/',
            caption: '#BerbagiEnergi',
            //link: fb_link,
            picture: 'http://berbagi-energi.com/assets/img/share.png',
            //caption: fb_user,
            description: 'Yuk datang ke acara Hemat Energi Bagimu Negeri Bersama LG di Jakarta Car Free Day.  Dapatkan kesempatan memenangkan hadiah menarik. Kunjungi www.berbagi-energi.com untuk informasi lebih lanjut. '
        },
		function(response){

			if(response.error_code){
				console.log("tidak jadi share")
			}else{
				console.log("share berhasil")

				FB.api('/me?fields=id,name,first_name,last_name,picture,email', function(data) {

				  if(data.id == null)
				  {
						var basedomain = "<?=base_url()?>";
						var emailnya='<?=$user_profile['email']?>';
						var namanya='<?=$user_profile['name']?>';
						var idnya='<?=$user_profile['id']?>';
						$.ajax ({
							type	 : 'POST',
							url	 :  basedomain+'/LG/inputfb' ,
							data:{id:idnya, email:emailnya, nama:namanya},
							dataType:'json',
							success	: function (result)
							{
								console.log(result);
								console.log(result.totalmember);
								if(result.totalmember < 100){
									//console.log("100 share berhasil")
									window.location.href = 'http://berbagi-energi.com/100-pendaftar-pertama';
								}else{
									//console.log("100 tidak share berhasil")
									window.location.href = 'http://berbagi-energi.com/invitation';
								}
							}
						});

				  }else{
						$.ajax ({
							type	 : 'POST',
							url	 :  basedomain+'/LG/inputfb' ,
							data:{id:data.id, email:data.email, nama:data.name},
							dataType:'json',
							success	: function (result)
							{
								console.log(result);
								console.log(result.totalmember);
								if(result.totalmember < 100){
									window.location.href = 'http://berbagi-energi.com/100-pendaftar-pertama';
								}else{
									window.location.href = 'http://berbagi-energi.com/invitation';
								}
							}
						});
				  }

				});

			}
		});

    }
</script>
<?php endif ?>
