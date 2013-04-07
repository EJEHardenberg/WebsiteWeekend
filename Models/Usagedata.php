<?php
/**
*
*
*
**/
class Usagedata{
	public $view;
	public $vars;

	public function usageOverTIme(){
		$query = "SELECT Count(*) as qty, month(visitDate) ";
		$query .= "as month,day(visitDate) as day,year(visitDate) ";
		$query .= "as year FROM `tblRoomUsage` GROUP BY year(visitDate), ";
		$query .= "month(visitDate), day(visitDate)";

		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		return $dbWrapper->returnedRows;
	}

	public function purpose(){
		// grab all of our purposes
		$query = "SELECT count(1) as peoples, ";
		$query .= "purpose FROM tblRoomUsage tru";
		$query .= " ,tblPurpose p WHERE tru.fkPurpose=p.pkID GROUP BY p.pkID";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
		$purposeData = array();
		for($ii=0; $ii<count($dbWrapper->returnedRows); $ii++){
			$purposeData[$ii]['qty'] = (int)$dbWrapper->returnedRows[$ii]['peoples'];
			$purposeData[$ii]['purpose'] = $dbWrapper->returnedRows[$ii]['purpose'];
		}
		return $purposeData;
	}
	public function byClass(){
		$array = array('tableName'=>'tblRoomUsage');
		$dbWrapper = new InteractDB('select', $array);

	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackModel Class Def