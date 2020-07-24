<?= doctype('html5'); ?>
<html>
<head>
	<title>Log Aktivitas</title>
	<?= meta('Content-type', 'text/html; charset=utf-8', 'equiv') ?>
	<?= meta('viewport','width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') ?>
    <?= link_tag('assets/plugins/select2/css/select2.min.css') ?>
	<?= link_tag('assets/plugins/bootstrap3/css/bootstrap.min.css') ?>
	<?= link_tag('assets/plugins/font-awesome/css/font-awesome.min.css') ?>
    <?= link_tag('assets/plugins/pace/themes/white/pace-theme-flash.css') ?>
    <?= link_tag('assets/plugins/icheck/flat/green.css') ?>
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
			<?php flash() ?>
			<?= heading(ucwords(humanize($this->uri->segment(2))), 1) ?>

            <?= ul($breadcrumb, array('class' => 'breadcrumb')) ?>
		</section>

		<section class="content container-fluid">
			<?php flash() ?>
            
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Level
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="text-black"><label><input type="checkbox" class="level" name="level" data-value="admin" checked="checked"> Admin</label></a></li>
                        <li><a href="#" class="text-black"><label><input type="checkbox" class="level" name="level" data-value="user" checked="checked"> User</label></a></li>
                    </ul>
                </div>
                <select name="aktivitas" class="form-control select2" data-language="id" data-placeholder="Pilih Filter" multiple="multiple" style="width: 100%;display: none;">
                    <option value="login" selected>Login</option>
                    <option value="logout" selected>Logout</option>
                    <option value="unduh" selected>Unduhan</option>
                    <option value="baca" selected>Baca</option>
                    <option value="kategori" selected>Kategori</option>
                    <option value="buku" selected>Buku</option>
                </select>
                <span class="input-group-btn"><button type="button" class="btn btn-primary" id="refresh"><i class="fa fa-refresh"></i></button></span>
            </div>

            <br>

            <ul class="timeline">
                
            </ul>
            <button class="btn btn-default center-block" id="loadMore"><span class="fa fa-refresh"></span> Load More</button>
		</section>
	</div>

	<?php $this->load->view('admin/footer') ?>
  
</div>

