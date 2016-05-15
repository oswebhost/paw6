<?php

	require_once("config.ini.php");
  require_once("reguser.php");
    

	if (isset($_POST['userid']) and isset($_POST['email']) and isset($_POST['pass']) ){

        $_user = $_POST['userid'];
        $_email = $_POST['email'];
        $msg="";
        
        if (find_id($userid) == "YES"){
            $msg = "ERROR: Userid is in used.<BR/>";
        }
        
        if (find_email_only($email) =="YES"){
            $msg .= "ERROR: Email is in used.";
        }
        
        if (strlen($msg)>5){
            
           header("location: register.php?msg=$msg");
           exit(); 
            
        }
		
		$qry = "insert into userlist (userid,email,pwd,regdate,memtype,refer_by) values ('$_POST[userid]', '$_POST[email]', '$_POST[pass]',now(),'FREE','aweber')";
		$temp = $eu->prepare($qry);
		$temp->execute();
    $lastid = $eu->lastInsertId();
    
    $foundat = ""; $foundusing = "";
    
    switch ($_POST['group1']){
      case 1:
        $foundat = "Google";
        $foundusing = $_POST['googletext'];
        break;
      case 2:
        $foundat = "Fourm";
        $foundusing = $_POST['googletext'];
        break;
      case 3:
        $foundat = "Word of Mouth";
        break;
      case 4:
        $foundat = "YouTube";
        break;
      case 5:
        $foundat = "Facebook";
        break;
      case 6:
        $foundat = "Twitter";
        break;
    }
    
    
    $qry = "insert into `user_survey` (userid,foundat,foundusing) values ('$_POST[userid]', '$foundat', '$foundusing')";
		$temp = $eu->prepare($qry);
		$temp->execute();

  
		session_start();
		//$_SESSION['userid'] = $userid;

	}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> </title>
    


<!-- onload="aweber.submit();" -->






<!-- AWeber Web Form Generator 3.0 -->
<style type="text/css">
#af-form-1481861439 .af-body .af-textWrap{width:70%;display:block;float:right;}
#af-form-1481861439 .af-body a{color:#000000;text-decoration:underline;font-style:normal;font-weight:normal;}
#af-form-1481861439 .af-body input.text, #af-form-1481861439 .af-body textarea{background-color:#FFFFFF;border-color:#CCCCCC;border-width:2px;border-style:inset;color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:inherit;font-family:inherit;}
#af-form-1481861439 .af-body input.text:focus, #af-form-1481861439 .af-body textarea:focus{background-color:inherit;border-color:#CCCCCC;border-width:2px;border-style:inset;}
#af-form-1481861439 .af-body label.previewLabel{display:block;float:left;width:25%;text-align:left;color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:inherit;font-family:inherit;}
#af-form-1481861439 .af-body{padding-bottom:15px;background-repeat:no-repeat;background-position:inherit;background-image:none;color:#000000;font-size:12px;font-family:, serif;}
#af-form-1481861439 .af-footer{background-color:transparent;background-repeat:no-repeat;background-position:top left;background-image:none;border-bottom-style:none;border-left-style:none;border-right-style:none;border-top-style:none;color:#000000;font-family:, serif;}
#af-form-1481861439 .af-header{background-color:transparent;background-repeat:no-repeat;background-position:inherit;background-image:none;border-bottom-style:none;border-left-style:none;border-right-style:none;border-top-style:none;color:#000000;font-family:, serif;}
#af-form-1481861439 .af-quirksMode .bodyText{padding-top:2px;padding-bottom:2px;}
#af-form-1481861439 .af-quirksMode{padding-right:15px;padding-left:15px;}
#af-form-1481861439 .af-standards .af-element{padding-right:15px;padding-left:15px;}
#af-form-1481861439 .bodyText p{margin:1em 0;}
#af-form-1481861439 .buttonContainer input.submit{color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:inherit;font-family:inherit;}
#af-form-1481861439 .buttonContainer input.submit{width:auto;}
#af-form-1481861439 .buttonContainer{text-align:center;}
#af-form-1481861439 body,#af-form-1481861439 dl,#af-form-1481861439 dt,#af-form-1481861439 dd,#af-form-1481861439 h1,#af-form-1481861439 h2,#af-form-1481861439 h3,#af-form-1481861439 h4,#af-form-1481861439 h5,#af-form-1481861439 h6,#af-form-1481861439 pre,#af-form-1481861439 code,#af-form-1481861439 fieldset,#af-form-1481861439 legend,#af-form-1481861439 blockquote,#af-form-1481861439 th,#af-form-1481861439 td{float:none;color:inherit;position:static;margin:0;padding:0;}
#af-form-1481861439 button,#af-form-1481861439 input,#af-form-1481861439 submit,#af-form-1481861439 textarea,#af-form-1481861439 select,#af-form-1481861439 label,#af-form-1481861439 optgroup,#af-form-1481861439 option{float:none;position:static;margin:0;}
#af-form-1481861439 div{margin:0;}
#af-form-1481861439 fieldset{border:0;}
#af-form-1481861439 form,#af-form-1481861439 textarea,.af-form-wrapper,.af-form-close-button,#af-form-1481861439 img{float:none;color:inherit;position:static;background-color:none;border:none;margin:0;padding:0;}
#af-form-1481861439 input,#af-form-1481861439 button,#af-form-1481861439 textarea,#af-form-1481861439 select{font-size:100%;}
#af-form-1481861439 p{color:inherit;}
#af-form-1481861439 select,#af-form-1481861439 label,#af-form-1481861439 optgroup,#af-form-1481861439 option{padding:0;}
#af-form-1481861439 table{border-collapse:collapse;border-spacing:0;}
#af-form-1481861439 ul,#af-form-1481861439 ol{list-style-image:none;list-style-position:outside;list-style-type:disc;padding-left:40px;}
#af-form-1481861439,#af-form-1481861439 .quirksMode{width:375px;}
#af-form-1481861439.af-quirksMode{overflow-x:hidden;}
#af-form-1481861439{background-color:transparent;border-color:inherit;border-width:none;border-style:none;}
#af-form-1481861439{display:block;}
#af-form-1481861439{overflow:hidden;}
.af-body .af-textWrap{text-align:left;}
.af-body input.image{border:none!important;}
.af-body input.submit,.af-body input.image,.af-form .af-element input.button{float:none!important;}
.af-body input.text{width:100%;float:none;padding:2px!important;}
.af-body.af-standards input.submit{padding:4px 12px;}
.af-clear{clear:both;}
.af-element label{text-align:left;display:block;float:left;}
.af-element{padding:5px 0;}
.af-form-wrapper{text-indent:0;}
.af-form{text-align:left;margin:auto;}
.af-header,.af-footer{margin-bottom:0;margin-top:0;padding:10px;}
.af-quirksMode .af-element{padding-left:0!important;padding-right:0!important;}
.lbl-right .af-element label{text-align:right;}
body {
}
</style>



