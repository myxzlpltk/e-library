(function ($) {
    
    'use strict';
    
    $.fn.LogsParser = function(data){
        loadViewLogsParser(this, data.selectLogs);
        readFile();
        $('#LogsParserSelect').change(function(){load(data.getUrl);});
        $('#LogsParserRefresh').click(function(){load(data.getUrl);});
        $('#LogsParserDownload').click(function() {
            if($('#LogsParserSelect').val() !== ''){
                swal({
                    title: 'Mengunduh Log?',
                    text: $('#LogsParserSelect').val()+' akan di unduh',
                    icon: 'success',
                    buttons: true
                }).
                then((willDownload) => {
                    if(willDownload){
                        window.location = data.downloadUrl+$('#LogsParserSelect').val()+'?type=download';
                    }
                });
            }
            else{
                errorMessage('Pilih sebuah file terlebih dahulu.');
            }
        });
        $('#LogsParserDelete').click(function(){
            if($('#LogsParserSelect').val() !== ''){
                swal({
                    title: 'Hapus Log',
                    text: 'Log yang dihapus tidak dapat dikembalikan',
                    icon: 'error',
                    buttons: true,
                    dangerMode: true
                }).
                then((willDownload) => {
                    if(willDownload){
                        window.location = data.deleteUrl+$('#LogsParserSelect').val()+'?type=delete';
                    }
                });
            }
            else{
                errorMessage('Pilih sebuah file terlebih dahulu.');
            }
        });
    };

    function readFile(){
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            $('#LogsParserInput').change(function() {
                if (this.files[0].type.match(/text.*/)) {
                    var fileReader = new FileReader();
                    fileReader.onload = function(e) {
                        var fileContents = fileReader.result;
                        parseResult(fileContents);
                    };
                    fileReader.readAsText(this.files[0]);
                }
                else {
                    errorMessage("Tipe file tidak didukung");
                    $('#LogsParserInput').val('');
                }
            });
        }
        else {
            $('#LogsParserInput').parent().html('<div class="callout callout-info no-margin"><em>Browser anda tidak mendukung FileReader</em></div>');
        }
    }

    function load(url, selector){
        if($('#LogsParserSelect').val() !== ''){
            $.ajax({
                url: url+$('#LogsParserSelect').val(),
                success: function(result){
                    $('#LogsParserInput').val(null);
                    parseResult(result);
                },
                error: function(xhr,status,error){
                    errorMessage('Gagal mengirim permintaan file. Silahkan coba lagi nanti.');
                }
            });
        }
        else{
            $('li.error').remove();
            $('.timeline').append('<li class="error"><i class="fa fa-clock-o bg-gray"></i></li>');
        }
    }

    function parseResult(result){
        var data = [],list,item,time;
        list = result.split("ERROR - ");
        list.reverse().pop();
        console.log(list);
        $.each(list, function(i){
            item = this.split(' --> ');
            data[i] = {datetime: '', title: '', error: '', more: ''};
            $.each(item, function(index){
                if(index === 0){
                    data[i].datetime = this;
                }
                else if(index == 1){
                    data[i].title = this;
                }
                else if(index == 2){
                    data[i].error = this;
                }
                else{
                    data[i].more = this;
                }
            });
        });
        process(data);
    }

    function process(result){
        $('li.error').remove();
        var html;
        $.each(result, function(){
            html = '';
            html += '<li class="error">';
            html += color(this.title);
            html += '<div class="timeline-item" style="border-left: 5px solid #dd4b39;">';
            html += '<span class="time text-blue"><span class="badge bg-red">ERROR</span>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> '+moment(this.datetime, 'YYYY-MM-DD hh:mm:ss').fromNow()+'</span>';
            html += '<h3 class="timeline-header">'+this.title+'</h3>';
            if(this.error !== ''){
                html += '<div class="timeline-body">'+this.error+this.more+'</div>';
            }
            html += '</div>';
            html += '</li>';
            $('.timeline').append(html);
        });
        $('.timeline').append('<li class="error"><i class="fa fa-clock-o bg-gray"></i></li>');
    }

    function color(title){
        if(title == 'Severity: Notice'){
            return '<i class="fa fa-info bg-blue"></i>';
        }
        else if(title == 'Severity: error'){
            return '<i class="fa fa-minus-circle bg-red"></i>';
        }
        else if(title == 'Severity: Warning'){
            return '<i class="fa fa-warning bg-yellow"></i>';
        }
        else if(title.startsWith('Query error')){
            return '<i class="fa fa-database bg-maroon"></i>';
        }
        else{
            return '<i class="fa fa-warning bg-purple"></i>';
        }
    }

    function loadViewLogsParser(selector, data){
        var input = '<div class="form-group input-group col-lg-4 col-md-6">';
        input += '<span class="input-group-addon"><i class="fa fa-file-text text-primary"></i></span>';
        input += '<input type="file" id="LogsParserInput" name="berkas" class="form-control">';
        input += '<div class="input-group-btn">';
        input += '</div>';
        input += '</div>';
        selector.append(input);
        selector.append('<ul class="timeline"></ul>');
        var box = '';
        box += '<li class="time-label">';
        box += '<div class="input-group col-xs-8 col-sm-6 col-lg-4">';
        box += '<select class="select2 form-control" id="LogsParserSelect">';
        box += '<option selected="selected" value="">Tanggal</option>';
        $.each(data, function(){
            box += '<option value="'+this+'">'+this+'</option>';
        });
        box += '</select>';
        
        box += '<div class="input-group-btn">';
        box += '<button type="button" class="btn btn-primary" id="LogsParserRefresh"><i class="fa fa-refresh"></i></button>';
        box += '<button type="button" class="btn btn-success" id="LogsParserDownload">';
        box += '<i class="fa fa-download"></i>';
        box += '</button>';
        box += '<button type="button" class="btn btn-danger" id="LogsParserDelete">';
        box += '<i class="fa fa-trash"></i>';
        box += '</button>';
        box += '</div>';

        box += '</li>';
        box += '<li class="error"><i class="fa fa-clock-o bg-gray"></i></li>';
        $('.timeline').append(box);
        $('select.select2').select2();
    }

    function errorMessage(error){
        if(error !== undefined){
            swal(error,{icon:'error'});
        }
    }
}(jQuery))