<?php

include("config.ini.php");

//print_r($_POST);

$bettingadvice = new bettingadvice();

// bettingadvice category operations 
if ($_POST['bettingadvice']=='category'){

	if ($_POST['action']=='EDIT' and isset($_POST['catid']) ){
		$bettingadvice->update_bettingadvicecat($_POST['catid'], $_POST['category'],$_POST['rank']);
	}

	if ($_POST['action']=='ADD' and $_POST['catid']==''){
		$bettingadvice->insert_bettingadvicecat($_POST['category'],$_POST['rank']);
	}
}


// question and answer updates
if ($_POST['bettingadvice']=='bettingadvice'){

	if ($_POST['action']=='EDIT'){
		$bettingadvice->update_bettingadvice($_POST['rid'], $_POST['question'], $_POST['answer'], $_POST['cat'], $_POST['rank']);
	}

	if ($_POST['action']=='ADD'){
		$bettingadvice->insert_bettingadvice($_POST['question'], $_POST['answer'], $_POST['cat'], $_POST['rank']);
	}
}



class bettingadvice
{

	var $catid   = '';
	var $category= '';

	var $rid     = '';
	var $date    = '';
	var $ansby   = '';
	var $question= '';
	var $answer  = '';
	var $viewed  = '';
	var $rank    = '';

	

	function getbettingadvice($id)
	{
		global $eu;
		$q = "SELECT f.*, c.category FROM bettingadvice f, bettingadvice_cat c WHERE f.rid='$id' and f.catid=c.catid"; 
		$temp = $eu->prepare($q);
		$temp->execute();
		$d = $temp->fetch();

		$this->rid = $d["rid"];
		$this->date = $d["date"];
		$this->ansby = $d["ansby"];
		$this->question = stripslashes($d["question"]);

		$answer = stripslashes($d["answer"]);
		
		//$answer = ereg_replace("%image%", "<img border='0' alt='' src='images/bettingadvice/", $answer);
		//$answer = ereg_replace("%endimage%", "' />", $answer);

		$this->answer = $answer;

		$this->viewed = $d["viewed"];
		$this->rank = $d["rank"];

		$this->catid = $d["catid"];
		$this->category = stripslashes($d["category"]);

	}

	function addcount($id) 
	{
		global $eu;
		$q = "UPDATE bettingadvice SET viewed = viewed+1 WHERE rid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}

	function countbettingadvicebycategory($id)
	{
		global $eu;
		$q = "SELECT count(rid) as cno FROM bettingadvice WHERE catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		$tmpdata = $temp->fetch();
		return (int) $tmpdata['cno'];
	}

	function category_name($id)
	{
		global $eu;
		$q = "SELECT category FROM bettingadvice_cat WHERE catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		$tmpdata = $temp->fetch();
		return stripslashes($tmpdata['category']);
	}

	function category_rank($id)
	{
		global $eu;
		$q = "SELECT rank FROM bettingadvice_cat WHERE catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		$tmpdata = $temp->fetch();
		return (int) $tmpdata['rank'];
	}
	
	function insert_bettingadvicecat($category,$rank)
	{
		global $eu;
		$q = "INSERT INTO bettingadvice_cat (category,rank) VALUES ('". addslashes($category)."','$rank')";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $eu->lastinsertid();
	}

	function update_bettingadvicecat($id, $category,$rank)
	{
		global $eu;
		$q = "UPDATE bettingadvice_cat set  category ='".addslashes($category)."', rank ='$rank' where catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}

	function delete_bettingadvicecat($id)
	{
		global $eu;

		if ($this->countbettingadvicebycategory($id)>0){
			return 0;
		}else{
			$q = "DELETE FROM bettingadvice_cat WHERE catid='$id'";
			$temp = $eu->prepare($q);
			$temp->execute();
			return $temp->rowcount();
		}	
		
	}


	// bettingadvice insert
	function insert_bettingadvice($question, $answer, $catid, $rank)
	{
		global $eu;
		$q = "INSERT INTO bettingadvice (date,ansby,question,answer,catid,rank) VALUES (now(),'Woz','".addslashes($question)."','".addslashes($answer)."','$catid','$rank')";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $eu->lastinsertid();
	}

	function update_bettingadvice($id, $question, $answer, $catid, $rank)
	{
		global $eu;
		$q = "UPDATE bettingadvice SET question='". addslashes($question) ."', answer='". addslashes($answer)."', catid='$catid', rank='$rank' WHERE rid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}

	function delete_bettingadvice($id)
	{
		global $eu;
		$q = "DELETE FROM bettingadvice WHERE rid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}


}


?>