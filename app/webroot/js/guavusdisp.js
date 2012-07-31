var guavusdisp = {}


guavusdisp.slide = function() {
	var vplayer = "";
	var timer = "";
	var slidestate = "";


	
	var handleIndexExpand = function() {
		$('#colleft').on('click','.product-expand',function(event) {
			event.preventDefault();
			$('#panel').find('.prod-items').hide();
			$(this).closest('.prod-group').find('.prod-items').toggle('fast');
	
	
		})		

	}
	
	var closeit = function () {
			if (timer) clearTimeout(timer);
			$("#panel").toggle("fast");
			$("#open-div").css('display','block');
			if ($('#vidplayer').data('reload') == true) {
				$('#vidplayer').data('reload',false);
				vplayer.play();
			}	
			slidestate = 'close';

		
	}	
		
	
	var handleAutoClose = function() {
		

		
		$('#panel table').on('mouseenter',function() {
			if (timer) clearTimeout(timer);
		}) 
		$('#panel table').on('mouseleave',function() {

		
			if (slidestate != 'close') {
				//	timer = setTimeout("$('.close-slide').trigger('click')", 2000)
timer = setTimeout(closeit, 2000)								
					}

			}) 
		}		
										
		var handleOpen = function() {
			$(".open-slide").click(function(event){

			if (timer) clearTimeout(timer);


	        $("#panel").toggle("fast");
	        $("#open-div").css('display','none');
			slidestate = 'open';


	        return false;
	    });
		
	} 
	

	
	
	var handleClose = function() {
		$(".close-slide").click(function(event){


			closeit();

			return false;
		});
		
	}
	var handleCenter = function() {
		$openDiv = $('#open-div');
		var top = ($(window).height() - $openDiv.outerHeight()) / 2;
		top = top < 0 ? 10:top;
		$openDiv.css('top',top);
		$openDiv.css('display','block');
		$panelDiv = $('#panel');
		var ptop = ($(window).height() - $panelDiv.outerHeight()) / 2;
		ptop = ptop < 0 ? 0:ptop;
		$panelDiv.css('top',ptop);

		
	}
	
	var handleMenuItemClick =function() {
		$('.prod-items').on('click','a',function(event) {

		
		/*
		 set video status to reload in order to trigger auto play back on 
		 menu close
		 */
		$('#vidplayer').data('reload',true);
		});
	}
	return {
		init:function() {
			vplayer = _V_("vidplayer");
			handleCenter();
			handleOpen();
			handleClose();	
			handleIndexExpand();
			handleMenuItemClick();
			handleAutoClose();
		}
	}
}();


guavusdisp.backbone = function() {
	var itemsList = "";
	var itemOrderList = {};

	var logpath = '';
	var mediaPath = '';
	var customerkey_id =''; 
	var mplayer = "";
	var Solution = Backbone.Model.extend({
		
	});


	var Solutions = Backbone.Collection.extend({

			model: Solution
		})			

	var solutionsList = new Solutions();


	var SolutionView = Backbone.View.extend({
	
		el:'#wrap', 
		nextLink:function() {
			
			var id = this.model.get('id');
			var nextInd = itemOrderList['#' + id] +1;
			$('#next-section').html('');
			if (nextInd < itemsList.length) {
				$('#next-section').html('<a href="'+$(itemsList[nextInd]).attr('href')+'">Next ('+$(itemsList[nextInd]).text()+')</a>')
				
			}
				

			
		},
		render:function() {
					
			var product_id = this.model.get('id');
			var middle = '/' + customerkey_id + '/' + product_id +'?resource=';
			mplayer.pause(); 
			$(this.el).find('h1').html(this.model.get('name'));
			$(this.el).find('#notes').html(this.model.get('notes'));
			
			$(this.el).find('#current-section').html(this.model.get('product'));
			$(this.el).find('#download').attr('href',logpath + '/'+ 1 + middle + encodeURIComponent(this.model.get('video_name')));					
			$(this.el).find('#slide_name').attr('href',logpath + '/' +2  + middle +encodeURIComponent(this.model.get('slide_name')));
			$(this.el).find('#demo_url').attr('href',logpath + '/' + 3 + middle +encodeURIComponent(this.model.get('demo_url')));
			$(this.el).find('#feedback').attr('href',logpath + '/' + 4 + middle +encodeURIComponent('wschweitzer00@gmail.com'));
			
			mplayer.src(mediaPath +this.model.get('video_name'));
			$('.vjs-big-play-button').show();
			mplayer.load();
			$('body').data('product',this.model.get('name'));
			this.nextLink();
			
//					$(this.el).find('video>source')[0].src = this.model.get('video_name');
//					$(this.el).find('video')[0].load();
		}
	})
	
		SolutionRouter = Backbone.Router.extend({
				routes: {
					":id" : "changeSolution",
					"" : "renderIndex"
				}, 
				initialize:function() {
				this.slist = solutionsList;

				
			},
				changeSolution: function(id) {
					
					sview = new SolutionView({model:this.slist.get(id)});
					
					sview.render();
				},
				renderIndex: function() {
					id = $('.prod-items dd a').first().attr('href').split("#")[1]
					sview = new SolutionView({model:this.slist.get(id)});
					
					sview.render();	
				}
			});
	
	
	
	return {
		addModel:function(ob) {
			solutionsList.add(ob);
		},
		
		init:function(args) {
			mplayer = _V_("vidplayer");
			logpath = args['logpath'];
			mediaPath = args['mediaPath'];
			customerkey_id =args['customerkey_id']; 
			itemsList = $('.prod-items a.menitem');
			itemOrderList = {};
			$.each(itemsList, function(i,el) {
				itemOrderList[$(el).attr('href')] = i; 
			} )
			new SolutionRouter();
			Backbone.history.start();			
		
		}
	}
}();
