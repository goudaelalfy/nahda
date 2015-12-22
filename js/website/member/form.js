function submitform()
{
  document.frm_member_profile.submit();
}
function submitLoginForm()
{
  document.frm_member_login.submit();
}
function submitForgetPasswordForm()
{
  document.frm_member_forget_password.submit();
}

function show(id) 
{
	document.getElementById(id).style.display = 'block';
} 
function hide(id) 
{
	document.getElementById(id).style.display = 'none';
}


function validate_form() {

	 var error=0;
	 
	 if (document.getElementById('firstname').value.replace(/^\s+|\s+$/g, '')=="")
	 {
		 show('dv_firstname_false');
		 error=error+1;
	 }
	 else
	 {
		 hide('dv_firstname_false');
	 }
	 
	 if (document.getElementById('email').value.replace(/^\s+|\s+$/g, '')=="")
	 {
		 show('dv_email_false');
		 error=error+1;
	 }
	 else
	 {
		 hide('dv_email_false');
	 }
	 
	 if (document.getElementById('password').value.replace(/^\s+|\s+$/g, '')=="" || document.getElementById('password').value.length<5)
	 {
		 show('dv_password_false');
		 error=error+1;
	 }
	 else
	 {
		 hide('dv_password_false');
	 }
	 
	 if (document.getElementById('password').value!=document.getElementById('password_confirm').value)
	 {
		 show('dv_password_confirm_false');
		 error=error+1;
	 }
	 else
	 {
		 hide('dv_password_confirm_false');
	 }
	 
	 
	 
	 	 
	 if(error>0)
	 {
		 return false;
	 }
	 return true;
	
}