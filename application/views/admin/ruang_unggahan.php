<?= doctype('html5'); ?>
<html>
<head>
	<title>Ruang Unggahan</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
	<?= link_tag('assets/plugins/datatables/css/dataTables.bootstrap.min.css') ?>
    <?= link_tag('assets/plugins/pace/themes/white/pace-theme-flash.css') ?>
	<?= link_tag('assets/dist/css/AdminLTE.min.css') ?>
	<?= link_tag('assets/myskin.min.css') ?>
	<?= link_tag('assets/img/favicon.ico', 'icon', 'image/ico') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">

<div class="wrapper">
	
	<?php $this->load->view('admin/header') ?>
	<?php $this->load->view('admin/side', array('menu' => 5)) ?>

	<div class="content-wrapper">
		<section class="content-header">
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>

			<div class="row">
				<div class="col-md-4">
					<div class="info-box bg-yellow" id="info-gambar">
						<span class="info-box-icon"><i class="fa fa-image"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Sampul Buku</span>
							<span class="info-box-number">0 Berkas</span>

							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								0 MB ruang dipakai
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="info-box bg-green" id="info-pdf">
						<span class="info-box-icon"><i class="fa fa-book"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Berkas Buku</span>
							<span class="info-box-number">0 Berkas</span>

							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								0 MB ruang dipakai
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="info-box bg-red" id="info-lampiran">
						<span class="info-box-icon"><i class="fa fa-paperclip"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Lampiran Buku</span>
							<span class="info-box-number">0 Berkas</span>

							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								0 MB ruang dipakai
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="box box-primary" id="gambar">
				<div class="box-header">
					<h3 class="box-title">Berkas di direktori sampul buku</h3>
					<div class="box-tools">
						<button type="button" class="btn btn-primary btn-sm refreshFile" data-id="0"><i class="fa fa-refresh"></i> Perbarui</button>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-condensed dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Berkas</th>
								<th>Ukuran Berkas</th>
								<th>Tanggal Berkas</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

			<div class="box box-primary" id="pdf">
				<div class="box-header">
					<h3 class="box-title">Berkas di direktori pdf buku</h3>
					<div class="box-tools">
						<button type="button" class="btn btn-primary btn-sm refreshFile" data-id="1"><i class="fa fa-refresh"></i> Perbarui</button>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-condensed dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Berkas</th>
								<th>Ukuran Berkas</th>
								<th>Tanggal Berkas</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

			<div class="box box-primary" id="lampiran">
				<div class="box-header">
					<h3 class="box-title">Berkas di direktori lampiran buku</h3>
					<div class="box-tools">
						<button type="button" class="btn btn-primary btn-sm refreshFile" data-id="2"><i class="fa fa-refresh"></i> Perbarui</button>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-condensed dataTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Berkas</th>
								<th>Ukuran Berkas</th>
								<th>Tanggal Berkas</th>
							</tr>
						</thead>
						<tbody>
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
<?= script('assets/plugins/pace/js/pace.min.js') ?>
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	var data = [
		[
			'#gambar',
			'#info-gambar',
			'<?= base_url('admin/laporan/get_ruang_unggahan/gambar') ?>'
		],
		[
			'#pdf',
			'#info-pdf',
			'<?= base_url('admin/laporan/get_ruang_unggahan/pdf') ?>'
		],
		[
			'#lampiran',
			'#info-lampiran',
			'<?= base_url('admin/laporan/get_ruang_unggahan/lampiran') ?>'
		]
	];
	var now = 0;

    $(document).ajaxStart(function() { Pace.restart(); }); 
	$(document).ready(function() {
		sendAjax(data[now], true);

		$('.refreshFile').click(function(){
			var index = parseInt($(this).data('id'));
			sendAjax(data[index]);
		});
	});

	function sendAjax(config,status){
		var el = config[0];
		var box = config[1];
		var url = config[2];
		$.ajax({
			url: url,
			method: 'get',
			dataType: 'json',
			success: function(result){
				var data = [];
				$.each(result.details, function(index) {
					data.push([index+1,'<p class="break">'+this.nama+'</p>',this.ukuran,this.tanggal]);
				});
				$(box).find('.info-box-number').html(result.details.length+' Berkas');
				$(box).find('.progress-description').html(result.total+' ruang dipakai');
				dataTable(el, data);
			},
			complete: function(){
				if(status){
					now++;
					var next = data[now];
					if(next!=undefined){
						sendAjax(next, true);
					}
				}
			}
		});
	}

	function dataTable(el,data){
		$(el).find('table').dataTable().fnClearTable();
		$(el).find('table').dataTable().fnAddData(data);
		$(el).find('table').dataTable().fnDraw();
	}
</script>
</body>
</html>