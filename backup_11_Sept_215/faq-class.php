<?php

include("config.ini.php");

//print_r($_POST);

$faq = new faq();

// faq category operations 
if ($_POST['faq']=='category'){

	if ($_POST['action']=='EDIT' and isset($_POST['catid']) ){
		$faq->update_faqcat($_POST['catid'], $_POST['category'],$_POST['rank']);
	}

	if ($_POST['action']=='ADD' and $_POST['catid']==''){
		$faq->insert_faqcat($_POST['category'],$_POST['rank']);
	}

}

// question and answer updates
if ($_POST['faq']=='faq'){

	if ($_POST['action']=='EDIT'){
		$faq->update_faq($_POST['rid'], $_POST['question'], $_POST['answer'], $_POST['cat'], $_POST['rank']);
	}

	if ($_POST['action']=='ADD'){
		$faq->insert_faq($_POST['question'], $_POST['answer'], $_POST['cat'], $_POST['rank']);
	}



}



class faq
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

	

	function getfaq($id)
	{
		global $eu;
		$q = "SELECT f.*, c.category FROM faqs f, faqcat c WHERE f.rid='$id' and f.catid=c.catid"; 
		$temp = $eu->prepare($q);
		$temp->execute();
		$d = $temp->fetch();

		$this->rid = $d["rid"];
		$this->date = $d["date"];
		$this->ansby = $d["ansby"];
		$this->question = stripslashes($d["question"]);
		$this->answer = stripslashes($d["answer"]);
		$this->viewed = $d["viewed"];
		$this->rank = $d["rank"];

		$this->catid = $d["catid"];
		$this->category = stripslashes($d["category"]);

	}


	function addcount($id) 
	{
		global $eu;
		$q = "UPDATE faqs SET viewed = viewed+1 WHERE rid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}

	function countfaqbycategory($id)
	{
		global $eu;
		$q = "SELECT count(rid) as cno FROM faqs WHERE catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		$tmpdata = $temp->fetch();
		return (int) $tmpdata['cno'];
	}

	function category_name($id)
	{
		global $eu;
		$q = "SELECT category FROM faqcat WHERE catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		$tmpdata = $temp->fetch();
		return stripslashes($tmpdata['category']);
	}
	function category_rank($id)
	{
		global $eu;
		$q = "SELECT rank FROM faqcat WHERE catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		$tmpdata = $temp->fetch();
		return (int) $tmpdata['rank'];
	}
	

	function insert_faqcat($category,$rank)
	{
		global $eu;
		$q = "INSERT INTO faqcat (category,rank) VALUES ('". addslashes($category)."','$rank')";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->lastinsertid();
	}

	function update_faqcat($id, $category,$rank)
	{
		global $eu;
		$q = "UPDATE faqcat set  category ='".addslashes($category)."', rank ='$rank' where catid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}

	function delete_faqcat($id)
	{
		global $eu;

		if ($this->countfaqbycategory($id)>0){
			return 0;
		}else{
			$q = "DELETE FROM faqcat WHERE catid='$id'";
			$temp = $eu->prepare($q);
			$temp->execute();
			return $temp->rowcount();
		}	
		
	}


	// FAQ insert
	function insert_faq($question, $answer, $catid, $rank)
	{
		global $eu;
		$q = "INSERT INTO faqs (date,ansby,question,answer,catid,rank) VALUES (now(),'Woz','".addslashes($question)."','".addslashes($answer)."','$catid','$rank')";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $eu->lastinsertid();
	}

	function update_faq($id, $question, $answer, $catid, $rank)
	{
		global $eu;
		$q = "UPDATE faqs SET question='". addslashes($question) ."', answer='". addslashes($answer)."', catid='$catid', rank='$rank' WHERE rid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}

	function delete_faq($id)
	{
		global $eu;
		$q = "DELETE FROM faqs WHERE rid='$id'";
		$temp = $eu->prepare($q);
		$temp->execute();
		return $temp->rowcount();
	}




}


?>