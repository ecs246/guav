<?php
/*
    echo $this->Form->create('Customerkey');
    echo $this->Form->input('customer');
    echo $this->Form->input('accesskey');
    echo $this->Form->input('Product',array('multiple'=>'checkbox',"div" => "required")); 
    echo $this->Form->input('expires',array('type'=>'date', 'dateFormat'=>'MDY'));
	echo $this->Form->input('notes');
*/
?>
<?php

$url = $this->Html->url(array('controller'=>'customerkeys',
    					'action'=>'index'));
$validateUrl = $this->Html->url(array('controller'=>'Customerkeys','action'=>'validatekey'));
$this->Html->scriptBlock("
 	 $(document).ready(function() { 
	 
     $('.cancel button').click(function(event) {
    	location.href='$url' 			
     });
     
 
 		$('#CustomerkeyAccesskey').blur(function(event) {
 				\$this = $(this);
 				$.ajax({ 
					type: 'POST',
				    url: '$validateUrl',
				data: {accesskey:$(this).val(),
					customerkey_id:'$customerkey_id'
					},
				success: function(data) {
					\$this.next('.error-message').remove();
					var errMsg = '';
					$.each($(data),function(i,el){
						errMsg += el;
					})  							
					$('<div class=\"error-message\">'+errMsg+'</div>').insertAfter(\$this);
					
				}
				
			});
		});		
     
     
	 })
",array('inline'=>false));
?>


	 	<?php echo $this->Form->create('Customerkey', array('class' => 'form')); ?>
        <?php echo $this->Form->input('customer'); ?>       
        <?php echo $this->Form->input('accesskey',array('maxlength'=>'40')); ?>
      
      <div id='products'><label>Product</label>  
      	<div class="groups">
      		
 <?php 
 	$keys =  array_keys($groupProducts);
    foreach ($keys as $key) {
    	// &#8594; &gt;
    	// <a href='#' class='product-expand'>&#8594;</a>
		echo "<div class='prod-group'>";
		echo "<span><input class='group-check' type='checkbox' name='_group'/>". $key . "<span class='group-count'></span>&nbsp;" .
			$this->Html->link(
		 				$this->Html->image('right.png', array('alt' => 'right', 'width' => '10', 'height' => '10')),
    					'',
						array('escape' => false, 'class' => 'product-expand'))
		.
		"</span>";
		echo $this->Form->input('Solution', array('div'=>array('class'=>'prod-items'),'label'=>false,'multiple' => 'checkbox','hiddenField'=>false,'options'=>$groupProducts[$key]));
		echo "</div>";
		echo "<div class='clearfix'></div>";
	}
       
 ?>
 		</div>
 </div>       
 		<div class="clearfix"></div>      


        <?php /* echo $this->Form->input('Product',array('multiple'=>'checkbox' ,'style' => 'float: left; display: inline') ); */?>
        <?php echo $this->Form->input('expires',array('class'=>'datepicker','type'=>'text'));?>
       	<?php echo $this->Form->input('notes',array('type'=>'textarea')); ?>
         
        
   	    
     
