function file_icon(type){
	if(type=='application/pdf'){
		return '<i class="fa fa-file-pdf-o"></i>';
	}
	else if(type.startsWith('image')){
		return '<i class="fa fa-file-photo-o"></i>';
	}
	else if(type.endsWith('officedocument.spreadsheetml.sheet')){
		return '<i class="fa fa-file-excel-o"></i>';
	}
	else if(type.endsWith('officedocument.wordprocessingml.document')){
		return '<i class="fa fa-file-word-o"></i>';
	}
	else{
		return '<i class="fa fa-file-o"></i>';
	}
}

$('[data-toggle="tooltip"]').tooltip();

$('#berkas').change(function(){
	var input = this;
	if (window.File && window.FileReader && window.FileList && window.Blob) {
		if (this.files[0].type.match(/image.*/)) {
			$(this).siblings('.preview').html(null);
			var fileReader = new FileReader();
			fileReader.onload = function(e) {
				var fileContents = fileReader.result;
				var html = '<img src="'+fileContents+'" class="img-responsive center-block" style="max-height: 300px;margin-top: 10px;">';
				html += '<button type="button" class="closePreview btn bg-red btn-sm btn-flat pull-right" style="margin: 10px auto;"><span class="fa fa-trash"></span> Hapus gambar</button>';
				$(input).siblings('.preview').append(html);

				$('.closePreview').click(function(){
					$('.preview').siblings('#berkas').val(null);
					$('.preview').html(null);
				})
			}
			fileReader.readAsDataURL(this.files[0]);
		}
		else {
			swal({
				'title': 'Tipe File Tidak Didukung',
				'icon': 'error'
			});
			$('.preview').html(null);
			$(this).val(null);
		}
	}
});


$('input[name="pdf"]').change(function(){
	$(this).siblings('.preview').html(null);
	$.each($(this)[0].files, function(){
		if(this.type=='application/pdf'){
			$('input[name="pdf"]').siblings('.preview').append('<ul class="mailbox-attachments"><li style="display: block;width: 100%;margin-top: 10px;"><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span><div class="mailbox-attachment-info"><a href="#" class="mailbox-attachment-name"><p style="word-break: break-all;"><i class="fa fa-paperclip"></i> '+this.name+'</p></a><span class="mailbox-attachment-size clearfix"><p>'+(this.size/1048576).toFixed(2)+' MB</p></span></div></a></li></ul>');
		}
		else{
			$('input[name="pdf"]').val(null);
			swal({
				'title': 'Tipe File Tidak Didukung',
				'icon': 'error'
			});
		}
	});
});

$('input[name="lampiran[]"]').change(function(){
	console.log($(this));
	$('#lampiran-info').remove();
	$('#right-side').append('<div class="box box-primary" id="lampiran-info"><div class="box-header with-border"><h3 class="box-title"><span class="fa fa-file-o"></span> Informasi Lampiran</h3></div><div class="box-body"><ul class="mailbox-attachments"></ul></div></div>');
	$.each($(this)[0].files, function(){
		if(true){
			$('#lampiran-info .mailbox-attachments').append('<li><span class="mailbox-attachment-icon">'+file_icon(this.type)+'</span><div class="mailbox-attachment-info"><a href="#" class="mailbox-attachment-name"><p style="word-break: break-all;"><i class="fa fa-paperclip"></i> '+this.name+'</p></a><span class="mailbox-attachment-size clearfix"><p>'+(this.size/1048576).toFixed(2)+' MB</p></span></div></a></li>');
		}
		else{
			$('input[name="lampiran[]"]').val(null);
			swal({
				'title': 'Tipe File Tidak Didukung',
				'icon': 'error'
			});
		}
	});
});

function isScriptIncluded(str){
    var i = 0;
    var val = '';
    $("script").each(function(){
        val = $(this).attr('src');
        if(val != undefined){
            if(val.indexOf(str) > 0){
                i++;
            }
        }
    });
    if(i > 0){
        return true;
    }
    else{
        return false;
    }
}

if(isScriptIncluded('moment')){
	fromNow();
	setInterval(fromNow(), 360000);
	function fromNow(){
		$('.moment').each(function(){
			$(this).html(moment($(this).data('time')).fromNow());
		})
	}
}

if(isScriptIncluded('dataTables')){
	$('table.dataTable').each(function() {
		var config = {
			"language" : {
				"sProcessing":   "Sedang memproses...",
				"sLengthMenu":   "Tampilkan _MENU_ entri",
				"sZeroRecords":  "Tidak ditemukan data yang sesuai",
				"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
				"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
				"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
				"sInfoPostFix":  "",
				"sSearch":       "Cari:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "Pertama",
					"sPrevious": "Sebelumnya",
					"sNext":     "Selanjutnya",
					"sLast":     "Terakhir"
				}
			}
		}
		if($(this).hasClass('serverSide')){
			config["processing"] = true;
			config["serverSide"] = true;
			config["ajax"] = $(this).data('ajax');
			config["order"] = [[0, "desc" ]];
		}
		if($(this).data('end-search')!=undefined){
			config["columns"] = [];
			config["columns"][$(this).data('end-search')] = {"searchable":false};
		}
		$(this).DataTable(config);
	});
}