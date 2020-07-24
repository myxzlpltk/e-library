<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title>Selamat Datang Di e-Library Bappeda Tulungagung</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/plugins/owl-carousel/css/owl.carousel.min.css') ?>
	<?= link_tag('assets/plugins/owl-carousel/css/owl.theme.default.min.css') ?>
	<?= link_tag('assets/fonts/pacifico/pacifico.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>

<body class="blue">

	<?php $this->load->view('header', array('menu'=>1)) ?>

	<main class="no-padding">
		<div class="section no-pad-top no-pad-bot">
			<div class="section center blue lighten-1">
				<h1 class="gayatri">"GAYATRI"</h1>
				<div class="tagline white-text"><h5>e-LIBRARY BAPPEDA TULUNGAGUNG</h5></div>
			</div>
		</div>
		<div class="section white blue darken-4">
			<div class="owl-carousel owl-theme" id="owl-gallery">
				<?php foreach ($slider as $key => $value) { ?>
					<?php if($value->tipe_slider=='image'){ ?>
						<div class="item">
							<div class="valign-wrapper bg-img black">
								<img src="<?= base_url('home/slider/'.$value->file_slider) ?>" class="responsive-img center">
							</div>
						</div>
					<?php }else{ ?>
						<div class="item-video">
							<div class="bg-img">
								<a class="owl-video" href="<?= $value->file_slider ?>"></a>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</main>

	<?php $this->load->view('footer') ?>

	<div class="preloader-background">
		<div class="preloader-wrapper big active">
			<div class="spinner-layer spinner-blue-only">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div><div class="gap-patch">
					<div class="circle"></div>
				</div><div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>
		</div>
	</div>

	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/owl-carousel/js/owl.carousel.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>
	<script type="text/javascript">
		$(document).ready(function(){
			var owl = $('.owl-carousel');

			owl.owlCarousel({
				center: true,
				items: 1,
				loop: true,
				nav: true,
				navText: ['<i class="material-icons waves-effect transparent white-text">chevron_left</i>','<i class="material-icons waves-effect transparent white-text">chevron_right</i>'],
				dots: true,
				margin: 0,
				stagePadding: 50,
				video: true,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true
			});

			owl.on('play.owl.video', function() {
				owl.on('translate.owl.carousel drag.owl.carousel', function() {
					owl.find('.owl-video-wrapper').find('iframe').remove();
				})
			})
		});

	</script>

</body>

</html>
