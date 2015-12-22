<?php $this->load->view('website/includes/header'); ?>

			
						
<div class="bodyWrapper">
  <div class="bodyContainer">
    <div class="registration">
    	<h1>تم الاشتراك بنجاح</h1>
     	 <h2><?php if(isset($title)) {echo $title;} ?></h2>
      
      	<?php 
				
				if(isset($message)) {
					echo $message;
				}
				
				?>
     
									
    </div>
  </div>
</div>
	
	
	
<?php $this->load->view('website/includes/footer'); ?>
	