<?= doctype('html5'); ?>
<html>
<head>
	<title>Dashboard</title>
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
	<?php $this->load->view('admin/side', array('menu' => 1)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>Dashboard</h1>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>
			<div class="row">
				<?php if($this->input->get('q')){ ?>
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-header with-padding">
							<h3 class="box-title">Hasil Pencarian</h3>
						</div>
						<ul class="nav nav-stacked">
							<?php foreach ($cari as $value) { ?>
							<li><a href="<?= base_url($value['url']) ?>"><?= ucwords($value['name']) ?></a></li>
							<?php } ?>
							<?php if(empty($cari)){ ?>
							<li><a href="#">Tidak ada menu dapat ditemukan</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<?php } ?>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= $notif['jumlah_buku'] ?></h3>
							<p>Buku Baru</p>
						</div>
						<div class="icon">
							<i class="fa fa-book"></i>
						</div>
						<a href="#" class="small-box-footer"><i class="fa fa-clock-o"></i> Hari Ini</a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-maroon">
						<div class="inner">
							<h3><?= $notif['jumlah_user'] ?></h3>
							<p>User Mendaftar</p>
						</div>
						<div class="icon">
							<i class="fa fa-user-plus"></i>
						</div>
						<a href="#" class="small-box-footer"><i class="fa fa-clock-o"></i> Hari Ini</a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-olive">
						<div class="inner">
							<h3><?= $notif['jumlah_unduh'] ?></h3>
							<p>Buku di unduh</p>
						</div>
						<div class="icon">
							<i class="fa fa-download"></i>
						</div>
						<a href="#" class="small-box-footer"><i class="fa fa-clock-o"></i> Hari Ini</a>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-orange">
						<div class="inner">
							<h3><?= $notif['jumlah_sesi'] ?></h3>
							<p>Sesi di mulai</p>
						</div>
						<div class="icon">
							<i class="fa fa-handshake-o"></i>
						</div>
						<a href="#" class="small-box-footer"><i class="fa fa-clock-o"></i> Hari Ini</a>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">5 Buku paling sering diunduh</h3>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-hover table-bordered dataTable">
								<thead>
									<tr>
										<th>No</th>
										<th>Gambar</th>
										<th>Judul</th>
										<th>Deskripsi</th>
										<th>Frekuensi</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($buku_unduh as $no => $key){ ?>
									<tr>
										<td><?= $no+1 ?></td>
										<td><img src="<?= thumb($key['file_buku']) ?>" class="img-responsive center-block" style="max-height: 100px;"></td>
										<td><?= $key['nama_buku'] ?></td>
										<td><?= $key['deskripsi_buku'] ?></td>
										<td><?= $key['jumlah'] ?> Kali</td>
										<td>
											<a href="<?= base_url('admin/buku/lihat/'.$key['id_buku']) ?>" class="btn btn-sm bg-green"><span class="fa fa-eye"></span> Lihat</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">5 Buku paling sering dibaca</h3>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-hover table-bordered dataTable">
								<thead>
									<tr>
										<th>No</th>
										<th>Gambar</th>
										<th>Judul</th>
										<th>Deskripsi</th>
										<th>Frekuensi</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($buku_baca as $no => $key){ ?>
									<tr>
										<td><?= $no+1 ?></td>
										<td><img src="<?= thumb($key['file_buku']) ?>" class="img-responsive center-block" style="max-height: 100px;"></td>
										<td><?= $key['nama_buku'] ?></td>
										<td><?= $key['deskripsi_buku'] ?></td>
										<td><?= $key['jumlah'] ?> Kali</td>
										<td>
											<a href="<?= base_url('admin/buku/lihat/'.$key['id_buku']) ?>" class="btn btn-sm bg-green"><span class="fa fa-eye"></span> Lihat</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
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