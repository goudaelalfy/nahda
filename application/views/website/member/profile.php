<?php $this->load->view('website/includes/header'); ?>
<?php echo "<script type='text/javascript'  src='".base_url()."js/website/member/form.js' > </script>";?>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />


<!-- For DatePicker -->
<script type='text/javascript'  src='<?php echo base_url();?>added/datepicker/date-picker-v4/date-picker-v4/js/datepicker.js' > </script>
<link href="<?php echo base_url();?>added/datepicker/date-picker-v4/date-picker-v4/css/datepicker.css" rel="stylesheet" type="text/css" />
<!-- 
<link href="<?php echo base_url();?>added/datepicker/date-picker-v4/date-picker-v4/css/demo.css" rel="stylesheet" type="text/css" />
 -->
 
<script type="text/javascript">
// <![CDATA[     

// A quick test of the setGlobalVars method - remember, the "lang" attribute will NOT work when passed to this method
datePickerController.setGlobalVars({"split":["-dd","-mm"]});

/* 
        The following function dynamically calculates Easter Monday's date.
        It is used as the "redraw" callback function for the second last calendar on the page
        and returns an empty object.
   
        It dynamically calculates Easter Monday for the year in question and uses
        the "adddisabledDates" method of the datePickercontroller Object to
        disable the date in question.
   
        NOTE: This function is not needed, it is only present to show you how you
        might use this callback function to disable dates dynamically!   
*/            
function disableEasterMonday(argObj) { 
        // Dynamically calculate Easter Monday - I've forgotten where this code 
        // was originally found and I don't even know if it returns a valid
        // result so don't use it in a prod environment...
        var y = argObj.yyyy,
            a=y%4,
            b=y%7,
            c=y%19,
            d=(19*c+15)%30,
            e=(2*a+4*b-d+34)%7,
            m=Math.floor((d+e+114)/31),
            g=(d+e+114)%31+1,            
            yyyymmdd = y + "0" + m + String(g < 10 ? "0" + g : g);         
        
        datePickerController.addDisabledDates(argObj.id, yyyymmdd); 
        
        // The redraw callback expects an Object as a return value
        // so we just give it an empty Object... 
        return {};
};

/* 

        The following functions updates a span with an "English-ised" version of the
        currently selected date for the last datePicker on the page. 
   
        NOTE: These functions are not needed, they are only present to show you how you
        might use callback functions to use the selected date in other ways!
   
*/
function createSpanElement(argObj) {
        // Make sure the span doesn't exist already
        if(document.getElementById("EnglishDate-" + argObj.id)) return;

        // create the span node dynamically...
        var spn = document.createElement('span');
            p   = document.getElementById(argObj.id).parentNode;
            
        spn.id = "EnglishDate-" + argObj.id;
        p.parentNode.appendChild(spn);
        
        // Remove the bottom margin on the input's wrapper paragraph
        p.style.marginBottom = "0";
        
        // Add a whitespace character to the span
        spn.appendChild(document.createTextNode(String.fromCharCode(160)));
};

function showEnglishDate(argObj) {
        // Grab the span & get a more English-ised version of the selected date
        var spn = document.getElementById("EnglishDate-" + argObj.id),
            formattedDate = datePickerController.printFormattedDate(argObj.date, "l-cc-sp-d-S-sp-F-sp-Y", false);
        
        // Make sure the span exists before attempting to use it!
        if(!spn) {
                createSpanElement(argObj); 
                spn = document.getElementById("EnglishDate-" + argObj.id);
        };
        
        // Note: The 3rd argument to printFormattedDate is a Boolean value that 
        // instructs the script to use the imported locale (true) or not (false)
        // when creating the dates. In this case, I'm not using the imported locale
        // as I've used the "S" format mask, which returns the English ordinal
        // suffix for a date e.g. "st", "nd", "rd" or "th" and using an
        // imported locale would look strange if an English suffix was included
        
        // Remove the current contents of the span
        while(spn.firstChild) spn.removeChild(spn.firstChild);
        
        // Add a new text node containing our formatted date
        spn.appendChild(document.createTextNode(formattedDate));
};

      
/* 
 
        Create a datepicker using Javascript and not classNames
        -------------------------------------------------------
      
        datePickerController.createDatePicker has to be called onload as we need 
        the locale file to have loaded before we can create a datepicker.
      
        The only way to get around using an onload event is to 
        explicitly set the language by adding it before the datepicker script e.g:
      
        <script type="text/javascript" src="/the/path/to/the/language/file.js"></ script>
        <script type="text/javascript" src="/the/path/to/the/datepicker/file.js"></ script>
     
*/
            
