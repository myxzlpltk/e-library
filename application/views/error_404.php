<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>

</head>
<body class="yellow lighten-5">

	<main>
		<div class="section">
			<div class="container">
				<h2 class="left error-404"> 404</h2>
				<div class="error-content"><br>
					<h3><i class="fa fa-warning text-yellow"></i> Maaf, Halaman yang anda minta tidak dapat ditemukan.</h3>
					<p>
						Kami tidak dapat menemukan yang anda cari. Mungkin, anda mau kembali ke halaman utama.
					</p>
					<a href="<?= base_url() ?>" class="btn blue waves-effect waves-light">Kembali</a>
				</div>
			</div>
		</div>

	</main>

	<?= script('assets/plugins/jquery/jquery.min.js') ?>
	<?= script('assets/plugins/materialize/js/materialize.min.js') ?>
	<?= script('assets/main.js') ?>
</body>
</html>