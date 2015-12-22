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

<!-- Head for facebook -->
<head id="ctl00_ctl00_Head1" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" lang="ar">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!-- 
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery-1.9.1.min.js"></script>
 -->
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.minimalTabs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/general.js"></script>
<link href="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/css/layout.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/css/jquery.fancybox-1.3.4.css" media="screen" />

<!-- for facebook -->
<script  src="http://connect.facebook.net/ar_AR/all.js#xfbml=1"></script>
<!-- End facebook -->

<title><?php 
	if(!isset($title)) {
		$title= lang('admin_panel_title');
	}
	echo $title;
	?></title>
	
	
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.youtubeplaylist.js"></script>
<script type="text/javascript">
        $(function () {
            $("ul.youtubeVideo").ytplaylist({
                addThumbs: false,
                autoPlay: true,
                onChange: function () {
                    console.log('changed');
                },
                holderId: 'homeVideoHolder'
            });
        });

        $('#slideshow, #slideshow2, #slideshow3').cycle({
            fx: 'fade',
            //prev: '#prev',
            //next: '#nxt',
            speed: 'fast',
            //timeout: 0,
        });

</script>

</head>

<?php $this->load->view('admin/includes/dropdowns'); ?>

<body>
<div class="headerWrapper topNav first">
  <div class="headerContainer first last">
  <ul class="first">
  
<?php 
  $header_top_menu_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('header_top_menu');
  $header_top_menu_links_count=count($header_top_menu_links);
  $header_top_menu_counter=1;
  foreach($header_top_menu_links as $header_top_menu_link) {
  		
  		
  		
	   $link_id=$header_top_menu_link->id;
	   $link_controller_name=$header_top_menu_link->controller_name;
	   $link_alias=$header_top_menu_link->alias;
	   //$link_alias=urldecode($link_alias);
  		if($link_alias=='') {
			$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
		} else {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
		}
	   
	   
	   if($this->lang->lang()=='ar') {
	   	$link_title=$header_top_menu_link->title_ar;
	   } else {
	   	$link_title=$header_top_menu_link->title;
	   }
	   
	   if($header_top_menu_counter==1) {
	   	$header_top_menu_li_style="class='first'";
	   } else if($header_top_menu_counter==$header_top_menu_links_count) {
	   	$header_top_menu_li_style="class='last'";
	   } else {
	   	$header_top_menu_li_style='';
	   }
	   
	   echo "<li $header_top_menu_li_style><a class='first last' href='$full_link_url'>$link_title</a>";
	   $header_top_menu_counter++;
   }
?>
</ul>
<div class='last'>
      
      <ul class="topNav-loginOptions first">
        <li class='first'><a class='first last' id="fancyLogin" href="<?php echo base_url().$this->lang->lang().'/member/login';?>">تسجيل الدخول</a></li>
        <li class='last'><a class='first last' href="<?php echo base_url().$this->lang->lang().'/member/profile';?>">حساب جديد</a></li>
      </ul>
      <ul class="topNav-socialIcons last">
        <li class="first"><a target="_blank" href="https://twitter.com/NahdaIslah" class="footerIcon-twitter first last">Twitter</a></li>
        <li><a target="_blank" href="https://www.facebook.com/NahdaAndIslah?ref=stream" class="footerIcon-facebook first last" >Facebook</a></li>
        <li><a target="_blank" href="#" class="footerIcon-rss">RSS</a></li>
        <li class="last"><a target="_blank" href="http://www.youtube.com/user/NahdaIslah" class="footerIcon-youtube first last">Youtube</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="headerWrapper mainHeader">
  <div class="headerContainer first last"> <a href="<?php echo base_url().$this->lang->lang();?>" class="mainHeader-logo first last">رابطة النهضة والاصلاح</a>

<div class="header-search fLeft">
<form name="frm_page_search" id="frm_page_search" action="<?php echo base_url().$this->lang->lang();?>/page/search" method="get" enctype='multipart/form-data'>                
<input id="keyword" name="keyword"  type="text" placeholder="أدخل كلمة البحث" />
<input name="" type="submit" class="header-searchBtn" />
</form>
</div>  
   
</div>
</div>
<div class="headerWrapper mainNav">
  <div class="headerContainer first last">
    <ul class="first last">
     <?php 
  $header_top_menu_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('main_menu');
  
  $header_top_menu_links_count=count($header_top_menu_links);
  $header_top_menu_counter=1;
  foreach($header_top_menu_links as $header_top_menu_link) {
  	
  	
  	
	   $link_id=$header_top_menu_link->id;
	   $link_controller_name=$header_top_menu_link->controller_name;
	   $link_alias=$header_top_menu_link->alias;
	   //$link_alias=urldecode($link_alias);
  		if($link_alias=='') {
			$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
		} else {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
		}
		
	   if($this->lang->lang()=='ar') {
	   	$link_title=$header_top_menu_link->title_ar;
	   } else {
	   	$link_title=$header_top_menu_link->title;
	   }
	   
  	if($header_top_menu_counter==1) {
	   	$header_top_menu_li_style="class='first'";
	   } else if($header_top_menu_counter==$header_top_menu_links_count) {
	   	$header_top_menu_li_style="class='last'";
	   } else {
	   	$header_top_menu_li_style='';
	   }
	   
	   echo "<li $header_top_menu_li_style><a href='$full_link_url' class='first last'>$link_title</a>";
	   $header_top_menu_counter++;
   }
?>
    </ul>
  </div>
</div>