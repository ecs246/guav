<?php

$url = $this->Html->url(array('controller'=>'solutions',
    					'action'=>'index'));
$this->Html->scriptBlock("
 	 $(document).ready(function() { 
	 
     $('.cancel button').click(function(event) {
    	location.href='$url' 			
     });
	 })
",array('inline'=>false));


    $this->Html->scriptBlock("
    $(document).ready(function() { 
	   	$('#SolutionCategory').autocomplete({
	  		source:".$jscatarray." ,	
	  		search:function() {
	  			$('#showall').data('state','on');	
	  		}	,        
	     	minLength:0
	     	
		});
		$('#showall').on('click', function () {
		   if ($(this).data('state') != 'on') {
		 	   $('#SolutionCategory').autocomplete('search' , '');
		 	   $(this).data('state','on');
		 	} else {
		 		$('#SolutionCategory').autocomplete('close');
		 		$(this).data('state','off');
		 	}	   
	 	   return false;
		});
   });
   
   ",array('inline'=>false));

?>
  
  
   <?php
   		
   		echo $this->Form->create('Solution',array('type' => 'file','class'=>'form')); 
        echo $this->Form->input('name');
		$products = array('Wireless'=>'Wireless','Broadband'=> 'Broadband','Cable'=>'Cable');
		//$options = array('product1'=>'product11','product2'=>'product22','product3'=>'product3');
        //echo $this->Form->input('products',array('options'=>$options,'multiple'=>'checkbox'));
		//$options = array('cat1' => 'cat11', 'cat2' => 'cat22'); 
    	echo $this->Form->input('product',array('options'=>$products,'type'=>'radio',
    	'before' => '<label>Verticals</label><span>',
    	'fieldset'=>false,'legend'=>false,'after'=>'</span>')); 
		
		
		//$options = array('network' => 'Network Operations', 'security' => 'Security', 'dashboard' => 'Dashboards', 'cem' => 'CEM & Marketing'); 
		
		//echo $this->Form->input('category',array('options'=>$options)); 
		#$options = array('cat1' => 'cat11', 'cat2' => 'cat22'); 
		$arrowDown = $this->Html->image('arrow-down.png', array('height' => '20', 'width' => '20'));
		echo $this->Form->input('category',array('after' =>'<a href="#" id="showall">' . $arrowDown . '</a>'));
	
		?>
		 
	<?php	
	    echo $this->Form->input('demo_url');
		echo $this->Form->input('slide', array('type' => 'file'));
		echo $this->Form->input('video', array('type' => 'file'));
		echo $this->Form->input('notes',array('type'=>'textarea'));
		echo "<div class='buttons'>";
		echo '<div class="cancel">';	
			echo $this->Form->button('Cancel', array('type'=>'button'));	
		echo '</div>';
		echo $this->Form->input($submittext, array('type'=>'submit','label'=>false));	
		echo "</div>";
		echo $this->Form->end();
		
    ?>