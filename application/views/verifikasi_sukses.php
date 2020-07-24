<!DOCTYPE html>
<html>
<head>
	<title>Verifikasi Sukses</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/materialize/css/materialize.min.css') ?>
	<?= link_tag('assets/plugins/material-icons/material-icons.css') ?>
	<?= link_tag('assets/fonts/roboto/roboto.css') ?>
	<?= link_tag('assets/style.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="green">

	<main>
		<div class="section">
			<div class="row valign-wrapper">
				<div class="col m8 l6 pull-m2 pull-l3">
					<div class="card z-depth-4 card-panel">
						<div class="card-content">
							<h1><i class="material-icons right medium green-text">sentiment_very_satisfied</i>Berhasil!</h1>
							<h5>Akun anda berhasil diverifikasi. Terima kasih telah ikut bergabung.</h5>
							<br>
							<p>Silahkan login ulang untuk memulai sesi.</p>
							<a href="<?= base_url('login') ?>" class="btn blue waves-effect waves-light">Klik disini untuk masuk</a>
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