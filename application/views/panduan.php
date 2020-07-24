<?= doctype('html5'); ?>
<html lang="id">
<head>
	<title>Panduan Penggunaan Aplikasi e-Library Bappeda Tulungagung</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body>

	<?php $this->load->view('header', array('menu'=>2)) ?>

	<main class="blue lighten-5">
		<div class="section blue darken-1">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<h4 class="white-text">Buku Panduan</h4>
						<p class="white-text">Selamat datang di "Gayatri" aplikasi perpustakaan digital milik Bappeda Tulungagung. Berikut ini adalah tata cara atau panduan menggunakan aplikasi ini. Klik pada masing-masing gambar untuk melihat lebih jelas</p>
						<a href="<?= base_url() ?>" class="btn orange waves-effect" target="_blank"><i class="material-icons left">open_in_new</i> Ke Halaman Utama</a>
					</div>
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan1.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section blue darken-2">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan2.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
					<div class="col m6">
						<h4 class="white-text">Daftar Buku</h4>
						<p class="white-text">Klik pada menu Daftar Buku. Gunakan kotak filter untuk melakukan pencarian buku. Klik pada gambar atau judul buku untuk melihat deskripsi buku. Klik tombol lihat untuk melihat info buku lebih lanjut.</p>
						<a href="<?= base_url('buku') ?>" class="btn orange waves-effect" target="_blank"><i class="material-icons left">open_in_new</i> Buka</a>
					</div>
				</div>
			</div>
		</div>
		<div class="section blue darken-3">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<h4 class="white-text">Informasi Buku</h4>
						<p class="white-text">Halaman ini biasanya berisi informasi mengenai buku. Contohnya sampul, judul, deskripsi, ukuran berkas, dan lampiran yang tersedia.</p>
						<p class="white-text">Anda harus memiliki akun terlebih dahulu agar bisa mengunduh buku, membaca buku dan mengunduh berkas berkas yang dilampirkan. Jika anda belum memiliki akun silahkan daftar untuk bergabung.</p>
						<p class="white-text">Jika anda sudah memiliki akun</p>
						<a href="#panduan-login" class="btn orange waves-effect"><i class="material-icons left">touch_app</i> Klik Disini</a>
					</div>
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan3.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section light-blue">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan_pengguna.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan4.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
					<div class="col m6">
						<h4 class="white-text">Daftarkan Diri Anda</h4>
						<p class="white-text">Klik pada ikon pengguna lalu pilih Daftar. Setelah memasuki halaman pendaftaran masukkan data diri anda dengan benar. Pastikan email anda aktif karena sistem akan mengirimkan kode verifikasi ke email tersebut</p>
						<a href="<?= base_url('register') ?>" class="btn orange waves-effect" target="_blank"><i class="material-icons left">open_in_new</i> Buka</a>
					</div>
				</div>
			</div>
		</div>
		<div class="section light-blue darken-1">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<h4 class="white-text">Verifikasikan</h4>
						<p class="white-text">Kami mengirimkan kode verifikasi ke email yang anda daftarkan sebelumnya. Jika email tidak ada di kotak masuk silahkan cek di kotak spam. Kemudian salin dan tempel kode ke kotak dan klik verifikasi.</p>
					</div>
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan5.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section light-blue darken-2">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan6.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
					<div class="col m6">
						<h4 class="white-text">Verifikasi Berhasil</h4>
						<p class="white-text">Selamat verifikasi akun berhasil. Klik pada tombol masuk maka anda akan diarahkan ke halaman login.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="section indigo" id="panduan-login">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<h4 class="white-text">Masuk Mengunakan Akun Anda</h4>
						<p class="white-text">Klik pada ikon pengguna lalu pilih Masuk. Setelah memasuki halaman masuk masukkan username dan password anda dengan benar. Klik tombol masuk untuk mendapatkan sesi.</p>
						<a href="<?= base_url('login') ?>" class="btn orange waves-effect" target="_blank"><i class="material-icons left">open_in_new</i> Buka</a>
					</div>
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan_pengguna.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan7.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section indigo darken-2">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan2.jpg') ?>" class="responsive-img materialboxed">
							</div>
						</div>
					</div>
					<div class="col m6">
						<h4 class="white-text">Daftar Buku</h4>
						<p class="white-text">Klik pada menu Daftar Buku. Gunakan kotak filter untuk melakukan pencarian buku. Klik pada gambar atau judul buku untuk melihat deskripsi buku. Klik tombol lihat untuk melihat info buku lebih lanjut.</p>
						<a href="<?= base_url('buku') ?>" class="btn orange waves-effect" target="_blank"><i class="material-icons left">open_in_new</i> Buka</a>
					</div>
				</div>
			</div>
		</div>
		<div class="section indigo darken-3">
			<div class="container">
				<div class="row">
					<div class="col m6">
						<h4 class="white-text">Informasi Buku</h4>
						<p class="white-text">Halaman ini biasanya berisi informasi mengenai buku. Contohnya sampul, judul, deskripsi, ukuran berkas, dan lampiran yang tersedia.</p>
						<p class="white-text">Klik unduh untuk mengunduh berkas buku.</p>
						<p class="white-text">Klik baca untuk membaca berkas buku.</p>
						<p class="white-text">Klik unduh lampiran untuk mengunduh lampiran yang tersedia.</p>
					</div>
					<div class="col m6">
						<div class="card hoverable">
							<div class="card-img">
								<img src="<?= base_url('assets/img/panduan3.jpg') ?>" class="responsive-img materialboxed">
							</div>
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
