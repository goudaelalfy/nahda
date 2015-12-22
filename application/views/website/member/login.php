<?php echo "<script type='text/javascript'  src='".base_url()."js/website/member/form.js' > </script>";?>
<?php if($this->lang->lang()=='ar') {
	$website_css_dir='website';
	$html_dir='rtl';
} else {
	$website_css_dir='website';
	$html_dir='ltr';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.minimalTabs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/general.js"></script>
<link href="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/css/layout.css" rel="stylesheet" type="text/css" />

<title>رابطة النهضة والاصلاح |</title>
</head>

<body>
		
<form name="frm_member_login" id="frm_member_login" action="<?php echo base_url().$this->lang->lang();?>/member/authourize" method="post" enctype='multipart/form-data'>
				

      <div class="n_login">
    	<h1>مرحباً , من فضلك قم بتسجيل الدخول !</h1>
  		<div class="n_loginR">
       	  <div class="n_loginRow">
          	<div class="n_loginTB">
          	
          	<input class="userName" type="text"  name="username" id="username" />
          	</div>
          </div>
          <div class="n_loginRow">
          	<div class="n_loginTB">
          	<input class="password" type="password"  name="password" id="password" />
          	</div>
          </div>
          <div class="n_loginRow">
           <a href="javascript:submitLoginForm()" class="n_loginBtn"></a>
            <div class="rememberMe"><input name="" type="checkbox" value="تذكرنى" /><span>تذكرنى</span></div>

            <a target="_blank" href="<?php echo base_url().$this->lang->lang().'/member/forgetPassword';?>" class="forgetPass">نسيت كلمة المرور<?php echo $this->lang->line('forgot_you_password'); ?></a>
          </div>
          <div class="n_loginRow">
          	<a href="javascript:submitLoginForm()" class="fbLogin"></a>
          </div>
        </div>
        
        <div class="n_loginL">
       	  <div class="n_socialLogin"><a href="#" class="sicialFB"></a></div>
          <div class="n_socialLogin"><a href="#" class="sicialNahda"></a></div>
        </div>
        
  </div>
     

</form>	
	
 
 
</body>
</html>
	