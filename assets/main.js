$(document).ready(function() {
	/* INITIALIZE VARIABLE */
	var suggestionstimeout;

	/* INITIALIZE UI */
	$(".dropdown-trigger").dropdown({
		hover: false
	});
	$('.sidenav').sidenav();
	$('.collapsible').collapsible();
    $('.materialboxed').materialbox();
    $('select').formSelect();
    $('input.autocomplete').autocomplete({
    	data: {}
    });
    $('[data-toggle="tooltip"]').tooltip();

	$('.preloader-background').delay(1700).fadeOut('slow');
	$('.preloader-wrapper').delay(1700).fadeOut();

	/* INITIALIZE EVENTS */
	$('#scrollToTop').click(function(){
		$(window).scrollTop(0);
	});

	$('.open-boxsearch').click(function(){
		$('.sidenav').sidenav('close');
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).siblings('.aktif').addClass('active');
			$(this).siblings('.active').removeClass('aktif');
			$('#searchBox').fadeOut();
		}
		else{
			$(this).addClass('active');
			$(this).siblings('.active').addClass('aktif');
			$(this).siblings('.active').removeClass('active');
			$('#searchBox').slideDown();
		}
	});

	$('#closeSearchBox').click(function(){
		if($('.open-boxsearch').hasClass('active')){
			$('.open-boxsearch').removeClass('active');
			$('.open-boxsearch').siblings('.aktif').addClass('active');
			$('.open-boxsearch').siblings('.active').removeClass('aktif');
			$('#searchBox').fadeOut();
		}
		else{
			$('.open-boxsearch').addClass('active');
			$('.open-boxsearch').siblings('.active').addClass('aktif');
			$('.open-boxsearch').siblings('.active').removeClass('active');
			$('#searchBox').slideDown();
		}
	});

	$('.card-alert .close').click(function(){
		$(this).parent('.card-alert').fadeOut();
	});

	$('#searchInput, #filterJudul').on('keyup', function(event) {
		var input = this;
		clearTimeout(suggestionstimeout);
		suggestionstimeout = setTimeout(function() {
			$.ajax({
				url: $(input).data('autocomplete')+$(input).val(),
				type: 'GET',
				dataType: 'json',
				success: function(result,status,xhr){
					$('input.autocomplete').autocomplete('updateData', result);
					$(input).blur().focus();;
				}
			});
		}, 1300);
	});

	$('.form-validation .input-field input').change(function(){
		$(this).removeClass('error');
		$(this).removeClass('invalid');
		$(this).siblings('.helper-text').remove();
	});

	if(isScriptIncluded('moment')){
		fromNow();
		setInterval(fromNow(), 360000);
		function fromNow(){
			$('.moment').each(function(){
				$(this).html(moment($(this).data('time')).fromNow());
			})
		}
	}

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

/* END OF INITIALIZE UI */