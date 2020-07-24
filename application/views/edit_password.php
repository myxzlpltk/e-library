<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title>Edit Kata Sandi</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="light-blue">

	<?php $this->load->view('header', array('menu'=>5)) ?>

	<main>
		<div class="section">
			<div class="container">
				<div class="card card-panel">
					<p class="card-title">Edit Kata Sandi</p>
					<?= form_open('',array('class'=>'form-validation')) ?>
						<div class="input-field">
							<i class="material-icons prefix">lock</i>
							<input id="password_lama" name="password_lama" type="password" value="<?= set_value('password_lama') ?>" class="<?= has(form_error('password_lama','','')) ?>">
							<label for="password_lama">Password Lama</label>
							<?= form_error('password_lama', '<span class="helper-text red-text">','</span>'); ?>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">vpn_key</i>
							<input id="password" name="password" type="password" value="<?= set_value('password') ?>" class="<?= has(form_error('password','','')) ?>">
							<label for="password">Password Baru</label>
							<?= form_error('password', '<span class="helper-text red-text">','</span>'); ?>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">vpn_key</i>
							<input id="type_password" name="type_password" type="password" value="<?= set_value('type_password') ?>" class="<?= has(form_error('type_password','','')) ?>">
							<label for="type_password">Ketik Ulang Password Baru</label>
							<?= form_error('type_password', '<span class="helper-text red-text">','</span>'); ?>
						</div>
						<button type="submit" class="btn blue waves-effect waves-light">Perbarui Data</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</main>

	<?php $this->load->view('footer') ?>
	
	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>

</body>
</html>
