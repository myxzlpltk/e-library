<?= doctype('html5'); ?>
<html>
<head>
	<title>Kategori</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/plugins/datatables/css/dataTables.bootstrap.min.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 4)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kategori</h3>
					<div class="box-tools pull-right">
						<a href="<?= base_url('admin/kategori/tambah') ?>" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Tambah Kategori</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kategori</th>
								<th>Jumlah Buku</th>
								<th>Kategori</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kategori as $key => $value) { ?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $value->nama_kategori ?></td>
								<td><?= $value->jumlah_buku ?> Buku</td>
								<td>
									<div class="btn-group">
										<a href="<?= base_url('admin/kategori/lihat/'.$value->id_kategori) ?>" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span> Lihat</a>
										<a href="<?= base_url('admin/kategori/hapus/'.$value->id_kategori) ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Apakah kamu yakin ingin menghapus kategori <?= $value->nama_kategori ?>')"><span class="fa fa-trash"></span></a>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>
<?= script('assets/plugins/datatables/js/dataTables.bootstrap.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
</body>
</html>