<!DOCTYPE html>
<html class="seconardy-page">
	<head>
	
		<?php 
			  echo $this->Html->script(array('jquery-1.7.2.min.js'));
			  echo $this->Html->script(array('underscore-min.js'));
			  echo $this->Html->script(array('backbone-min.js'));
	  		  echo $this->Html->script(array('video.min.js'));
	  		  echo $this->Html->script(array('guavusdisp.js'));			  
	  		  echo $this->Html->css(array('video-js.css'));
			  echo $this->fetch('meta');
			  //echo $this->fetch('css');
			  echo $this->Html->css('cda.css');
			  echo $this->fetch('script');
			  
		?>
		 <script>
    		_V_.options.flash.swf = "/guavus/js/video-js.swf";
  		</script>
		<style type="text/css">
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				guavusdisp.slide.init();
				
				_V_("vidplayer", {}, function(){
      // Player (this) is initialized and ready.
    			});
			});
		</script>				
	</head>
	<body>
		<div id="wrap">
		<div id="main">
			<div id="current-section">wireless</div>
			<div id="next-section"></div>
			<div id="title-content">
				<h1></h1>
				<p id="notes" class="desc"></p>
			</div>				
			<div class="video-content">
					<video width="850" height="477" class="video-js vjs-default-skin"  controls id="vidplayer">
						<source type="video/mp4" src=""></source>
					</video> 
			</div>
		<div id="sidebar">
			<div id="tool-bar">
				<ul>
					<li class="download"><a id="download" href="">Download Presentation</a></li>
					<li class="slides"><a id="slide_name" href="" >Quick-view Slides</a></li>
					<li class="launch-demo"><a id="demo_url" href="" target="_blank">Launch Demo</a></li>
					<li class="feedback"><a id="feedback" href="" target="_blank">Tell us what you think</a></li>
				</ul>
			</div>
		</div>
		<div class="logo">
				<?php echo $this->Html->image('guavus.png'); ?>
		</div>
	</div></div>
	<div id="open-div">
			<a class="open-slide" href="#"><?echo $this->Html->image('open-arrow.png'); ?></a>
		</div>
		<div id="panel">
		<table>
				<tr>
					<td id="colleft">		
	<?php					
		$products = array();
		
		$count = array();
		$disp = ""; 
		foreach ($menuItems as $mitem) {
			$cat = $mitem['category'];
			$prod = $mitem['product'];

			if (isset($products[$prod][$cat]) ) {
				
				$products[$prod][$cat] .= "<dd><a class='menitem' href='#".$mitem['id']."'>".$mitem['name']."</a></dd>";
				#$count[$key] += 1;
			} else {
				$products[$prod][$cat] = "<dd><a class='menitem' href='#".$mitem['id']."'>".$mitem['name']."</a></dd>";				

				#$count[$key] = 1;
			}
					
		}
		$prodkeys = array_keys($products);
		foreach ($prodkeys as $prodkey) {
			$categories = $products[$prodkey];
			$catkeys = array_keys($categories);
			$catdisp = "";
			
			foreach($catkeys as $catkey) {
				$prod = $products[$prodkey][$catkey];
				
				$catdisp .= "<dt>$catkey</dt>
				$prod
				";
			}
			$closeImage = $this->Html->image('close-arrow.png');
			$disp .= "<div class='prod-group'>
						<a href='#' class='product-expand'>$prodkey</a>
						<dl class='prod-items'>
							$catdisp
							<a href='#' class='close-slide'>$closeImage</a>

							
						</dl>
					</div>";
		}
		echo $disp;					
		?>				
					</td>
					
				</tr>
			</table>
				
		</div>
<script>
				<?php	
					foreach ($menuItems as $mitem) {
						$id = $mitem['id'];
						$name = $mitem['name'];	
						$notes = json_encode($mitem['notes']);
//						$video_name = MEDIA . $mitem['video_name'];
//						$slide_name = MEDIA . $mitem['slide_name'];
						$video_name =  $mitem['video_name'];
						$slide_name =  $mitem['slide_name'];
				
						$demo_url = $mitem['demo_url'];
						$product = $mitem['product'];
						
						echo "guavusdisp.backbone.addModel({
							id:'$id',
							name:'$name',
							notes:$notes,
							video_name:'$video_name',
							slide_name:'$slide_name',
							demo_url:'$demo_url',
							product:'$product'
						})
						 
						";
				}	
				?>


			var logpath = '<?php echo $this->Html->url(array('action'=>'logdata','controller'=>'activity'));?>'
			var mediaPath = '<?php echo MEDIA;?>';
			var customerkey_id ='<?php echo $customerkey_id ?>'; 


			
			$(document).ready(function(){

				guavusdisp.backbone.init({logpath:logpath,
					mediaPath:mediaPath, 
					customerkey_id:customerkey_id});
			
			});	

		</script>
	</body>
</html>	