</head>
<?php //onload="javascript:document.forms.aweber_form.submit();" ?>

<body onload="javascript:document.forms.aweber_form.submit();" >

<form name="aweber_form" method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl"  >

<div style="display: none;">

<input type="hidden" name="meta_web_form_id" value="1481861439" />
<input type="hidden" name="meta_split_id" value="" />
<input type="hidden" name="listname" value="registered_2603" />
<input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=text" id="redirect_1081cc8c9caf1f7b6f20bc0960c8d2e3" />

<input type="hidden" name="meta_adtracking" value="My_Web_Form_2" />
<input type="hidden" name="meta_message" value="1" />
<input type="hidden" name="meta_required" value="name,email" />

<input type="hidden" name="meta_tooltip" value="" />

<div id="af-form-1481861439" class="af-form"><div id="af-header-1481861439" class="af-header"><div class="bodyText"><p>&nbsp;</p></div></div>
<div id="af-body-1481861439"  class="af-body af-standards">
<div class="af-element">
<label class="previewLabel" for="awf_field-47148307">Name: </label>
<div class="af-textWrap">
<input id="awf_field-47148307" type="text" name="name" class="text" value="<?php echo $_POST['userid'];?>"  tabindex="500" />
</div>
<div class="af-clear"></div></div>
<div class="af-element">
<label class="previewLabel" for="awf_field-47148308">Email: </label>
<div class="af-textWrap"><input class="text" id="awf_field-47148308" type="text" name="email" value="<?php echo $_POST['email'];?>" tabindex="501"  />
</div><div class="af-clear"></div>
</div>
<div class="af-element buttonContainer">
<input name="sub" id="sub" class="submit" type="submit" value="Submit" tabindex="502" />
<div class="af-clear"></div>
</div>
</div>
<div id="af-footer-1481861439" class="af-footer"><div class="bodyText"><p>&nbsp;</p></div></div>
</div>
<div style="display: none;"><img src="http://forms.aweber.com/form/displays.htm?id=jCwcjBxsjCzMnA==" alt="" /></div>




</form>


<!-- /AWeber Web Form Generator 3.0 -->


</div>














</body>
</html>
