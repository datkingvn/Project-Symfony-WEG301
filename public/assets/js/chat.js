$(function() {
	'use strict'
	$('#chatActiveContacts').lightSlider({
		autoWidth: true,
		controls: false,
		pager: false,
		slideMargin: 12
	});
	if (window.matchMedia('(min-width: 992px)').matches) {
		new PerfectScrollbar('#ChatList', {
			suppressScrollX: true
		});	
		const ChatBody = new PerfectScrollbar('#ChatBody', {
			suppressScrollX: true
		});
		const Chatmain = new PerfectScrollbar('.chat-main', {
			useBothWheelAxes:true,
			suppressScrollX:true,
		});
		$('#ChatBody').scrollTop($('#ChatBody').prop('scrollHeight'));
	}
	$('.main-chat-list .chat-item').on('click touch', function() {
		$(this).addClass('selected').removeClass('new');
		$(this).siblings().removeClass('selected');
		if (window.matchMedia('(max-width: 991px)').matches) {
			$('body').addClass('main-content-body-show');
			$('html body').scrollTop($('html body').prop('scrollHeight'));
		}
	});
	$('[data-bs-toggle="tooltip"]').tooltip();
	$('#ChatBodyHide').on('click touch', function(e) {
		e.preventDefault();
		$('body').removeClass('main-content-body-show');
	})
});