datePickerController.addEvent(window, "load", function() {
      var opts = {
        // The ID of the associated form element
        id:"dp-js1",
        // The date format to use
        format:"d-sl-m-sl-Y",
        // Days to highlight (starts on Monday)
        highlightDays:[0,0,0,0,0,1,1],
        // Days of the week to disable (starts on Monday)
        disabledDays:[0,0,0,0,0,0,0],
        // Dates to disable (YYYYMMDD format, "*" wildcards excepted)
        disabledDates:{
                "20090601":"20090612", // Range of dates
                "20090622":"1",        // Single date
                "****1225":"1"         // Wildcard example 
                },
        // Date to always enable
        enabledDates:{},
        // Don't fade in the datepicker
        // NOTE: Only relevant if "staticPos" is set to false
        noFadeEffect:false,
        // Is it inline or popup
        staticPos:false,
        // Do we hide the associated form element on create
        hideInput:false,
        // Do we hide the today button
        noToday:true,
        // Do we show weeks along the left hand side
        showWeeks:true,
        // Is it drag disabled
        // NOTE: Only relevant if "staticPos" is set to false
        dragDisabled:true,
        // Positioned the datepicker within a wrapper div of your choice (requires the ID of the wrapper element)
        // NOTE: Only relevant if "staticPos" is set to true
        positioned:"",
        // Do we fill the entire grid with dates
        fillGrid:true,
        // Do we constrain dates not within the current month so that they cannot be selected
        constrainSelection:true,
        // Callback Object
        callbacks:{"create":[createSpanElement], "dateselect":[showEnglishDate]},
        // Do we create the button within a wrapper element of your choice (requires the ID of the wrapper element)
        // NOTE: Only relevant if staticPos is set to false
        buttonWrapper:"",
        // Do we start the cursor on a specific date (YYYYMMDD format string)
        cursorDate:""      
      };
      datePickerController.createDatePicker(opts);
});

// ]]>
</script>



<?php 

/**
 * Variables to store the value from database, to display on screen
 */
$id=				0;
$username='';  
$password='';  
$title='';  
$firstname='';  
$lastname='';  
$gender='';  
$birthdate='';  
$address='';  
$city='';  
$postal_code='';  
$country_id='';  
$phone='';  
$fax='';  
$email='';  

$organization='';  

$receive_newsletter=0; 

$registeration_datetime='';  
$active='';  
$active_code='';



$last_modify_date='';
$are_disabled='';
$readonly='';

/**
 * Mode is varible store the status or the mode of current row, add-edit-view-return, return when wrong occur
 * 
 * @var string
 */
if(isset($current_row))
{
	$id=		$current_row->id;
	$username=	$current_row->username;  
	$password=	$current_row->password;
	$firstname=	$current_row->firstname;  
	$lastname=	$current_row->lastname;  
	$gender=	$current_row->gender;  
	$birthdate=	$current_row->birthdate;  
	$address=	$current_row->address;
	$city= $current_row->city;
	$postal_code= $current_row->postal_code;
	$country_id= $current_row->country_id;
	$phone= $current_row->phone;
	$fax=	$current_row->fax; 
	$email=	$current_row->email;  
	$organization=	$current_row->organization;  
	
	$receive_newsletter=	$current_row->receive_newsletter;  
	
	if($receive_newsletter==1) {
	$receive_newsletter="checked='checked'";
	}
}



/**
 * Dropdowns object.
 * 
 * Intialize object from Dropdowns class which contains methods fill all dropdowns of website.
 * @var object.
 */

$dropdowns= new Dropdowns();

/**
 * Country object.
 * 
 * Intialize object from Country controller class.
 * @var object.
 */
$this->load->controller(ADMIN.'/Country');
$country_object= new Country();


/**
 * Member controller object.
 * 
 * Intialize object from Member controller class.
 * @var object.
 */

$this_object= new Member();

?>



