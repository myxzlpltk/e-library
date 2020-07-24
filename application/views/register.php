<?= doctype('html5'); ?>
<html>
<head>
	<title>Pendaftaran</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="cyan">

	<main>
		<div class="section">
			<div class="valign-wrapper row">
				<div class="col s10 pull-s1 m8 pull-m2">
					<?php card_flash() ?>
					<div class="card z-depth-4 card-panel">
						<?= form_open('',array('id'=>'register-form')) ?>
							<div class="row">
								<div class="col s12 center">
									<h4>Pendaftaran</h4>
								</div>
							</div>
							<div class="row margin">
								<div class="input-field col s12 m6">
									<i class="material-icons prefix">account_box</i>
									<input id="nama_user" type="text" name="nama_user" value="<?= set_value('nama_user') ?>" class="<?= has(form_error('nama_user','','')) ?>">
									<label for="nama_user" class="center-align">Nama Lengkap</label>
									<?= form_error('nama_user', '<span class="helper-text red-text">','</span>'); ?>
								</div>
								<div class="input-field col s12 m6">
									<i class="material-icons prefix">person</i>
									<input id="username" type="text" name="username" value="<?= set_value('username') ?>" class="<?= has(form_error('username','','')) ?>">
									<label for="username" class="center-align">Username</label>
									<?= form_error('username', '<span class="helper-text red-text">','</span>'); ?>
								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix">email</i>
									<input id="email" type="email" name="email" value="<?= set_value('email') ?>" class="<?= has(form_error('email','','')) ?>">
									<label for="email" class="center-align">Email</label>
									<?= form_error('email', '<span class="helper-text red-text">','</span>'); ?>
								</div>
								<div class="input-field col s12 m6">
									<i class="material-icons prefix">lock</i>
									<input id="password" type="password" name="password" value="<?= set_value('password') ?>" class="<?= has(form_error('password','','')) ?>">
									<label for="password" class="">Kata sandi</label>
									<?= form_error('password', '<span class="helper-text red-text">','</span>'); ?>
								</div>
								<div class="input-field col s12 m6">
									<i class="material-icons prefix">vpn_key</i>
									<input id="type_password" type="password" name="type_password" value="<?= set_value('type_password') ?>" class="<?= has(form_error('type_password','','')) ?>">
									<label for="type_password" class="">Ketik ulang kata sandi</label>
									<?= form_error('type_password', '<span class="helper-text red-text">','</span>'); ?>
								</div>
								<div class="input-field col s12">
									<div class="g-recaptcha" data-sitekey="6Lclr1UUAAAAAF3SC341I0l32Krez8o3rJAueGgq"></div>
									<?= form_error('g-recaptcha-response', '<span class="helper-text red-text">','</span>'); ?>
								</div>
								<div class="col s12">
									<button type="submit" class="btn blue waves-effect waves-light col s12">Daftar</button>
								</div>
								<div class="col s12">
									<p class="margin center medium-small sign-up">Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk disini</a></p>
								</div>
							</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>
	<script src="https://www.google.com/recaptcha/api.js?hl=id"></script>
	
</body>
</html>