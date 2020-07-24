<?= doctype('html5'); ?>
<html>
<head>
	<title>Laporan Statistik</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
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
				<div class="col-lg-9">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Baca & Unduh per Hari</h3>
						</div>
						<div class="box-body">
							<canvas id="aksiMinggu" style="width: 100%;height: 200px;"></canvas>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">Kata Kunci Populer</h3>
						</div>
						<div class="box-body">
							<?php foreach ($keyword as $key => $value) { ?>
							<h3 class="label label-primary"><span class="fa fa-search"></span> <?= $value->keyword ?></h3>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="box box-primary bg-light-blue-gradient">
						<div class="box-header with-border">
							<h3 class="box-title">Jumlah Pencarian 20 Hari Terakhir</h3>
						</div>
						<div class="box-body">
							<canvas id="pencarian" style="width: 100%;height: 300px;"></canvas>
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
<?= script('assets/plugins/chartjs/chart.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
	$(document).ready(function() {
		var ctx = [
		$('#pencarian').get(0).getContext("2d"),
		$('#aksiMinggu').get(0).getContext("2d")
		];

		var options = [
		{
			scaleBeginAtZero : true,
			scaleShowGridLines : true,
			scaleGridLineColor : "rgba(255,255,255,0.4)",
			scaleGridLineWidth : 1,
			scaleLineColor: "rgba(255,255,255,1)",
			scaleFontColor: "rgba(255,255,255,1)",
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			bezierCurve : true,
			bezierCurveTension : 0.4,
			pointDot : true,
			pointDotRadius : 2,
			pointDotStrokeWidth : 4,
			pointHitDetectionRadius : 5,
			datasetStroke : true,
			datasetStrokeWidth : 2,
			datasetFill : false,
		},
		{
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.05)",
            scaleGridLineWidth : 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barValueSpacing: 10,
        },
		];

		var data = [
		{
			labels: <?php echo json_encode(array_map('fix_date',array_column($cari, 'label'))) ?>,
			datasets: [
			{
				label: "Banyak Pencarian",
				strokeColor: '#ffffff',
				data: <?php echo json_encode(array_column($cari, 'data')) ?>
			}
			]
		},
		{
			labels: <?php echo json_encode(array_map('fix_day', array_column($aksi_minggu, 'label'))) ?>,
			datasets: [
			{
				label: "Baca dan Unduh per Hari",
				fillColor: 'rgb(0, 155, 119)',
				data: <?php echo json_encode(array_column($aksi_minggu, 'data')) ?>
			}
			]
		},
		];

		new Chart(ctx[0]).Line(data[0], options[0]);
		new Chart(ctx[1]).Bar(data[1], options[1]);
	});
</script>
</body>
</html>