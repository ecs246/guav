		<?php 
	$this->Html->css('datatables_page.css',null, array('inline' => false));
	$this->Html->css('datatables_table.css',null,array('inline' => false));
	$this->Html->script(array('jquery.dataTables.js'), array('inline' => false));
			  
				
			$this->Html->scriptBlock("
				var handleIndexExpand = function() {
					$('tbody').on('click','.product-expand',function(event) {
					event.preventDefault();
					$(this).closest('.prod-group').find('.prod-items').toggle();
			
			
					})		
		
				}
		
				$(document).ready(function() {
				 oTable = $('#example').dataTable({
				 	//'sScrollY': '400px',
					'iDisplayLength': 100,
				});
				handleIndexExpand();
			} );
		",array('inline'=>false));

		?> 
		<style type="text/css">
			#example_length
			{ display: none; }
			<?php if(count($customerkeys) < 99) {  
					echo "#example_paginate { display: none; }";
			} ?>
		</style> 

	
<div id="title">
	Access Keys
</div>
<div id="flash">
<?php echo $this->Session->flash(); ?>
</div>

<div id="demo">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
	<tr>
		<th>Customer</th>
		<th>Key</th>
		<th>Expires</th>
		<th>Products</th>
		<th>Notes</th>
	</tr>
	</thead>

<?php foreach ($customerkeys as $customerkey) { ?>
	<tr class="gradeU">
 		<td class="center"><?php echo $customerkey['Customerkey']['customer']; ?></td>
 		<td class="center">
 			<?php 
 				echo $this->Html->link($customerkey['Customerkey']['accesskey'], array('action' => 'edit', $customerkey['Customerkey']['id']));?>
 			
 		</td>
 		<td class="center"><?php 
 				$expires = $customerkey['Customerkey']['expires']; 
				$parts = explode(" ", $expires);
				$fullMonth = $parts[0];
				$date = explode("-", $fullMonth);
				$monthNum = $date[1];
				$month = monthMap($monthNum);
				//echo $parts[0];
				echo $date[0]. "-" .$month . "-" . $date[2];
 			?></td>
 		<td><?php 
 			echo $this->App->displayCustomerIndexProducts($customerkey['Solution']);
 		?></td>
 		<td><?php echo $customerkey['Customerkey']['notes']; ?></td>
 	</tr>
<?php } ?>
<tbody>
	<tfoot>
		<th>Customer</th>
		<th>Key</th>
		<th>Expires</th>
		<th>Products</th>
		<th>Notes</th>
	</tfoot>
</table>
</div> <!-- datatable end -->
