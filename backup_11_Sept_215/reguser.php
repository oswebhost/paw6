<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-Win.com/us/co.uk  ##
#############################################################

require("config.ini.php"); 
// Add new user -- Register new user

function find_ip($ip)
{  
  	$query1= "select ip from userlist where ip='$ip'";

    global $eu;
    $temp = $eu->prepare($qry) ;
    $temp->execute();

	if ($temp->rowCount()>0):
		return "NO";
	else:
		return "OK";
	endif;
}

function add_user($userid,$fullname,$email,$pwd,$address,$city,$bday,$refer_by)
{
  global $url;
  $day = date("d");
  $month = date("M");
  $year = date("Y");
  $date = "$day-$month-$year";
  $expiredate = date("Ymd");
  $date_reg = date("Y-m-d");
  $pwd_m = $pwd; //($pwd);
  

if (getenv(HTTP_X_FORWARDED_FOR)): 
   $ip_add=getenv(HTTP_X_FORWARDED_FOR);
 else: 
   $ip_add=getenv(REMOTE_ADDR); 
 endif; 
// $ip_add = "203.177.227.199" ;

 $country= '';//ip2_country_code($ip_add);
 
 $query1 = "INSERT INTO userlist (userid,pwd,fullname,email,address,city,bdate, country_code,confirm,regdate,ip, validupto, gg,ppw_qps,refer_by,date_reg) VALUES ('$userid','$pwd_m','$fullname', '$email','$address','$city', '$bday','$country', 'N','$date', '$ip_add','$valid','0','0','$refer_by','$date_reg');";
  
global $eu;
$temp = $eu->prepare($qry) ;
$temp->execute();


 $ok = email_to_user($userid,$fullname,$email,$url,$pwd_m,$pwd);
 //start_session($userid);   
 return $ok;
}

///confirmation.php?USERID=imran&CODE=d3a228b06402aa01ee2d0a44ddf8917c&EMAIL=imran@winpools.com

// send email..... send welcome message with Password for activation
function email_to_user($userid,$fullname,$email,$url,$pwd_m,$pwd) 
{
	 $ip_add=getenv(REMOTE_ADDR); 
	 $date = date("F, d Y h:i T");
	 $url ="http://www.predictawin.com/confirmation.php?USERID=$userid&CODE=$pwd_m";
	 $remove ="http://www.predictawin.com/remove.php?USERID=$userid&EMAIL=$email";
	 $aol = strtolower(substr($email,strlen($email)-7));
	 $fromemail ="Predict-a-Win.com <admin@PredictaWin.com>";
   $subject = " Your Membership for the Predict-A-Win Website";
   $userid = ucwords($userid);
    
	 $message = "
   Dear $userid, 
  	 
  Thank you for registering with us at the Predict-A-Win Website.   
   
  Your Log In Details are as follows:
  
  Userid: $userid 
  Password: $pwd 
  
  If you wish to change your password, you can do so whenever you choose after you have logged in.  
  
  In order to activate your account, you need to click on the following link:
    $url
  
  We hope you will derive great benefit from using our Services.
  
  Kind regards,
  Woz
  
  
  Request generated by IP: $ip_add
  Date: $date";

	 
  $headers  = "MIME-Version: 1.0\r\n";
	 if ($aol=='aol.com'):
		$headers .= "Content-type: text/x-aol; \r\n";
	 else:
		 $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	 endif;
	 $headers .= "From: admin@predictawin.com  \n";
	 $headers .= "Return-path: admin@predictawin.com  \n";
	 $headers .= "Reply-To: admin@predictawin.com \n";

	
	 $qry = "insert into user_msg values (0, now(), '$subject', '$email', '$message')" ;

    global $eu;
    $temp = $eu->prepare($qry) ;
    $temp->execute();

	 $send = mail($email, $subject, $message, $headers);
	 
	 //echo "$subject<br><br>";
	 //echo $message;


	 return $send;
}

// 
function find_id($userid) 
{
  $qry="SELECT userid FROM userlist WHERE  userid='$userid' ";
  
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();
  if ($temp->rowCount()>0):
	 return "YES";
  else:
	 return "NO" ;
  endif;
}

