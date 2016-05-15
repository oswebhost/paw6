<?php
/**
 * @author IM Khan
 * @copyright 2012
 */

session_start();

?>

<?php if (!isset($_SESSION["userid"])){ ?>


<?php if($bluebox_message==100){ ?>
<div style='text-align:justify;width:490px; margin:10px auto 0 auto;border:1px solid #23488C;background:#E9EFFF;padding:8px;font-size:13px;font-family: tahoma;line-height:150%'>

Our Program selects the Top 6 fixtures that are most likely to produce Home Wins under 4 different categories: Midweek Preferences, Short Odds, Medium Odds and Long Shots.<br />
 
Our Program's selections are made based on the highest Probabilities coupled with the highest Performance Reliabilities, yet you will see that the Home Teams involved often do not perform as expected.  The Bookies' Over-Round is therefore a killer.  And yet, this season, our Program's LONG SHOT calls have amazed us by being the only category to make money...............Now, doesn't that make you wonder about what's going on?   
 
  Our advice?  You will find it hard to make money this season betting on Short Odds matches.
  </div>
  
<?php }elseif ($bluebox_message<>200){?>

<div style='text-align:center;width:490px; margin:10px auto 0 auto;border:1px solid #23488C;background:#E9EFFF;padding:8px;font-size:13px;font-family: tahoma;line-height:150%'>

Our past data records are just one example of the fantastic tools we provide for helping you decide your current week's betting selections.  Even non-paying visitors can view the historic data by clicking on the headings shown below.
</div>
<?php }?>
   

<br /><br />

<?php }?>



<br />
<table border="0" cellpadding="2" cellspacing="0" style="margin:auto auto;width:550px">
    <tr>
        <td width="50%" class="credit padd ctd">
            <a class='mblue' href="<?php echo $PHP_SELF;?>?db=eu"><img src="images/eurodivs.gif" border='0' alt="European Divisions" /></a> 
        </td>    
        <td width="50%" class="credit ctd padd" style='color:blue;'>
            <a class="mblue" href="<?php echo $PHP_SELF;?>?db=sa"><img src="images/sadivs.gif" border='0' alt="American Divisions" /></a>
        </td>
    </tr>
 </table>