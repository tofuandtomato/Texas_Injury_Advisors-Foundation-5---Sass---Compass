// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

$(document).foundation();

$(document).ready(function() {
	$('select').selectBox({
	    mobile: true,
	    menuSpeed: 'fast',
	    menuTransition: 'slide'
	});

	$('.worth-list li').click(function() {
		$('.worth-list li .title').removeClass('active');
		$(this).find('.title').addClass('active');
		var verdict = $(this).find('.verdict').html();
		$('#verdicts').html(verdict);
		return false;
	})
});
