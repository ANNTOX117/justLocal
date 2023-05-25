(function (code) {
	code(window.jQuery, window, document);
}(function ($, window, document) {

	$(document).on('click', '#button-up', function(){
		$('html, body').animate({
			scrollTop: 0
		}, 300);
	});

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
		margin: 80,
		autoplay: true,
		nav: false,
		navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
		dots: false,
		responsive: {
			0: {
				items: 1,
				margin: 20,
			},
			768: {
				items: 2,
				margin: 20,
			},
			1200: {
				items: 2,
				margin: 20,
			},
			1399: {
				items: 2,
				margin: 20,
			}
		}
	});

	$('.owl-carousel-three').owlCarousel({
		loop: true,
		margin: 20,
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
		loop: true,
		margin: 10,
		autoplay: true,
		nav: false,
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

	$("#filter-searching ul li a").on("click", function() {
			$("#filter-searching ul li a").removeClass("active");
			$(this).addClass("active");
	});
		  
	$('#provincie_all').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#stad_all option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+"/3",
            success: function(options) {
				$('#stad_all option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#stad_all').append(option);
				})
            }
        });
    });
	
	$('#province_bed').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#stad_bed option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+"/1",
            success: function(options) {
				$('#stad_bed option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#stad_bed').append(option);
				})
            }
        });
    });

	$('#province_web').change(function() {
		console.log("here");
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#stad_web option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"cities_by_provinces/"+selectedValue+"/2",
            success: function(options) {
				$('#stad_web option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#stad_web').append(option);
				})
            }
        });
    });

	$('#stad_all').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#branche_all option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"branches_by_city/"+selectedValue+"/3",
            success: function(options) {
				$('#branche_all option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#branche_all').append(option);
				})
            }
        });
    });

	$('#stad_bed').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#branche_bed option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"branches_by_city/"+selectedValue+"/1",
            success: function(options) {
				$('#branche_bed option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#branche_bed').append(option);
				})
            }
        });
    });

	$('#stad_web').change(function() {
        let selectedValue = $(this).val();
		if (selectedValue === "") {
			return $('#branche_web option').not(':first-child').remove();//$('#companyCities').empty();
		}
        $.ajax({
            type: "GET",
            url:'/ajax/' +"branches_by_city/"+selectedValue+"/2",
            success: function(options) {
				$('#branche_web option').not(':first-child').remove();
				const cities = JSON.parse(options);
				cities.map(e=>{
					let option = $('<option/>', {
						value: e.id,
						text: e.name
					});
					$('#branche_web').append(option);
				})
            }
        });
    });

	$('#close_session').on('click', function(e) {
		e.preventDefault(); // prevent the default action of the link
		
		// Ask the user if they are sure they want to close the session
		Swal.fire({
			title: 'Are you sure?',
			text: 'You will be logged out and your session will be destroyed!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, log me out!'
		}).then((result) => {
		  if (result.isConfirmed) {
			window.location.href = '/logout';
			//window.location.href = '/login'; // replace with your login URL
			}
		});
	  });
}));
