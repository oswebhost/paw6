<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/ajaxtabs/ajaxtabs.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen">


<script type="text/javascript" src="<?=$domain?>/css/ajaxtabs/ajaxtabs.js"></script>
<script type="text/javascript" src="<?=$domain?>/javas/fValConfig.js"></script>
<script type="text/javascript" src="<?=$domain?>/javas/fValidate.js"></script>
<script type="text/javascript" src="<?=$domain?>/javas/anylink.js"></script>
<script type="text/javascript" src="<?=$domain?>/javas/anylinkvertical.js"></script>



<script type="text/javascript" src="<?=$domain?>/javas/main.js"></script>






<script language="JavaScript" type="text/javascript">

	var xmlhttp
	function AjaxCallUser(str)
	{
		if (str.length==0)
		{
			document.getElementById("txtUserid").innerHTML="";
			return;
		}
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
			alert ("Your browser does not support XMLHTTP!");
			return;
		}
		var url="getUser.php";
		url=url+"?q="+str;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}
    
    

	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("txtUserid").innerHTML=xmlhttp.responseText;
		}
	}

	function AjaxCallEmail(str,env)
	{
		if (str.length==0)
		{
			document.getElementById("txtEmail").innerHTML="";
			return;
		}
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
			alert ("Your browser does not support XMLHTTP!");
			return;
		}
		var url="getUser.php";
		url=url+"?email="+str;
		url=url+"&env="+env;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=stateChangedEmail;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}

	function stateChangedEmail()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("txtEmail").innerHTML=xmlhttp.responseText;
		}
	}

	
	function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
		{
			// code for IE7+, Firefox, Chrome, Opera, Safari
			return new XMLHttpRequest();
		}
		if (window.ActiveXObject)
		{
			// code for IE6, IE5
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
		return null;
	}

function googleCheck() {
    if (document.getElementById('radio1').checked || document.getElementById('radio2').checked) {
        document.getElementById('txtinput').style.visibility = 'visible';
        
       
       if (document.getElementById('radio1').checked){ 
        document.getElementById('f1').innerHTML= 'Search Word/Phase<br/>';
       }
       if (document.getElementById('radio2').checked){ 
        document.getElementById('f1').innerHTML= 'Forum Name<br/>';
       }
        
    } else {
        document.getElementById('txtinput').style.visibility = 'hidden';
        
    }
    
}



  
function checkPass()
{ 
  
	if(document.signup.userid.value=="" )
	{
		alert("Please complete all above boxes");
		document.signup.userid.focus();
		return false;
	}
	
	if(document.signup.email.value=="" )
	{
		alert("Please enter Email address");
		document.signup.email.focus();
		return false;
	}
	if(!validatemail(document.signup.email,'Please enter valid Email address'))
		return false;	

	if(document.signup.pass.value.length < 6)
	{
		alert("Password should be minimum 6 characters long.");
		document.signup.pass.focus();
		return false;
	}

	if(document.signup.pass.value!=document.signup.pass2.value)
	{
		alert("Password and Confirm Password doesnot match");
		document.signup.pass2.value="";
		document.signup.pass2.focus();
		return false;
	}
  
    if (document.signup.radio1.checked && document.signup.googletext.value=="" ){ 
         alert('Enter Google Search word/phase.');
         document.signup.googletext.focus();
          return false;
   }

   if (document.signup.radio2.checked && document.signup.googletext.value=="" ){ 
         alert('Enter Fourm name');
         document.signup.googletext.focus();
          return false;
   }
   
  var elem=document.forms['signup'].elements['group1'];
  len=elem.length-1;
  chkvalue='';
  for(i=0; i<=len; i++)
  {
    if(elem[i].checked)chkvalue=elem[i].value;	
  }
  if(chkvalue=='')
  {
    alert('How did you know about us?');
    return false;
  }
  
  
}

function validatemail(str,name) 
{
	var txt=str.value;
	var retval=true;
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(txt))	
	 retval=true;		
	else
	 retval=false;		
	if(!retval)
	{
		alert(name);
		str.focus();
	}
	return retval;
}

function bigwin(url)
{
	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=1100,height=650");
}

function PicWin(url)
{
	url = "../pic/" + url ;
	window.open(url,"","toolbar=no,location=no,left=1hahhagood 00,top=40,directories=no,status=no,menubar=no,resizable=no,scrollbars=no,width=800,height=580");
}
function Matrix(url)
{

	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=900,height=720");
}

function newpic(url)
{
	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,width=540,height=620");
}

function myacct(url)
{

	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=850,height=620");
}

function head(url)
{
	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=800,height=550");
}

function view(url) {
	newwindow=window.open(url,'htmlname',' left=200,top=0,width=420,height=570,resizable=0,scrollbars=yes');
}


function sele_win(url)
{

	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=680,height=450");
}

function tell(url)
{

	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=710,height=520");
}

function calmsg(url)
{

	window.open(url,"","toolbar=no,location=no,left=0,top=0,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,width=800,height=590");
}

function nlvcs(url)
{

	window.open(url,"","toolbar=no,location=no,left=180,top=0,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,width=800,height=720");
}

function OrWin(url)
{

	window.open(url,"","toolbar=no,location=no,left=300,top=200,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,width=500,height=400");
}
</script>


<script language="JavaScript" type="text/javascript">
function popup(myform)
{
	if (! window.focus)return true;
	var d = new Date();

	windowname = d.getTime();
	window.open('', windowname, 'top=30,left=50,height=650,width=1100,location=no,resizable=yes,scrollbars=yes,status=yes');
	myform.target=windowname;
	return true;
}

function popup3(myform)
{
	if (! window.focus)return true;
	var d = new Date();

	windowname = d.getTime();
	window.open('', windowname, 'top=50,left=20,height=550,width=980,resizable=0,scrollbars=yes');
	myform.target=windowname;
	return true;
}

function popup2(myform)
{
	if (! window.focus)return true;
	var d = new Date();

	windowname = d.getTime();
	window.open('', windowname, 'top=40,left=200,height=520,width=620,location=no,resizable=yes,scrollbars=no,status=no');
	myform.target=windowname;
	return true;
}
-->
</script>




<script type="text/javascript" src="<?=$domain?>/tips/prototype-1.7.0.0.js"></script>
<script type="text/javascript" src="<?=$domain?>/tips/scriptaculous-1.9.0/scriptaculous.js"></script>

	<script type="text/javascript" src="<?=$domain?>/tips/opentip.js"></script>
    <!--[if lt IE 9]><script type="text/javascript" src="<?=$domain?>/tips/excanvas.js"></script><![endif]-->
    <script type="text/javascript" src="<?=$domain?>/tips/excanvas.js"></script>
	
	<script type="text/javascript">
//        Opentip.useCss3Transitions = false;
//        Opentip.useScriptaculousTransitions = true;
		Opentip.debugging = true;
// 		Opentip.defaultStyle = 'rounded';
		Opentip.styles.codeSample = {
			showOn: 'click',
			hideOn: 'click',
			targetJoint: [ 'right', 'middle' ],
			tipJoint: [ 'left', 'middle' ],
			stem: true
		}
	</script>