<form name="frm_member_profile" id="frm_member_profile" action="<?php echo base_url().$this->lang->lang();?>/member/save" method="post" enctype='multipart/form-data'>
	
	<div class="bodyWrapper">
  <div class="bodyContainer">
    <div class="registration">
    	<h1>تسجيل مستخدم جديد</h1>
      <h2>بياناتك الشخصية</h2>
        <div class="container">
          <div class="regRow">
          	<div class="regCell1">النوع</div>
          	<div class="regCell2">
            	<select  name="gender" id="gender" <?php echo $readonly; ?>>
				<option value="Male" <?php if($gender=='Male'){echo "selected='selected'";} ?>>ذكر</option>
                <option value="Female" <?php if($gender=='Female'){echo "selected='selected'";} ?>>انثى</option>			
                </select>
            </div>
          </div>
          <div class="regRow">
          	<div class="regCell1">الإسم الأول</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="firstname" id="firstname" value="<?php echo $firstname; ?>"></div>
            	<div class="dv_error" id="dv_firstname_false" ><?php echo lang('firstname_false'); ?></div>
            </div>
          </div>
          <br/><br/><br/><br/><br/><br/>
          <div class="regRow">
          	<div class="regCell1">الإسم الأخير</div>
          	<div class="regCell2">
            	<div class="regTb">	 <input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="lastname" id="lastname" value="<?php echo $lastname; ?>"></div>
            </div>
          </div>
          <div class="regRow">
          	<div class="regCell1">تاريخ الميلاد</div>
          	<div class="regCell2">
            	<input class="w16em dateformat-Y-ds-m-ds-d"  type="text" readonly="readonly"  name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>">
            </div>
          </div>
          <div class="regRow">
          	<div class="regCell1">البريد الإلكترونى</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="email" id="email" value="<?php echo $email; ?>"></div>
            	<div class="dv_error" id="dv_email_false" style="display:none"><?php echo lang('email_false'); ?></div>
								
            </div>
          </div>
        </div><!-- -->
        <h2>بيانات الشركة</h2>
        <div class="container">
        <div class="regRow">
          	<div class="regCell1">إسم الشركة</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="organization" id="organization" value="<?php echo $organization; ?>"></div>
            </div>
          </div>
        </div>
        <h2>عنوانك</h2>
        <div class="container">
          <div class="regRow">
          	<div class="regCell1">العنوان</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="address" id="address" value="<?php echo $address; ?>"></div>
            </div>
          </div>
          
          <div class="regRow">
          	<div class="regCell1">الرقم البريدى</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="postal_code" id="postal_code" value="<?php echo $postal_code; ?>"></div>
            </div>
          </div>
          <div class="regRow">
          	<div class="regCell1">المدينة</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="city" id="city" value="<?php echo $city; ?>"></div>
            </div>
          </div>
          <div class="regRow">
          	<div class="regCell1">الدولة</div>
          	<div class="regCell2">
            	<?php $dropdowns->drpdwn_country($country_object, $country_id,'country_id',$are_disabled); ?>
            </div>
          </div>
          
          <!-- 
          <div class="regRow">
          	<div class="regCell1">المحافظة / المقاطعة</div>
          	<div class="regCell2">
            	<select style="width:137px;">
					<option value="217">القاهرة</option>
					<option value="218">بورسعيد</option>
					<option value="219">الإسكندرية</option>
					<option value="220">أخرى</option>

				</select>
            </div>
          </div>
           -->
           
        </div>
        <h2>بيانات الإتصال الخاصة بك</h2>
        <div class="container">
        <div class="regRow">
          	<div class="regCell1">رقم الهاتف</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="phone" id="phone" value="<?php echo $phone; ?>"></div>
            </div>
          </div>
          <div class="regRow">
          	<div class="regCell1">رقم الفاكس</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="text" <?php echo $readonly; ?> name="fax" id="fax" value="<?php echo $fax; ?>"></div>
            </div>
          </div>
        </div>
         <h2>خيارات</h2>
        <div class="container">
        <div class="regRow">
          	
          	<div class="regCell2">
            	أرغب فى إستقبال النشرات الإخبارية : <input  type="checkbox" id="receive_newsletter" name="receive_newsletter" <?php echo $receive_newsletter; ?> <?php echo $are_disabled; ?>>
            </div>
          </div>
          
        </div>
        <h2>كلمة المرور الخاصة بك</h2>
        <div class="container">
        <div class="regRow">
          	<div class="regCell1">كلمة المرور</div>
          	<div class="regCell2">
           
			<div class="regTb"><input class="input-xlarge focused" type="password" <?php echo $readonly; ?> name="password" id="password" value="<?php echo $password; ?>"></div>
           <div class="dv_error" id="dv_password_false" style="display:none"><?php echo lang('password_false'); ?></div>
								
            </div>
          </div>
          <br/><br/><br/>
          <div class="regRow">
          	<div class="regCell1">تأكيد كلمة المرور</div>
          	<div class="regCell2">
            	<div class="regTb"><input class="input-xlarge focused" type="password" <?php echo $readonly; ?> name="password_confirm" id="password_confirm" value="<?php echo $password; ?>"></div>
            <div class="dv_error" id="dv_password_confirm_false" style="display:none"><?php echo lang('password_confirm_false'); ?></div>
								
            </div>
          </div>
        </div>

        <a href="javascript:submitform()" class="n_regBtn" onclick="return validate_form();"></a>
										
    </div>
  </div>
</div>
	</form>
	
<?php $this->load->view('website/includes/footer'); ?>
	