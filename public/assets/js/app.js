(function (code) {
	code(window.jQuery, window, document);
}(function ($, window, document) {
	$(document).on('click', '#button-up', function(){
		$('html, body').animate({
			scrollTop: 0
		}, 300);
	});
	if ($(window).width() > 991)
    {
    	$('.section--interior__content .nav-link').click(function(){
		$("#navExtraContent").css("height", '1px');
		var contentHeight = $(".section--interior__content").height();
		$("#navExtraContent").css("height", contentHeight);
		});	
		var scrolled=0;
		$(".downScroll").on("click" ,function(){
		    scrolled=scrolled+ $('#navExtraContent').height();
			$(".section--interior #navExtraContent").animate({
			   scrollTop:  scrolled
			});
			if(scrolled >= $('#navExtraContent .tab-pane.active').height() - $('#navExtraContent').height()) {
		       $('.downScroll').addClass("disabled");
		   }
		});
    }
    
	dataBackground();

    function dataBackground(){
		$('*[data-background]').each(function(){
			var element = $(this);
			var bgUrl = element.attr('data-background');
			element.css('background-image','url('+bgUrl+')');
			element.css('background-repeat','no-repeat');
			if(hasAttr(element,'data-background-repeat')){
				element.css('background-repeat',element.attr('data-background-repeat'));
			}
			if(hasAttr(element,'data-background-size')){
				element.css('background-size',element.attr('data-background-size'));
			}
			if(hasAttr(element,'data-background-attachment')){
				element.css('background-attachment',element.attr('data-background-attachment'));
			}
			if(hasAttr(element,'data-background-position')){
				element.css('background-position',element.attr('data-background-position'));
			}
		});
	}

	var match = new bootstrap_equalizer();
	match.init();
	
	function bootstrap_equalizer(){
	  this.init = function(){
	    var $this = this;
	    setTimeout(function(){
	      $this.match();
	    },300);
		  setTimeout(function(){
	      $this.match();
	    },1000);

		setTimeout(function(){
	      $this.match();
	    },5000);

		setTimeout(function(){
	      $this.match();
	    },8000);

	    $(window).resize(function(){ $this.match(); });

	    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	      $this.match();
	    });

			$('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
				var __this = $(this);
				$('html,body').animate({
		        scrollTop: $('.section--features').offset().top
		    }, 300);
	      $this.match();
				setTimeout(function(){
		      $this.match();
		    },500);
				setTimeout(function(){
		      $this.match();
		    },1000);
	    });
	  }
	  this.match = function(){
	    $('[data-equalizer]').each(function(){
	      var wrapper = $(this), maxHeight = new Array(), breakpoint, levels = new Array();

	      if(wrapper.hasClass('equalizer-done')){wrapper.removeClass('equalizer-done');}

	      switch(wrapper.attr('data-equalizer-mq')){
	        case 'xs':
	          breakpoint = 0;
	          break;
	        case 'sm':
	          breakpoint = 767;
	          break;
	        case 'md':
	          breakpoint = 991;
	          break;
	        case 'lg':
	          breakpoint = 1023;
	          break;
	        default:
	          breakpoint = 0;
	          break;
	      }

	      wrapper.find('[data-equalizer-watch]').css('height','auto');

	      if($(window).width() > breakpoint){

			  wrapper.find('[data-equalizer-watch]').each(function() {
				  var item = $(this)
				  var level = item.attr('data-equalizer-level');
				  if(level == null){
					  item.attr('data-equalizer-level',1)
				  }
			  });

	        wrapper.find('[data-equalizer-watch]').each(function() {
	          var item = $(this), level;

	          if(hasAttr(item,'data-equalizer-level')){
	            level = parseInt(item.attr('data-equalizer-level'));

	            if(!(levels.includes(level))){
	              levels.push(level);
	            }
	          }
	        });
	        if(levels.length == 0){
	          levels.push(1);
	          wrapper.find('[data-equalizer-watch]').attr('data-equalizer-level',1)
	        }

	        for(var i = 0; i< levels.length; i++) {
	          maxHeight.push(0);
	          wrapper.find('[data-equalizer-level="'+levels[i]+'"]').each(function() {
	            var item = $(this);
	            if(this.clientHeight > maxHeight[i]){
	              maxHeight[i] = this.clientHeight;
	            }
	          });

	          wrapper.find('[data-equalizer-level="'+levels[i]+'"]').each(function() {
	            var item = $(this);
	            item.css({'height':maxHeight[i], 'min-height':'fit-content'});
	          });
	        }
	      }

	      wrapper.addClass('equalizer-done');
	    });
	  }
	}

	$('.owl-carousel-two').owlCarousel({
		loop: true,
		autoplay: true,
		margin: 44,
		nav: false,
		navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
		dots: true,
		responsive: {
			0: {
				items: 1,
				margin: 44,
			},
			768: {
				items: 2,
				margin: 44,
			},
		}
	});

	$('.owl-carousel-three').owlCarousel({
		loop: true,
		margin: 90,
		autoplay: true,
		nav: true,
		navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	$('.owl-carousel-four').owlCarousel({
		loop: false,
		margin: 20,
		autoplay: true,
		nav: false,
		navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
		dots: true,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 4
			}
		}
	});

	$('.owl-carousel-five').owlCarousel({
		loop: true,
		margin: 15,
		autoplay: true,
		nav: false,
		dots: false,
		center: true,
		responsive: {
			0: {
				items: 1
			},
			575: {
				items: 2
			},
			768: {
				items: 3
			},
			1200: {
				items: 5
			}
		}
	});
	

	$("#form_contact").submit(function (event) {
		$(".msg-error").addClass("d-none");
		$(".msg-error").empty();
		$("#success-msg").addClass("d-none");
		$("#success-msg").empty();
		event.preventDefault();
		const name_error = $("#name_error").val();
		const email_error = $("#email_error").val();
		const message_error = $("#message_error").val();
		let formData = new FormData(this);
		$.ajax({
			url: 'ajax/insert_contact_message',
			type: 'POST',
			data: formData,
			processData: false,
            contentType: false, 
			success: function(response) {
				$('input, textarea').val('');
				$("#success-msg").removeClass("d-none");
				$("#success-msg").text(response.success);
			},
			error: function(xhr, status, error) {
				console.log(xhr, status, error);
				let errors = xhr.responseJSON;
				for (let key in errors) {
					if (errors.hasOwnProperty(key)) {
						$(`#${key}_error`).removeClass("d-none");
						$(`#${key}_error`).text(errors[key]);
					}
				}
				
			}
		});
	});

	$("button.like,a.block__favorite").click(function(){
		//$(this).addClass("text-danger");
		//$(this).toggleClass("text-danger");
		const id = this.attributes["data-id"].value;
		const type = this.attributes["data-type"].value;
		//return console.log(id,type);
		$(`#recent_offers button.like[data-type='offer'][data-id='${id}']`).toggleClass("text-danger");
		$(`#popular_offers button.like[data-type='offer'][data-id='${id}']`).toggleClass("text-danger");
		const link_buttom = $(`a.block__favorite[data-type=${type}][data-id='${id}']`);
		link_buttom.toggleClass("text-danger");
		link_buttom.toggleClass("liked_company_offer");

		$.ajax({
			url: 'ajax/like_offer_or_company',
			type: 'POST',
			data: {
				id,
				type
			},
			// processData: false,
            // contentType: false, 
			success: function(response) {
				console.log(response);
				
			},
			error: function(xhr, status, error) {
				console.log(xhr, status, error);
			}
		});
	  });

	  $.ajax({
		url: 'ajax/get_liked_offers_by_ip/offer',
		type: 'GET',
		success: function(response) {
			if(response.offers_liked === null) return;
			response.offers_liked.map(e=>{
				//$("button.like[data-type='offer']").addClass("text-danger");
				$(`#recent_offers button.like[data-type='offer'][data-id='${e.offer_id}']`).addClass("text-danger");
				$(`#popular_offers button.like[data-type='offer'][data-id='${e.offer_id}']`).addClass("text-danger");
				$(`a.block__favorite[data-type="offer"][data-id='${e.offer_id}']`).toggleClass("text-danger");
				$(`a.block__favorite[data-type="offer"][data-id='${e.offer_id}']`).toggleClass("liked_company_offer");
			});
		},
		error: function(xhr, status, error) {
			console.log(xhr, status, error);
		}
	});
	$.ajax({
		url: 'ajax/get_liked_offers_by_ip/company',
		type: 'GET',
		success: function(response) {
			console.log();
			if(response.offers_liked === null) return;
			response.offers_liked.map(e=>{
				//$("button.like[data-type='offer']").addClass("text-danger");
				$(`#recent_offers button.like[data-type='offer'][data-id='${e.offer_id}']`).addClass("text-danger");
				$(`#popular_offers button.like[data-type='offer'][data-id='${e.offer_id}']`).addClass("text-danger");
				$(`a.block__favorite[data-type="company"][data-id='${e.offer_id}']`).toggleClass("text-danger");
				$(`a.block__favorite[data-type="company"][data-id='${e.offer_id}']`).toggleClass("liked_company_offer");
			});
		},
		error: function(xhr, status, error) {
			console.log(xhr, status, error);
		}
	});
	$(".shareModal").click(function() {
		console.log(this);
		$("#shareModal").modal("show");
	});
}));