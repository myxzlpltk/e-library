<?= doctype('html5'); ?>
<html>
<head>
	<title>Verifikasi</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="light-blue">

	<main>
		<div class="section">
			<div class="valign-wrapper row login-box">
				<div class="col s10 pull-s1 m8 pull-m2">
					<?php card_flash() ?>
					<div class="card z-depth-4 card-panel">
						<div class="row">
							<div class="col s12 center">
								<h4>Verifikasi</h4>
							</div>
							<div class="col m6">
								<p>Kami telah mengirim kode verifikasi ke alamat <b><?= $ver->email ?></b></p>
								<p>Periksa di bagian spam jika email tidak ada di kotak masuk</p>
								<p>Batas Waktu <span class="moment fromNow" data-time="<?= $ver->expired ?>"></span></p>
							</div>
							<div class="col m6">
								<?= form_open() ?>
									<div class="input-field col s12">
										<i class="material-icons prefix">confirmation_number</i>
										<input id="kode" type="text" name="kode" required="required" value="<?= set_value('kode') ?>" class="<?= has(form_error('kode','','')) ?>">
										<label for="kode" class="center-align">Kode Verifikasi</label>
										<?= form_error('kode', '<span class="helper-text red-text">','</span>'); ?>
									</div>
									<div class="input-field col s12">
										<div class="g-recaptcha" data-sitekey="6Lclr1UUAAAAAF3SC341I0l32Krez8o3rJAueGgq"></div>
										<?= form_error('g-recaptcha-response', '<span class="helper-text red-text">','</span>'); ?>
									</div>
									<div class="col s12">
										<a href="<?= base_url('verifikasi/perbarui/'.$id) ?>" class="btn orange waves-effect">Minta kode baru</a>
										<button type="submit" class="btn blue waves-effect">Verifikasi</button>
									</div>
								<?= form_close() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/moment/moment.min.js') ?>
	<?= script('assets/plugins/moment/id.js') ?>
	<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>
	<script src="https://www.google.com/recaptcha/api.js?hl=id"></script>
</body>
</html>