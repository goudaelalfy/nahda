<?php $this->load->view('website/includes/header'); ?>

<?php echo "<script type='text/javascript'  src='".base_url()."js/website/member/form.js' > </script>";?>

		
<form name="frm_member_forget_password" id="frm_member_forget_password" action="<?php echo base_url().$this->lang->lang();?>/member/sendPassword" method="post" enctype='multipart/form-data'>
				
<div class="n_login">
    	<h1>مرحباً , من فضلك قم بادخال البريد الشخصى !</h1>
  		<div class="n_loginR">
  		
       	  <div class="n_loginRow">
          	<div class="n_loginTB">
          	
          	<input class="userName" type="text"  name="email" id="email" >
          	</div>
          </div>
         
         
          <div class="n_loginRow">
          	<a href="javascript:submitForgetPasswordForm()" class="forgetPass">ارسال</a>
         
          </div>
        </div>
        
       
  </div>
     

</form>	

	
<?php $this->load->view('website/includes/footer'); ?>
	