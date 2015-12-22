<div class="footerWrapper last">
  <div class="footerContainer first">
    <div class="footer-socialIconsContainer first">
      <ul class="first last">
        <li class="first"><a target="_blank" href="https://twitter.com/NahdaIslah" class="footerIcon-twitter first last">Twitter</a></li>
        <li><a target="_blank" href="https://www.facebook.com/NahdaAndIslah?ref=stream" class="footerIcon-facebook first last">Facebook</a></li>
        <li><a target="_blank" href="#" class="footerIcon-rss first last">RSS</a></li>
        <li class="last"><a target="_blank" href="http://www.youtube.com/user/NahdaIslah" class="footerIcon-youtube first last">Youtube</a></li>
      
        
      </ul>
    </div>
    <div class="footer-visionContainer last">
      <h2 class="first">رؤيتنـا</h2>
      <p class="last">تحمل الرابطةُ على عاتقها مهمة الرقي بالوعي الفكري للمواطن المصري عبر تأصيل منهجي وبناء علمي للخارطة المفاهيمية والبنية التصورية، وعبر متابعة لمجريات الحراك المجتمعي بألوانه وأطيافه، وملاحقتها بالتأصيل والتحليل، وعبر ممارسة عملية لتغيير نحو الأفضل.</p>
    </div>
  </div>
  <div class="footerContainer footer-wide footer-topNav">
    <ul class="first last">
    
    <?php 
  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('footer_top_menu');
  $footer_bottom_menu_counter=1;
  $footer_bottom_menu_links_count=count($footer_bottom_menus_links);
  foreach($footer_bottom_menus_links as $footer_bottom_menus_link) {
	   $link_id=$footer_bottom_menus_link->id;
	   $link_controller_name=$footer_bottom_menus_link->controller_name;
	   $link_alias=$footer_bottom_menus_link->alias;
	   //$link_alias=urldecode($link_alias);
  		if($link_alias=='') {
			$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
		} else {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
		}
	   
	   
	   if($this->lang->lang()=='ar') {
	   	$link_title=$footer_bottom_menus_link->title_ar;
	   } else {
	   	$link_title=$footer_bottom_menus_link->title;
	   }
	   
	   if($footer_bottom_menu_counter==1) {
	   	$footer_bottom_menu_li_style="class='first'";
	   } else if($footer_bottom_menu_counter==$footer_bottom_menu_links_count) {
	   	$footer_bottom_menu_li_style="class='last'";
	   } else {
	   	$footer_bottom_menu_li_style='';
	   }
	   
	   echo "<li $footer_bottom_menu_li_style><a href='$full_link_url' title='$link_title' class='first last'>$link_title</a></li>";
	   
	   $footer_bottom_menu_counter++;
   }
