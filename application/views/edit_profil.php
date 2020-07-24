<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title>Edit Profil</title>
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
					<p class="card-title">Edit Data</p>
					<?= form_open('',array('class'=>'form-validation')) ?>
						<div class="input-field">
							<i class="material-icons prefix">account_box</i>
							<input id="nama_user" name="nama_user" type="text" value="<?= $user->nama_user ?>" class="<?= has(form_error('nama_user','','')) ?>">
							<label for="nama_user">Nama Lengkap</label>
							<?= form_error('nama_user', '<span class="helper-text red-text">','</span>'); ?>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">email</i>
							<input id="email" name="email" type="email" value="<?= $user->email ?>" class="<?= has(form_error('email','','')) ?>">
							<label for="email">Email</label>
							<?= form_error('email', '<span class="helper-text red-text">','</span>'); ?>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">person</i>
							<input id="username" name="username" type="text" value="<?= $user->username ?>" class="<?= has(form_error('username','','')) ?>">
							<label for="username">Username</label>
							<?= form_error('username', '<span class="helper-text red-text">','</span>'); ?>
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