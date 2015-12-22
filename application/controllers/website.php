<?php
/**
 * Main Controller for website.
 *
 * It is main Controller file include the main Controller class Website Controller.
 *
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 * @copyright	Copyright (c) 2013, Info-cast.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://www.infocast-me.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Website Class.
 *
 * This is the main controller class which other controller extend
 *
 * @package		core
 * @category	Business Login
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Website extends CI_Controller
{ 	
	
	/**
	 * Constructor
	 *
	 * Load CI package which Will used in system controllers. 
	 * @access public
	*/
	function __construct()
	{
		parent::__construct();

		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');
				
		
		
		$this->lang->load('main');
	}
	
	public function load()
	{
		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->lang->load('main');
		
		$this->load->model('Menu_map_model', 'Menu_map_model' , True);
		$this->load->model('Menu_model', 'Menu_model' , True);
		$this->load->model('Menu_link_model', 'Menu_link_model' , True);
		
		$this->load->model('Page_model', 'Page_model' , True);
		$this->load->model('Video_model', 'Video_model' , True);
		$this->load->model('Seminar_model', 'Seminar_model' , True);
		$this->load->model('Writer_model', 'Writer_model' , True);
		
		
		$this->load->model('Pagetype_model', 'Pagetype_model' , True);
		$this->load->model('Pagecat_model', 'Pagecat_model' , True);
		
	}
	
	
	/**
	 * start_with Method.
	 *
	 * Method to check if string start with another. 
	 *
	 * @access	public
	 * @param   string
	 * @param   string
	 * @return	boolean
	 */	
	public function start_with($s, $prefix)
	{
	    return strpos($s, $prefix) === 0;
	}
	
	/**
	 * Method get hijri date
	 * 
	 */
	
	public function getHijri($mydate)
	{
		$month = date("m",strtotime($mydate));	
		$day = date("j",strtotime($mydate));	
		$year = date("Y",strtotime($mydate));	
		
		//$time = mktime(0, 0, 0, Date(m), Date(j), Date(Y));
		  $time = mktime(0, 0, 0, $month, $day, $year);
		  $TDays=round($time/(60*60*24));  
		  $HYear=round($TDays/354.37419);  
		  $Remain=$TDays-($HYear*354.37419);  
		  $HMonths=round($Remain/29.531182);  
		  $HDays=$Remain-($HMonths*29.531182);  
		  $HYear=$HYear+1389;  
		  $HMonths=$HMonths+10;$HDays=$HDays+23;  
		  if ($HDays>29.531188 and round($HDays)!=30){  
			$HMonths=$HMonths+1;$HDays=Round($HDays-29.531182);  
		  }else{  
			$HDays=Round($HDays);  
		  }  
		  if ($HMonths>12) {  
			$HMonths=$HMonths-12;  
			$HYear = $HYear+1;  
		  } 
		  
		  if ($HMonths=="1"){
			$Month_Name = "محرم";
		  }else if ($HMonths=="2"){
			$Month_Name = "صفر";
		  }else if ($HMonths=="3"){
			$Month_Name = "ربيع اول";
		  }else if ($HMonths=="4"){
			$Month_Name = "ربيع اخر";
		  }else if ($HMonths=="5"){
			$Month_Name = "جماد اول";
		  }else if ($HMonths=="6"){
			$Month_Name = "جماد اخر";
		  }else if ($HMonths=="7"){
			$Month_Name = "رجب";
		  }else if ($HMonths=="8"){
			$Month_Name = "شعبان";
		  }else if ($HMonths=="9"){
			$Month_Name = "رمضان";
		  }else if ($HMonths=="10"){
			$Month_Name = "شوال";
		  }else if ($HMonths=="11"){
			$Month_Name = "ذو القعدة";
		  }else if ($HMonths=="12"){
			$Month_Name = "ذو الحجة";
		  }
		  
		  
		  $NowDay=$HDays;
		  
		  
		  
		  $NowMonth=$HMonths;
		  $NowYear=$HYear;
		  $MDay_Num = date("w");
		  if ($MDay_Num=="0"){
			$MDay_Name = "الأحد";
		  }elseif ($MDay_Num=="1"){
			$MDay_Name = "الإثنين";
		  }elseif ($MDay_Num=="2"){
			$MDay_Name = "الثلاثاء";
		  }elseif ($MDay_Num=="3"){
			$MDay_Name = "الأربعاء";
		  }elseif ($MDay_Num=="4"){
			$MDay_Name = "الخميس";
		  }elseif ($MDay_Num=="5"){
			$MDay_Name = "الجمعة";
		  }elseif ($MDay_Num=="6"){
			$MDay_Name = "السبت";
		  }
		  $NowDayName = $MDay_Name;
		  $NowDate = $MDay_Name."، ".$HDays." ".$Month_Name." ".$HYear." هجريا";
		  
		  return $NowDate;
	}
	
	
	public function getDateForamt($mydate)
	{
		$month = date("m",strtotime($mydate));	
		$day = date("j",strtotime($mydate));	
		$year = date("Y",strtotime($mydate));	
		
		if ($month=="1"){
			$Month_Name = "يناير";
		  }else if ($month=="2"){
			$Month_Name = "فبراير";
		  }else if ($month=="3"){
			$Month_Name = "مارس";
		  }else if ($month=="4"){
			$Month_Name = "ابريل";
		  }else if ($month=="5"){
			$Month_Name = "مايو";
		  }else if ($month=="6"){
			$Month_Name = "يونيو";
		  }else if ($month=="7"){
			$Month_Name = "يوليو";
		  }else if ($month=="8"){
			$Month_Name = "اغسطس";
		  }else if ($month=="9"){
			$Month_Name = "سبتمبر";
		  }else if ($month=="10"){
			$Month_Name = "اكتوبر";
		  }else if ($month=="11"){
			$Month_Name = "نوفمبر";
		  }else if ($month=="12"){
			$Month_Name = "ديسمبر";
		  }
		
		$NowDate = $day." ".$Month_Name." ".$year." ميلاديا";
		  
		return $NowDate;
	}
	
	public function getMiladiMonth($month)
	{
		
		if ($month=="1"){
			$Month_Name = "يناير";
		  }else if ($month=="2"){
			$Month_Name = "فبراير";
		  }else if ($month=="3"){
			$Month_Name = "مارس";
		  }else if ($month=="4"){
			$Month_Name = "ابريل";
		  }else if ($month=="5"){
			$Month_Name = "مايو";
		  }else if ($month=="6"){
			$Month_Name = "يونيو";
		  }else if ($month=="7"){
			$Month_Name = "يوليو";
		  }else if ($month=="8"){
			$Month_Name = "اغسطس";
		  }else if ($month=="9"){
			$Month_Name = "سبتمبر";
		  }else if ($month=="10"){
			$Month_Name = "اكتوبر";
		  }else if ($month=="11"){
			$Month_Name = "نوفمبر";
		  }else if ($month=="12"){
			$Month_Name = "ديسمبر";
		  }
				  
		return $Month_Name;
	}
	
	public function getHijriArray($mydate)
	{
		$month = date("m",strtotime($mydate));	
		$day = date("j",strtotime($mydate));	
		$year = date("Y",strtotime($mydate));	
		
		//$time = mktime(0, 0, 0, Date(m), Date(j), Date(Y));
		  $time = mktime(0, 0, 0, $month, $day, $year);
		  $TDays=round($time/(60*60*24));  
		  $HYear=round($TDays/354.37419);  
		  $Remain=$TDays-($HYear*354.37419);  
		  $HMonths=round($Remain/29.531182);  
		  $HDays=$Remain-($HMonths*29.531182);  
		  $HYear=$HYear+1389;  
		  $HMonths=$HMonths+10;$HDays=$HDays+23;  
		  if ($HDays>29.531188 and round($HDays)!=30){  
			$HMonths=$HMonths+1;$HDays=Round($HDays-29.531182);  
		  }else{  
			$HDays=Round($HDays);  
		  }  
		  if ($HMonths>12) {  
			$HMonths=$HMonths-12;  
			$HYear = $HYear+1;  
		  } 
		  
		  if ($HMonths=="1"){
			$Month_Name = "محرم";
		  }else if ($HMonths=="2"){
			$Month_Name = "صفر";
		  }else if ($HMonths=="3"){
			$Month_Name = "ربيع اول";
		  }else if ($HMonths=="4"){
			$Month_Name = "ربيع اخر";
		  }else if ($HMonths=="5"){
			$Month_Name = "جماد اول";
		  }else if ($HMonths=="6"){
			$Month_Name = "جماد اخر";
		  }else if ($HMonths=="7"){
			$Month_Name = "رجب";
		  }else if ($HMonths=="8"){
			$Month_Name = "شعبان";
		  }else if ($HMonths=="9"){
			$Month_Name = "رمضان";
		  }else if ($HMonths=="10"){
			$Month_Name = "شوال";
		  }else if ($HMonths=="11"){
			$Month_Name = "ذو القعدة";
		  }else if ($HMonths=="12"){
			$Month_Name = "ذو الحجة";
		  }
		  
		  
		  $NowDay=$HDays;
		  
		  
		  
		  $NowMonth=$HMonths;
		  $NowYear=$HYear;
		  $MDay_Num = date("w");
		  if ($MDay_Num=="0"){
			$MDay_Name = "الأحد";
		  }elseif ($MDay_Num=="1"){
			$MDay_Name = "الإثنين";
		  }elseif ($MDay_Num=="2"){
			$MDay_Name = "الثلاثاء";
		  }elseif ($MDay_Num=="3"){
			$MDay_Name = "الأربعاء";
		  }elseif ($MDay_Num=="4"){
			$MDay_Name = "الخميس";
		  }elseif ($MDay_Num=="5"){
			$MDay_Name = "الجمعة";
		  }elseif ($MDay_Num=="6"){
			$MDay_Name = "السبت";
		  }
		  $NowDayName = $MDay_Name;
		  $NowDate = $MDay_Name."، ".$HDays." ".$Month_Name." ".$HYear." هجريا";
		  
		  $NowDate=array();
		  $NowDate['day']=$HDays;
		  $NowDate['month']=$Month_Name;
		  $NowDate['year']=$HYear;
		  
		  return $NowDate;
	}
	
}