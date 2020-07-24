<?= doctype('html5'); ?>
<html>
<head>
	<title>Error &amp; Bug</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
	<?= link_tag('assets/plugins/select2/css/select2.min.css') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
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

		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/moment/moment.min.js') ?>
<?= script('assets/plugins/moment/id.js') ?>
<?= script('assets/plugins/select2/js/select2.min.js') ?>
<?= script('assets/plugins/select2/js/i18n/id.js') ?>
<?= script('assets/plugins/pace/js/pace.min.js') ?>
<?= script('assets/plugins/sweetalert/sweetalert.min.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<?= script('assets/plugins/logsparser/logsparser.js') ?>
<script type="text/javascript">
    $(document).ajaxStart(function() { Pace.restart(); });
    var data = {
        selectLogs: <?php echo json_encode($logs) ?>,
        getUrl: '<?= base_url('admin/laporan/get_error/') ?>',
        downloadUrl: '<?= base_url('admin/laporan/get_error/') ?>',
        deleteUrl: '<?= base_url('admin/laporan/get_error/') ?>',

    }
    $('section.content').LogsParser(data);
</script>
</body>
</html>