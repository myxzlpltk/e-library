<?= doctype('html5'); ?>
<html>
<head>
	<title>Lupa Kata Sandi</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="yellow">

	<main>
		<div class="section">
			<div class="valign-wrapper row">
				<div class="col s10 pull-s1 m6 pull-m3 l4 pull-l4">
					<?php card_flash() ?>
					<div class="card z-depth-4 card-panel">
						<div class="card-content">
							<?= form_open('',array('id'=>'register-form')) ?>
								<div class="row">
									<div class="input-field col s12 center">
										<h4>Lupa Kata Sandi</h4>
										<p class="center">Masukkan email untuk mencari akun anda</p>
									</div>
								</div>
								<div class="row margin">
									<div class="input-field col s12">
										<i class="material-icons prefix">email</i>
										<input id="email" name="email" type="email" value="<?= set_value('email') ?>" class="<?= has(form_error('email','','')) ?>">
										<label for="email">Email</label>
										<?= form_error('email', '<span class="helper-text red-text">','</span>'); ?>
									</div>
									<div class="input-field col s12">
										<div class="g-recaptcha" data-sitekey="6Lclr1UUAAAAAF3SC341I0l32Krez8o3rJAueGgq"></div>
									</div>
									<div class="col s12">
										<button type="submit" class="btn waves-effect waves-light col s12 blue">Cari</button>
									</div>
								</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>
	<script src="https://www.google.com/recaptcha/api.js?hl=id"></script>
	
</body>
</html>