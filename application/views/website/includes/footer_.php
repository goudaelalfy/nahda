<div class="footerWrapper">
  <div class="footerContainer">
    <div class="footer-socialIconsContainer">
      <ul>
        <li><a target="_blank" href="https://twitter.com/NahdaIslah" class="footerIcon-twitter">Twitter</a></li>
        <li><a target="_blank" href="https://www.facebook.com/NahdaAndIslah?ref=stream" class="footerIcon-facebook">Facebook</a></li>
        <li><a target="_blank" href="#" class="footerIcon-rss">RSS</a></li>
        <li><a target="_blank" href="http://www.youtube.com/user/NahdaIslah" class="footerIcon-youtube">Youtube</a></li>
      
        
      </ul>
    </div>
    <div class="footer-visionContainer">
      <h2>رؤيتنـا</h2>
      <p>تحمل الرابطةُ على عاتقها مهمة الرقي بالوعي الفكري للمواطن المصري عبر تأصيل منهجي وبناء علمي للخارطة المفاهيمية والبنية التصورية، وعبر متابعة لمجريات الحراك المجتمعي بألوانه وأطيافه، وملاحقتها بالتأصيل والتحليل، وعبر ممارسة عملية لتغيير نحو الأفضل.</p>
    </div>
  </div>
  <div class="footerContainer footer-wide footer-topNav">
    <ul>
    
    <?php 
  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('footer_top_menu');
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
	   echo "<li><a href='$full_link_url' title='$link_title'>$link_title</a>";
   }
?>
    
    
     
    </ul>
  </div>
  <div class="footerContainer footer-mainNav">
    <ul>
      <li>
        <ul>
         <?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('home');
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
		   echo "<li><a href='$full_link_url' title='$link_title'>$link_title</a>";
  		 }
		?>
        
        
             
        </ul>
      </li>
      <li>
        <ul>
        <!-- 
        <li><a href="" title="<?php echo $this->lang->line('about_us'); ?>"><?php echo $this->lang->line('about_us'); ?></a></li>
           -->
          
            <?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('about_us');
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
		   echo "<li><a href='$full_link_url' title='$link_title'>$link_title</a>";
  		 }
		?>
        </ul>
      </li>
      <li>
        <ul>
         <!--
          <li><a href="" title="<?php echo $this->lang->line('news'); ?>"><?php echo $this->lang->line('news'); ?></a></li>
         -->  
		<?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('news');
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
		   echo "<li><a href='$full_link_url' title='$link_title'>$link_title</a>";
  		 }
		?>
        </ul>
      </li>
      <li>
        <ul>
        <!-- 
          <li><a href="" title="<?php echo $this->lang->line('articles'); ?>"><?php echo $this->lang->line('articles'); ?></a></li>
         -->  
		<?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('articles');
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
		   echo "<li><a href='$full_link_url' title='$link_title'>$link_title</a>";
  		 }
		?>
        </ul>
      </li>
      <li>
        <ul>
        <!-- 
        <li><a href="" title="<?php echo $this->lang->line('seminars'); ?>"><?php echo $this->lang->line('seminars'); ?></a></li>
          -->
          <?php 
		  $footer_bottom_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('seminars');
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
		   echo "<li><a href='$full_link_url' title='$link_title'>$link_title</a>";
  		 }
		?>
                 
        </ul>
      </li>
    </ul>
  </div>
  <div class="footerContainer footer-wide footer-copyright">
    <p class="centered"> جميع الحقوق محفوظة &copy; 2013 لرابطة النهضة والاصلاح </p>
  </div>
</div>
</body>
</html>