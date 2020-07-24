<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
				<div class="col s10 pull-s1 m6 pull-m3 l4 pull-l4">
					<?php card_flash() ?>
					<div class="card z-depth-4 card-panel">
						<div class="card-content">
							<?= form_open('',array('class'=>'form-validation')) ?>
								<div class="row">
									<div class="input-field col s12 center">
										<h4>Masuk</h4>
										<p class="center">Masuk untuk memulai sesi</p>
									</div>
								</div>
								<div class="row margin">
									<div class="input-field col s12">
										<i class="material-icons prefix">person</i>
										<input id="username" name="username" type="text" value="<?= set_value('username') ?>" class="<?= has(form_error('username','','')) ?>">
										<label for="username">Username</label>
										<?= form_error('username', '<span class="helper-text red-text">','</span>'); ?>
									</div>
									<div class="input-field col s12">
										<i class="material-icons prefix">lock</i>
										<input id="password" name="password" type="password" value="<?= set_value('password') ?>" class="<?= has(form_error('password','','')) ?>">
										<label for="password" class="">Password</label>
										<?= form_error('password', '<span class="helper-text red-text">','</span>'); ?>
									</div>
									<div class="input-field col s12">
										<button type="submit" class="btn waves-effect waves-light col s12 blue">Masuk</button>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6 m6 l6">
										<p class="margin medium-small"><a href="<?= base_url('register') ?>">Daftar Sekarang!</a></p>
									</div>
									<div class="input-field col s6 m6 l6">
										<p class="margin right-align medium-small"><a href="<?= base_url('lupa_kata_sandi') ?>">Lupa Kata Sandi?</a></p>
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

</body>
</html>