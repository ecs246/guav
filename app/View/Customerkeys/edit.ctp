	<div id="content">
	<div id="centered">	
<?php 
 
	echo $this->element('customerkeys/form');
		echo "<div class='buttons'>";
		echo '<div class="cancel">';	
			echo $this->Form->button('Cancel', array('type'=>'button'));	
		echo '</div>';
		echo $this->Form->input('Expire Now', array('type'=>'submit','name'=>'submitaction','label'=>false));
		echo $this->Form->input('Save', array('type'=>'submit','name'=>'submitaction','label'=>false));	
		echo "</div>";
		echo $this->Form->end();
	
?>
	</div>
	</div>