?>
    
    
     
    </ul>
  </div>
  <div class="footerContainer footer-mainNav">
    <ul class="first last">
      <li class="first">
        <ul class="first last">
         <?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('home');
		   $footer_bottom_menu_counter=1;
  			$footer_bottom_menu_links_count=count($footer_bottom_menus_links);
  
		  foreach($footer_bottom_menus_links as $footer_bottom_menus_link) {
		   $link_id=$footer_bottom_menus_link->id;
		   $link_controller_name=$footer_bottom_menus_link->controller_name;
		   $link_alias=$footer_bottom_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$footer_bottom_menus_link->title_ar;
		   } else {
		   	$link_title=$footer_bottom_menus_link->title;
		   }
		   
		  
		   if($footer_bottom_menu_counter==1) {
		   	$footer_bottom_menu_li_style="class='first'";
		   } else if($footer_bottom_menu_counter==$footer_bottom_menu_links_count) {
		   	$footer_bottom_menu_li_style="class='last'";
		   } else {
		   	$footer_bottom_menu_li_style='';
		   }
		   echo "<li $footer_bottom_menu_li_style><a href='$full_link_url' class='first last' title='$link_title'>$link_title</a></li>";
		   $footer_bottom_menu_counter++;
  		 }
		?>
        
        
             
        </ul>
      </li>
      <li>
        <ul class="first last">
        <!-- 
        <li><a href="" title="<?php echo $this->lang->line('about_us'); ?>"><?php echo $this->lang->line('about_us'); ?></a></li>
           -->
          
            <?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('about_us');
		  $footer_bottom_menu_counter=1;
  		  $footer_bottom_menu_links_count=count($footer_bottom_menus_links);
  
		  foreach($footer_bottom_menus_links as $footer_bottom_menus_link) {
		   $link_id=$footer_bottom_menus_link->id;
		   $link_controller_name=$footer_bottom_menus_link->controller_name;
		   $link_alias=$footer_bottom_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$footer_bottom_menus_link->title_ar;
		   } else {
		   	$link_title=$footer_bottom_menus_link->title;
		   }
		   
		   if($footer_bottom_menu_counter==1) {
		   	$footer_bottom_menu_li_style="class='first'";
		   } else if($footer_bottom_menu_counter==$footer_bottom_menu_links_count) {
		   	$footer_bottom_menu_li_style="class='last'";
		   } else {
		   	$footer_bottom_menu_li_style='';
		   }
		   echo "<li $footer_bottom_menu_li_style><a href='$full_link_url' class='first last' title='$link_title'>$link_title</a></li>";
		   $footer_bottom_menu_counter++;
  		 }
		?>
        </ul>
      </li>
      <li>
        <ul class="first last">
         <!--
          <li><a href="" title="<?php echo $this->lang->line('news'); ?>"><?php echo $this->lang->line('news'); ?></a></li>
         -->  
		<?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('news');
		  $footer_bottom_menu_counter=1;
  		  $footer_bottom_menu_links_count=count($footer_bottom_menus_links);
  
		  
		  foreach($footer_bottom_menus_links as $footer_bottom_menus_link) {
		   $link_id=$footer_bottom_menus_link->id;
		   $link_controller_name=$footer_bottom_menus_link->controller_name;
		   $link_alias=$footer_bottom_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$footer_bottom_menus_link->title_ar;
		   } else {
		   	$link_title=$footer_bottom_menus_link->title;
		   }
		   
		  if($footer_bottom_menu_counter==1) {
		   	$footer_bottom_menu_li_style="class='first'";
		   } else if($footer_bottom_menu_counter==$footer_bottom_menu_links_count) {
		   	$footer_bottom_menu_li_style="class='last'";
		   } else {
		   	$footer_bottom_menu_li_style='';
		   }
		   echo "<li $footer_bottom_menu_li_style><a href='$full_link_url' class='first last' title='$link_title'>$link_title</a></li>";
		   $footer_bottom_menu_counter++;
		    
		  }
		?>
        </ul>
      </li>
      <li>
        <ul class="first last">
        <!-- 
          <li><a href="" title="<?php echo $this->lang->line('articles'); ?>"><?php echo $this->lang->line('articles'); ?></a></li>
         -->  
		<?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('articles');
		  $footer_bottom_menu_counter=1;
  		  $footer_bottom_menu_links_count=count($footer_bottom_menus_links);
  
		  
		  foreach($footer_bottom_menus_links as $footer_bottom_menus_link) {
		   $link_id=$footer_bottom_menus_link->id;
		   $link_controller_name=$footer_bottom_menus_link->controller_name;
		   $link_alias=$footer_bottom_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$footer_bottom_menus_link->title_ar;
		   } else {
		   	$link_title=$footer_bottom_menus_link->title;
		   }
		   
		   if($footer_bottom_menu_counter==1) {
		   	$footer_bottom_menu_li_style="class='first'";
		   } else if($footer_bottom_menu_counter==$footer_bottom_menu_links_count) {
		   	$footer_bottom_menu_li_style="class='last'";
		   } else {
		   	$footer_bottom_menu_li_style='';
		   }
		   echo "<li $footer_bottom_menu_li_style><a href='$full_link_url' class='first last' title='$link_title'>$link_title</a></li>";
		   $footer_bottom_menu_counter++;
		   
  		 }
		?>
        </ul>
      </li>
      <li class="last">
        <ul class="first last">
        <!-- 
        <li><a href="" title="<?php echo $this->lang->line('seminars'); ?>"><?php echo $this->lang->line('seminars'); ?></a></li>
          -->
          <?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('seminars');
		  $footer_bottom_menu_counter=1;
  		  $footer_bottom_menu_links_count=count($footer_bottom_menus_links);
  
		  
		  foreach($footer_bottom_menus_links as $footer_bottom_menus_link) {
		   $link_id=$footer_bottom_menus_link->id;
		   $link_controller_name=$footer_bottom_menus_link->controller_name;
		   $link_alias=$footer_bottom_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$footer_bottom_menus_link->title_ar;
		   } else {
		   	$link_title=$footer_bottom_menus_link->title;
		   }
		   
		   if($footer_bottom_menu_counter==1) {
		   	$footer_bottom_menu_li_style="class='first'";
		   } else if($footer_bottom_menu_counter==$footer_bottom_menu_links_count) {
		   	$footer_bottom_menu_li_style="class='last'";
		   } else {
		   	$footer_bottom_menu_li_style='';
		   }
		   echo "<li $footer_bottom_menu_li_style><a href='$full_link_url' class='first last' title='$link_title'>$link_title</a></li>";
		   $footer_bottom_menu_counter++;
		   
  		 }
		?>
                 
        </ul>
      </li>
    </ul>
  </div>
  <div class="footerContainer footer-wide footer-copyright last">
    <p class="centered first last"> جميع الحقوق محفوظة &copy; 2013 لرابطة النهضة والاصلاح </p>
  </div>
</div>
</body>
</html>