<?= script('assets/plugins/jquery/jquery.min.js') ?>
<?= script('assets/plugins/select2/js/select2.min.js') ?>
<?= script('assets/plugins/select2/js/i18n/id.js') ?>
<?= script('assets/plugins/bootstrap3/js/bootstrap.min.js') ?>
<?= script('assets/plugins/pace/js/pace.min.js') ?>
<?= script('assets/plugins/icheck/icheck.min.js') ?>
<?= script('assets/plugins/moment/moment.min.js') ?>
<?= script('assets/plugins/moment/id.js') ?>
<?= script('assets/dist/js/adminlte.min.js') ?>
<?= script('assets/admin.js') ?>
<script type="text/javascript">
    $(document).ajaxStart(function() { Pace.restart(); }); 
    $(document).ready(function(){
        $('.select2').select2();
        $('input[type="checkbox"].level').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        })

        loadMore();

        $('.dropdown-menu').on('click.bs.bootstrap', function(e){
            e.stopPropagation();
        })

        $(window).scroll(function(){
            if($(window).scrollTop() == $(document).height() - $(window).height()){
                loadMore();
            }
        })

        var timer;
        $('#loadMore').click(loadMore);
        $('.level').on('ifToggled', filterPage);
        $('select[name="aktivitas"]').change(filterPage);
        $('#refresh').click(loadNewer);

        function getFilter(obj){
            var where = new Array();
            $(obj).each(function(){
                if($(this).is(':checked')){
                    where.push($(this).data('value'));
                }
            });
            return where;
        }

        function loadMore(){
            $('#loadMore > span').addClass('fa-spin');
            $.post(
                "<?php echo base_url('admin/laporan/get_log') ?>",
                {
                    last: $('.timeline > li:not(.time-label)').last().attr('id'),
                    aksi: $('select[name="aktivitas"]').val(),
                    nama_rule: getFilter('.level')
                },
                function(data,status){
                    var result = JSON.parse(data);
                    resultPage(result, 'append');
                    $('#loadMore > span').removeClass('fa-spin');
                    if(result == ''){
                        $('#loadMore').addClass('disabled');
                    }
                    else{
                        $('#loadMore').removeClass('disabled');
                    }
                }
            );
        }

        function loadNewer(){
            $.post(
                "<?php echo base_url('admin/laporan/get_log') ?>",
                {
                    first: $('.timeline > li:not(.time-label)').first().attr('id'),
                    aksi: $('select[name="aktivitas"]').val(),
                    nama_rule: getFilter('.level')
                },
                function(data,status){
                    var result = JSON.parse(data);
                    resultPage(result, 'after');
                }
            );
        }

        function filterPage(){
            clearTimeout(timer);
            timer = setTimeout(function() {
                $.post(
                    "<?php echo base_url('admin/laporan/get_log') ?>",
                    {
                        aksi: $('select[name="aktivitas"]').val(),
                        nama_rule: getFilter('.level')
                    },
                    function(data,status){
                        var result = JSON.parse(data);
                        resultPage(result, 'html');
                        $('#loadMore').removeClass('disabled');
                    }
                );
            }, 1500);
        }

        function resultPage(result, method){
            var html;
            if(method == 'html'){
                $('.timeline').html('');
            }
            if(method == 'after'){
                result.reverse();
            }
            $.each(result, function(){
                var newLabel = false;
                html = '';
                if(method == 'after'){
                    if ($('.time-label > span').first().html() != moment(this.waktu).format("DD MMM YYYY")) {
                        html += '<li class="time-label"><span class="bg-black">'+moment(this.waktu).format("DD MMM YYYY")+'</span></li>';
                        newLabel = true;
                    }
                }
                else{
                    if ($('.time-label > span').last().html() != moment(this.waktu).format("DD MMM YYYY")) {
                        html += '<li class="time-label"><span class="bg-black">'+moment(this.waktu).format("DD MMM YYYY")+'</span></li>';
                    }
                }
                html += '<li id="'+this.id_log+'">';
                html += icon(this.aksi);
                html += '<div class="timeline-item">';
                html += '<span class="time" data-time="'+this.waktu+'" data-toggle="tooltip" title="'+moment(this.waktu).format('dddd, DD MMMM YYYY HH:mm:ss')+' WIB"><i class="fa fa-clock-o"></i> '+moment(this.waktu).fromNow()+'</span>';
                html += '<span class="time" data-toggle="tooltip" title="Tipe Akses" style="cursor: pointer;"><span class="badge bg-olive">'+this.rule+'</span></span>';
                html += '<h3 class="timeline-header">';
                html += '<a href="<?php echo base_url('admin/user/lihat/') ?>'+this.id_user+'">'+this.nama_user+'</a> ';
                html += this.judul+'</h3>';
                if(this.keterangan != '') {
                    html += '<div class="timeline-body">';
                    html += '<p>'+this.keterangan+'</p>';
                    if(this.btn != '') {
                        html += '<a href="<?php echo base_url('admin') ?>'+this.btn+'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Lihat</a>';
                    }
                html += '</div>';
                }
                html += '</div>'
                html += '</li>';
                if(method != 'after'){
                    $('.timeline').append(html);
                }
                else if(newLabel){
                    $('.timeline').prepend(html);
                }
                else{
                    $('.timeline > li.time-label').first().after(html);
                }
            });

            setInterval(function(){
                $('[data-time]').each(function(){
                    $(this).html('<i class="fa fa-clock-o"></i> '+moment($(this).data('time')).fromNow());
                })
            }, 120000);

            $('[data-toggle="tooltip"]').tooltip();
        }

        function icon(str){
            if(str == 'login'){
                return '<i class="fa fa-sign-in bg-aqua"></i>';
            }
            else if(str == 'logout'){
                return '<i class="fa fa-sign-out bg-maroon"></i>';
            }
            else if(str == 'unduh'){
                return '<i class="fa fa-download bg-green"></i>';
            }
            else if(str == 'kategori'){
                return '<i class="fa fa-tags bg-orange"></i>';
            }
            else if(str == 'buku'){
                return '<i class="fa fa-book bg-blue"></i>';
            }
            else if(str == 'baca'){
                return '<i class="fa fa-eye bg-red"></i>';
            }
            else{
                return '<i class="fa fa-remove-o bg-gray"></i>';
            }
        }

    });
</script>
</body>
</html>