function find_confirm($userid,$pwd,$free=0) 
{   
  global $eu;  
  
  $pwdmd5= md5($pwd);
  
  //$qry = "SELECT userid,confirm FROM userlist WHERE  userid='$userid' AND pwd='$pwdmd5'";
  $userid = mysql_real_escape_string($userid);
  
  $qry = "SELECT userid,confirm FROM userlist WHERE  userid= :userid AND pwd= :pwd";

  $temp = $eu->prepare($qry) ;
  $temp->execute(array('userid' => $userid, 'pwd' => $pwd));
  
  
  if ($temp->rowCount()== 0 ){
      $qry ="SELECT userid,confirm FROM userlist WHERE  userid='$userid' AND pwd='$pwd'";
      $temp = $eu->prepare($qry) ;
      $temp->execute();
  }

    if ($temp->rowCount()>0){
    return 'OK';
  }else{
    return "N";  
  }
  
  
}



// find user -- Use in Login.php to count number of logs
function find_user($userid,$pwd,$free=0) 
{
  global $eu;
 
  $pwdmd5= md5($pwd);
 
 $userid = mysql_real_escape_string($userid);
  
  $qry = "SELECT userid,confirm FROM userlist WHERE  userid= :userid AND pwd= :pwd";

  $temp = $eu->prepare($qry) ;
  $temp->execute(array('userid' => $userid, 'pwd' => $pwd));
 
  
  if ($temp->rowCount()== 0 ){
      $qry ="SELECT userid,confirm FROM userlist WHERE  userid='$userid' AND pwd='$pwd'";
      $temp = $eu->prepare($qry) ;
      $temp->execute();
  }

  if ($temp->rowCount()>0):
	 $logcount += 1;
     $qry="UPDATE userlist set last_login=NOW(), logcount=logcount+1 WHERE  userid='$userid' limit 1";
     $temp = $eu->prepare($qry) ;
	 $temp->execute();
	 return "YES";
  else:
	 return "NO" ;
  endif;
}

function find_payment_flag($userid)
{
  $qry="SELECT userid,gg FROM userlist WHERE  userid='$userid'";
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();

  $d = $temp->fetch() ;
  return $d["gg"] ;
}

// 
function find_email_only($email) 
{
  $email = strtolower($email);
  $qry="SELECT userid,email FROM userlist WHERE email='$email'";
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();

  if ($temp->rowCount()>0):
	 return "YES";
  else:
	 return "NO" ;
  endif;
}


// Change Passord if User request Forget Password---login.php
function chg_pwd_email($email) 
{
  $email = strtolower($email);
 

  $qry="SELECT fullname,userid,email FROM userlist WHERE  email='$email' limit 1";
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();
  $num_of_rows = $temp->rowCount();
    
  while ($row = $temp->fetch()){
 	   $fullname = $row["fullname"];
       $userid   = $row["userid"];
  }
  
  
  if ($num_of_rows>0):
	 $pwd = makeRandomPassword(); 
     $pwd_m = $pwd; //md5($pwd);
     $qry="UPDATE userlist set pwd='$pwd_m' WHERE  email='$email' limit 1";
	 global $eu;
     $temp = $eu->prepare($qry) ;
     $temp->execute();
 
	 email_pwd($email,$pwd,$fullname,$userid); 
	 return "YES";
  else:
	 return "NO" ;
  endif;
}

//reset password by user
function email_pwd($email,$pwd,$fullname,$userid)
{
	 $aol = strtolower(substr($email,strlen($email)-7));
	 $fromemail ="soccer-predictions.com <admin@soccer-predictions.com>";
     $subject = "Password Retrieval"; 
	 $message = "Dear $userid,
	 
	 Your Password has been reset. Please use the following information to log in.
		 
	 User Id: $userid 
	 Password: $pwd
	 
	 You may change your Password after logging in.
	 
	 Many thanks,
	 Administrator - soccer-predictions.com"; 
    
	 if ($aol=='aol.com'):
		$headers .= "Content-type: text/x-aol; \r\n";
	 else:
		 $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	 endif;
	 $headers .= "From: $fromemail  \n";
	 $headers .= "Return-path: admin@soccer-predictions.com \n";
	 $headers .= "Reply-To: admin@soccer-predictions.com \n";

	 $send = mail($email, $subject, $message, $headers);
	 return $send;

}
// chg_email_by_user==== userinfo.php
function chg_email_by_user($userid,$email)
{
  $qry="UPDATE userlist SET email='$email' WHERE  userid='$userid' limit 1";
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();
 
   if ($temp->rowCount()>0):
  	  return "YES";
   else:
	  return "NO" ;
   endif;
}

