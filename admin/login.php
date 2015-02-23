<?PHP
require_once("include/membersite_config.php");
if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("index.php");
   }
}
       
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
      
      <title>Login</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv4.js'></script><body>
      <script src="scripts/pwdwidget.js" type="text/javascript"></script> 
<!-- Form Code Start -->  
<div id='fg_membersite'>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Логин</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>Поля, отмеченные *, являются обязательными для заполнения.</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >Пользователь*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Пароль*:</label><br/>
     <div class='pwdwidgetdiv' id='passworddiv' ></div><br/>
     <noscript>
      <input type='password' name='password' id='password' maxlength="50" /><br/>
      </noscript>  
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Отправить' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
var pwdwidget = new PasswordWidget('passworddiv','password');
    pwdwidget.enableGenerate = false;
	pwdwidget.enableShowStrength=false;
	pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget();
	
	
    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Введите имя пользователя ");
    
    frmvalidator.addValidation("password","req","Введите пароль");

// ]]>
</script>
</div>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</head>

</html>