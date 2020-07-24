<?= doctype('html5'); ?>
<html>
<head>
	<title>Import Buku</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
	<style>
		.file:hover{
			background-color: #f1f1f1;
		}
		.file label{
			border: 2px dashed #333;
			padding: 50px 15px;
			cursor: pointer;
			text-align: center;
			display: block;
			font-size: 36px;
			cursor: pointer;
		}
		.file input{
			display: none;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 2)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>
			<?= validation_errors() ?>
			<div class="callout callout-warning">
				<h4><span class="fa fa-warning"></span> Peringatan!</h4>
				<h5>Menggunakan fitur ini mungkin berbahaya. Karena semua file yang diunggah tidak melalui proses validasi yang benar. Pastikan file zip yang anda unggah aman dari ancaman virus. Selain itu, data buku akan diunggah sebagai buku baru. Jika data tidak lengkap data akan tetap diunggah. Kemungkinan buku memiliki data tidak lengkap seperti tidak memiliki judul, tidak memiliki gambar sampul, dll.</h5>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Buku</h3>
				</div>
				<div class="box-body">
					<?= form_open_multipart() ?>
						<div class="form-group file">
							<label>Pilih File ZIP</label>
							<input type="file" name="berkas" class="form-control" accept=".zip">
						</div>
						<p class="pull-left file_name"></p>
						<input type="submit" name="submit" class="btn btn-primary pull-right" value="Import Buku">
					<?= form_close() ?>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.file label').click(function(event){
			event.preventBubble=true;
			$('.file input').click();
		})
		$('.file input').change(function(){
			$('.file_name').html('file '+($(this).val()).substr(12)+' dipilih');
		})
		$('.file input').click(function(){
			$('.file_name').html(null);
		})
	});
</script>
</body>
</html>