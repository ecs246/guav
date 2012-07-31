
<?php 
	$this->Html->css('datatables_page.css',null, array('inline' => false));
	$this->Html->css('datatables_table.css',null,array('inline' => false));
	$this->Html->script(array('jquery.dataTables.js'), array('inline' => false));
			  

	$this->Html->scriptBlock("
		
			$(document).ready(function() {
				 oTable = $('#example').dataTable({
				 	//'sScrollY': '400px',
					'iDisplayLength': 100,
     	 		    'aaSorting': [[0,'asc']],
					'sPaginationType': 'two_button',
				});
			} );
	",array('inline'=>false));			

?>


<style type="text/css">
	#example_length
	{ display: none; }
	<?php if(count($solutions) < 99) {  
		echo "#example_paginate { display: none; }";
	} ?>
</style> 


<div id="title">
	Solutions
</div>
<div id="flash">
<?php echo $this->Session->flash(); ?>
</div>

<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
    <thead>
    <tr>
    	<th>Vertical</th>
    	<th>Solution</th>
        <th>Solution Category</th>
		<th>Media</th>
    </tr>
	</thead>
    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($solutions as $solution): ?>
	<tr class="gradeU">
		 <td class="center"><?php $productName = $solution['Solution']['product']; 
		 
		 	if($productName == "Wireless") {
		 		echo $this->Html->image('wifi.png');
		 	}
			if($productName == "Broadband") {
		 		echo $this->Html->image('signal.png');
		 	}
			if($productName == "Cable") {
		 		echo $this->Html->image('tv.png');
		 	}
		 	
		 	?></td>
		<td>
			 <?php 
			 	echo $this->Html->link($solution['Solution']['name'], array('action' => 'edit', $solution['Solution']['id']));?> 		
		</td>    	
        <td class="center"><?php echo $solution['Solution']['category']; ?></td>
        <td>
        	<?php
        		$video = $solution['Solution']['video_name'];
        		$slide = $solution['Solution']['slide_name'];
				
				if(!empty($video)) {
					echo $this->Html->image('video.png');
					echo "&nbsp;";
				}
				
				if(!empty($slide)) {
				    echo $this->Html->image('slides.png');
				}
				
				
        	?>
        	
        </td>
    </tr>
    <?php endforeach; ?>
    <tfoot>
    	<th>Vertical</th>
   		<th>Solution</th>
        <th>Solution Category</th>
        <th>Media</th>
	</tfoot>
</table>
</div>


 