// chg_pwd_by_user==== userinfo.php
function chg_pwd_by_user($userid,$pwd)
{
  $pwd_m = $pwd ; //md5($pwd);
  $qry="UPDATE userlist SET pwd='$pwd_m' WHERE  userid='$userid' limit 1";
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();
      
   if ($temp->rowCount()>0):
  	  return "YES";
   else:
	  return "NO" ;
   endif;
}

// Generate Random Password of 8 charachters
function makeRandomPassword() { 
  $salt = "abchefhjkmnprstuvwxyz123456789"; 
  srand((double)microtime()*1000000);  
      $i = 0; 
      while ($i <= 7) { 
            $num = rand() % 33; 
            $tmp = substr($salt, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
      } 
      return $pass; 
} 

function find_new_client($user_id)
{
  $qry = "select max(amount) as amount, userid from credit_file where userid='$user_id' group by userid";
  global $eu;
  $temp = $eu->prepare($qry) ;
  $temp->execute();
  $d = $temp->fetch();  
   return $d["amount"] ;
}

function start_session($user_id, $free=0)
{    
	global $userid,$fullname,$logcount,$regdate,$country_code,$expire,$paidmem,$_gg,$_pp;
	$qry="SELECT gg,ppw_qps,userid,fullname,email, date_reg, refer_by,logcount,date_format(validupto,'%d-%b-%Y') as validupto, date_format(date_reg,'%d-%b-%Y') as reg_date,paidmem,date_format(validupto,'%Y%m%d') as validdate, country_code,advdata FROM userlist WHERE  userid='$user_id'";
    
    global $eu;
    $temp = $eu->prepare($qry) ;
    $temp->execute();
 
    $num_of_rows = $temp->rowCount();
      
	$row = $temp->fetch();
    
	$_SESSION['email']    = $row['email'];
	$_SESSION['userid']   = $row["userid"];
    $_SESSION['fullname'] = trim($row["fullname"]);

	$_SESSION['logcount'] = $row["logcount"];
	$_SESSION['date_reg']  = $row["reg_date"];
		
    $paidmem = 0;
    
    $paidmem = 1;  /// this function make paid and unpaid members ...27-Mar-13       find_payment($user_id);
    
    if ($user_id=='corinna.x1' or $user_id=='imran' or $user_id=='wally' or $user_id=='anita' or $user_id=='Sammy258' or $user_id=='gbanister'){
        $paidmem = 1;
    }	
		
    if ($paidmem==1){
       $_SESSION['paidmem']  = 1 ;
       $_SESSION['expire']   = ($row["validupto"]<45? 50: $row["validuptop"]);
    }else{
      $_SESSION['paidmem']  = "FREE";
      $_SESSION['expire']   =  1;
    }
		
    $_SESSION['validupto'] = $row["validupto"] ;

	$_SESSION['validdate'] = $row["validdate"] ;


} 

function find_payment($use_rid){
    global $eu;
    $qry = "select userid from net_banx where userid='$user_id' limit 1";
    $temp = $eu->prepare($qry) ;
    $temp->execute();
 
    return $temp->rowCount();
}


function MyCheckDate( $postedDate ) { 
   if ( preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $postedDate) ) { 
      list($year , $month , $day) = explode('-',$postedDate); 
      return checkdate($month , $day , $year); 
   } else { 
      return "NO"; 
   } 
} 

function chdate($datein)
{
	if(preg_match('/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/', $datein)){ 
		list($day , $month , $year) = explode('-',$datein); 
		if ( ($month>12) or ($day>31) ):
			return "no";
		else:
			return "OK";
		endif;
	}else{ 
	 return "no";
	} 
}

//reset password by user
function attempted_payment($email,$fullname,$userid,$AMT,$URL,$by)
{
	 $aol = strtolower(substr($email,strlen($email)-7));
	 $fromemail ="Predict-a-Win.com <admin@Predictawin.com>";
     $subject = "Attempted Payment Notice"; 
	 $message = "
	 User Id: $userid 
	 Email : $email
	 Full Name: $fullname
	 
	 Amount: $AMT 
	 Pay through: $by";
	 
	 $message .= "\n\nDate: ". date("d-M-Y H:i") ;
	 $message .= "\n\n" . $URL ;
    
	 if ($aol=='aol.com'):
		$headers .= "Content-type: text/x-aol; \r\n";
	 else:
		 $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	 endif;
	 $headers .= "From: $fromemail  \n";
	 $headers .= "Return-path: admin@predictawin.com  \n";
	 $headers .= "Reply-To: admin@predictawin.com \n";

	 $send = mail("anita@winpools.com", $subject, $message, $headers);
	 return $send;

}

?>