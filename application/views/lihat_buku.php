<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title><?= $buku['nama_buku'] ?></title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body>

	<?php $this->load->view('header', array('menu'=>3)) ?>

	<main class="blue lighten-5">
		<div class="section container">
			<div class="row">
				<div class="col s12">
					<?php card_flash() ?>
				</div>
				<div class="col m4">
					<div class="card z-depth-2 hoverable">
						<div class="card-image">
							<img src="<?= base_url('buku/cover/'.$buku['file_buku']) ?>" class="responsive-img materialboxed" title="<?= $buku['nama_buku'] ?>" alt="<?= $buku['nama_buku'] ?>">
						</div>
					</div>
				</div>
				<div class="col m8">
					<?php !$this->session->userdata('id_user')?callout('danger', 'Kamu harus login terlebih dahulu'):''; ?>
					<div class="card z-depth-2 hoverable">
						<div class="card-content">
							<span class="card-title"><?= $buku['nama_buku'] ?></span>
							<p><?= $buku['deskripsi_buku'] ?></p><br>
							<p>
								<?php foreach ($buku['kategori'] as $val) { ?>
								<a href="<?= base_url('buku?kategori%5B%5D='.$val->kategori) ?>" class="btn blue waves-effect"><i class="material-icons left">bookmark</i> <?= $val->kategori ?></a>
								<?php } ?>
							</p>
							<table border="0">
								<tbody>
									<tr>
										<th><b>Diunggah tanggal</b></th>
										<td><?= fix_date($buku['tanggal_unggah'], true) ?></td>
									</tr>
									<tr>
										<th><b>Ukuran Berkas</b></th>
										<td><?= byte_format($file['size']) ?></td>
									</tr>
									<tr>
										<th><b>Lampiran</b></th>
										<td><?= count($buku['lampiran']) ?> Berkas</td>
									</tr>
									<tr>
										<td align="right"><b>Diunduh Sebanyak</b></td>
										<td><?= $unduh ?> Kali</td>
									</tr>
								</tbody>
							</table>
							<br>
							<a href="<?= $this->session->userdata('id_user')?base_url('buku/unduh/'.$id):'#'; ?>" class="btn <?= !$this->session->userdata('id_user')?'disabled':''; ?>"><i class="material-icons left">get_app</i> Unduh</a>
							<a href="<?= $this->session->userdata('id_user')?base_url('buku/baca/'.$id):'#'; ?>" class="btn <?= !$this->session->userdata('id_user')?'disabled':''; ?>" target="_blank"><i class="material-icons left">visibility</i> Baca</a>
							<?php if(count($buku['lampiran'])>0){ ?>
							<a href="<?= $this->session->userdata('id_user')?base_url('buku/lampiran/'.$id):'#'; ?>" class="btn <?= !$this->session->userdata('id_user')?'disabled':''; ?>"><i class="material-icons left">attachment</i> Unduh Lampiran</a>
							<br><br>
							<p><b>Lampiran :</b></p>
							<?php foreach ($buku['lampiran'] as $l) { ?>
								<?php $info = get_file_info(lampiranpath($buku['id_buku'], $l->file)) ?>
								<div class="card card-panel blue lighten-2 white-text waves-effect waves-light">
									<p><?= $l->file ?></p>
									<i><?= byte_format($info['size']) ?></i>
								</div>
							<?php } ?>

							<?php } ?>
						</div>
					</div>
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
