<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title>Profil</title>
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
				<div class="row">
					<div class="col s12">
						<?php card_flash() ?>
					</div>
					<div class="col m6 l4">
						<div class="card">
							<div class="card-content">
								<p class="center-align"><i class="material-icons large">person</i></p>
								<h4 class="card-title"><?= ucwords($user->nama_user) ?> <?php if(!is_null($user->verifikasi_email)){echo '<i class="material-icons waves-effect blue-text" data-toggle="tooltip" data-tooltip="Terverifikasi" data-position="top">verified_user</i>';} ?></h4>
								<p class="break"><b>Surel</b> : <?= $user->email ?></p>
								<p>Bergabung <span class="moment" data-time="<?= $user->tanggal_gabung ?>"></span></p>
							</div>
							<div class="card-action">
								<a href="<?= base_url('profil/edit') ?>" class="blue-text">Edit</a>
								<a href="<?= base_url('profil/ganti_password') ?>" class="blue-text">Perbarui Kata Sandi</a>
							</div>
						</div>
					</div>
					<div class="col m6 l8">
						<div class="card card-panel">
							<p class="card-title">5 Unduhan Terakhir</p>
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul Buku</th>
										<th>Deskripsi</th>
										<th>Waktu</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($unduh as $key => $value) { ?>
									<tr>
										<td><?= $key+1 ?></td>
										<td><a href="<?= base_url('buku/lihat/'.underscore($value['nama_buku'])) ?>"><?= $value['nama_buku'] ?></a></td>
										<td><?= $value['deskripsi_buku'] ?></td>
										<td class="moment" data-time="<?= $value['waktu'] ?>"></td>
									</tr>
									<?php } ?>
									<?php if(count($unduh)==0){ ?>
									<tr>
										<td colspan="4" class="text-center">Data tidak ditemukan</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="card card-panel">
							<p class="card-title">5 Baca Terakhir</p>
							<table class="table">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul Buku</th>
										<th>Deskripsi</th>
										<th>Waktu</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($baca as $key => $value) { ?>
									<tr>
										<td><?= $key+1 ?></td>
										<td><a href="<?= base_url('buku/lihat/'.underscore($value['nama_buku'])) ?>" class="nav-link"><?= $value['nama_buku'] ?></a></td>
										<td><?= $value['deskripsi_buku'] ?></td>
										<td class="moment" data-time="<?= $value['waktu'] ?>"></td>
									</tr>
									<?php } ?>
									<?php if(count($baca)==0){ ?>
									<tr>
										<td colspan="4" class="text-center">Data tidak ditemukan</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php $this->load->view('footer') ?>
	
	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/moment/moment.min.js') ?>
	<?= script('assets/plugins/moment/id.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>

</body>
</html>
