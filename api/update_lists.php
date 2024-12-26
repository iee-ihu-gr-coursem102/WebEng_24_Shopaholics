<?php
require "../config.php";
header('Content-Type: application/json; charset=utf-8');

//print_r($_POST);	//&& isset($_POST['item_id'])

if (isset($_POST['list_id']) ) {
	
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		//note object
		$updated_items = array(
								
				"item_id"			=> $_POST['item_id'],			
				"list_id"			=> $_POST['list_id'],
				"order_id"			=> $_POST['order_id'],
				"item"				=> $_POST['item'],
				"quantity"			=> $_POST['quantity'],
				"measuring_unit"	=> $_POST['measuring_unit'],
				"completed"			=> $_POST['completed'],	
		);
		
	$duplicates = '';
		foreach ($updated_items as $key => $value) {
		$duplicates .= "{$key} = VALUES({$key}), ";
		}
		$duplicates = rtrim($duplicates, ', '); 
		
	$sql = sprintf(
		"INSERT INTO %s (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s",
		"items",
		implode(", ", array_keys($updated_items)),
		":" . implode(", :", array_keys($updated_items)),
		$duplicates
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($updated_items);
		
		// Check if the statement was executed successfully
if ($statement) {
    // Get the last inserted ID if the insert was successful
    $lastInsertId = $connection->lastInsertId();
    
    // Check if rows were affected (if an update occurred)
    $rowCount = $statement->rowCount();

    // Prepare the response
    if ($rowCount > 0) {
        $response = array(
            "status" => "success",
            "message" => "Record inserted/updated successfully.",
            "last_inserted_id" => $lastInsertId,
            "affected_rows" => $rowCount
        );
    } else {
        $response = array(
            "status" => "info",
            "message" => "No changes made to existing record.",
            "last_inserted_id" => null,
            "affected_rows" => $rowCount
        );
    }
} else {
    $response = array(
        "status" => "error",
        "message" => "Failed to execute the query.",
        "error" => $statement->errorInfo()
    );
}

// Output the response (you can return this as a JSON response if needed)
echo json_encode($response);

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
} 



exit;

// else {

		// try {
			
			// $connection = new PDO($dsn, $username, $password, $options);
			
			// $sql_note_update = "SELECT * FROM note WHERE idnote=$_SESSION[last_id]";

			// $statement = $connection->prepare($sql_note_update);
			// $statement->execute();
			// $note = $statement->fetch();
			
			// $contest = [
				// "idnote"			=> $note['idnote'],
				// "idnoteyear"		=> $note['idnoteyear'],
				// "year"				=> $note['year'],
				// "isolation_cause"	=> $_POST['isolation_cause'],
				// "grammi_mt1"		=> $_POST['grammi_mt1'],
				// "kedd"				=> $_POST['kedd'],
				// "pub_date"			=> $_POST['pub_date'],
				// "exec_date"			=> $_POST['exec_date'],
				// "to_area1"			=> $_POST['to_area1'],
				// "to_area2"			=> $_POST['to_area2'],
				// "to_area3"			=> $_POST['to_area3'],
				// "to_area4"			=> $_POST['to_area4'],				
				// "isol_goal"			=> $_POST['isol_goal'],
				// "sap"				=> $_POST['sap'],
				// "cable_pointer"		=> $_POST['cable_pointer'],
				// "cable_perfor"		=> $_POST['cable_perfor'],
				// "cable_phase"		=> $_POST['cable_phase'],			
				// "ant_phase"			=> $_POST['ant_phase'],
				// "per_phase"			=> $_POST['per_phase'],
				// "paratiriseis"		=> $_POST['paratiriseis'],
				// "editor"			=> $_POST['editor'],
				// "controller"		=> $_POST['controller'],
				// "checkbox"			=> $_POST['checkbox']
			// ];
			
	// if($contest["pub_date"] =="" && !$contest["exec_date"]==""){		
			
			// $sql7 = "UPDATE note 
				// SET idnote = :idnote,
				  // idnoteyear = :idnoteyear,
				  // year = :year,				  
				  // kedd = :kedd,
				  // isolation_cause = :isolation_cause,
				  // grammi_mt1 = :grammi_mt1,
				  // exec_date = :exec_date,
				  // to_area1 = :to_area1,
				  // to_area2 = :to_area2,
				  // to_area3 = :to_area3,
				  // to_area4 = :to_area4,				  
				  // isol_goal = :isol_goal,
				  // sap = :sap,
				  // isol_goal = :isol_goal,
				  // cable_pointer = :cable_pointer,
				  // cable_perfor = :cable_perfor,
				  // cable_phase = :cable_phase,
				  // ant_phase = :ant_phase,
				  // per_phase = :per_phase,
				  // paratiriseis = :paratiriseis,
				  // editor = :editor,
				  // controller = :controller,
				  // checkbox = :checkbox
				// WHERE idnote = :idnote";
				
	// }else if(!$contest["pub_date"] =="" && $contest["exec_date"]==""){		
			
			// $sql7 = "UPDATE note 
				// SET idnote = :idnote,
				  // idnoteyear = :idnoteyear,
				  // year = :year,				  
				  // kedd = :kedd,
				  // isolation_cause = :isolation_cause,
				  // grammi_mt1 = :grammi_mt1,
				  // pub_date = :pub_date, 
				  // to_area1 = :to_area1,
				  // to_area2 = :to_area2,
				  // to_area3 = :to_area3,
				  // to_area4 = :to_area4,
				  // isol_goal = :isol_goal,
				  // sap = :sap,
				  // isol_goal = :isol_goal,
				  // cable_pointer = :cable_pointer,
				  // cable_perfor = :cable_perfor,
				  // cable_phase = :cable_phase,
				  // ant_phase = :ant_phase,
				  // per_phase = :per_phase,
				  // paratiriseis = :paratiriseis,
				  // editor = :editor,
				  // controller = :controller,
				  // checkbox = :checkbox
				// WHERE idnote = :idnote";
				
	// }else if($contest["pub_date"] =="" && $contest["exec_date"] ==""){		
			
			// $sql7 = "UPDATE note 
				// SET idnote = :idnote,
				  // idnoteyear = :idnoteyear,
				  // year = :year,				  
				  // kedd = :kedd,
				  // isolation_cause = :isolation_cause,
				  // grammi_mt1 = :grammi_mt1,
				  // to_area1 = :to_area1,
				  // to_area2 = :to_area2,
				  // to_area3 = :to_area3,
				  // to_area4 = :to_area4,				  
				  // isol_goal = :isol_goal,
				  // sap = :sap,
				  // isol_goal = :isol_goal,
				  // cable_pointer = :cable_pointer,
				  // cable_perfor = :cable_perfor,
				  // cable_phase = :cable_phase,
				  // ant_phase = :ant_phase,
				  // per_phase = :per_phase,
				  // paratiriseis = :paratiriseis,
				  // editor = :editor,
				  // controller = :controller,
				  // checkbox = :checkbox
				// WHERE idnote = :idnote";
				
	// }else{
			// $sql7 = "UPDATE note 
				// SET idnote = :idnote,
				  // idnoteyear = :idnoteyear,
				  // year = :year,				  
				  // kedd = :kedd,
				  // isolation_cause = :isolation_cause,
				  // grammi_mt1 = :grammi_mt1,
				  // pub_date = :pub_date, 
				  // exec_date = :exec_date,
				  // to_area1 = :to_area1,
				  // to_area2 = :to_area2,
				  // to_area3 = :to_area3,
				  // to_area4 = :to_area4,				  
				  // isol_goal = :isol_goal,
				  // sap = :sap,
				  // isol_goal = :isol_goal,
				  // cable_pointer = :cable_pointer,
				  // cable_perfor = :cable_perfor,
				  // cable_phase = :cable_phase,
				  // ant_phase = :ant_phase,
				  // per_phase = :per_phase,
				  // paratiriseis = :paratiriseis,
				  // editor = :editor,
				  // controller = :controller,
				  // checkbox = :checkbox
				// WHERE idnote = :idnote";
		
	// }
	  
		// $statement_note = $connection->prepare($sql7);
		// $statement_note->execute($contest);
		// } catch(PDOException $error) {
		  // echo $sql7 . "<br>" . $error->getMessage();
		// }
// }

// if (isset($_POST['wir_emp'])||isset($_POST['wir_descr'])) {	
			
	// try {		
		// $connection = new PDO($dsn, $username, $password, $options);
				
		// $wir_id		= $_POST['wir_id'];		
		// $wir_emp  	= $_POST['wir_emp'];
		// $wir_descr  = $_POST['wir_descr'];
		// $wir_date   = $_POST['wir_date'];
		// $wir_start  = $_POST['wir_start'];
		// $wir_finish = $_POST['wir_finish'];
		// $currentDataWir = 0;

		// foreach ($wir_id as $wirID) {
			// $currentDataWir = $currentDataWir+1;
			
		// if($wir_date[$currentDataWir-1]==""){$wir_date[$currentDataWir-1]=null;}

		// if ($wir_id[$currentDataWir-1]=="new_wir_line"){

		//note object
		// $new_wiring = array(
			// "aa_wir"  		=> $currentDataWir,
			// "aa_wir_emp"  	=> $wir_emp[$currentDataWir-1],
			// "descr"  		=> $wir_descr[$currentDataWir-1],
			// "imerominia"    => $wir_date[$currentDataWir-1],
			// "start"     	=> $wir_start[$currentDataWir-1],
			// "fin"     		=> $wir_finish[$currentDataWir-1],			
			// "idnote"		=> $note['idnoteyear'],
			// "year"			=> $note['year']
		// );
			
		// $sql_wir_write = sprintf(
				// "INSERT INTO %s (%s) values (%s)",
				// "wiring",
				// implode(", ", array_keys($new_wiring)),
				// ":" . implode(", :", array_keys($new_wiring))
		// );
		
		// $statement = $connection->prepare($sql_wir_write);
		// $statement->execute($new_wiring);
		
		// }else{	
				

		
		//note object
		// $update_wiring = array(
			// "idwiring"  	=> $wir_id[$currentDataWir-1],
			// "aa_wir"  		=> $currentDataWir,
			// "aa_wir_emp"  	=> $wir_emp[$currentDataWir-1],
			// "descr"  		=> $wir_descr[$currentDataWir-1],
			// "imerominia"    => $wir_date[$currentDataWir-1],
			// "start"     	=> $wir_start[$currentDataWir-1],
			// "fin"     		=> $wir_finish[$currentDataWir-1],			
			// "idnote"		=> $note['idnoteyear'],
			// "year"			=> $note['year']
		// );
		
		
		
		// foreach ($update_wiring as $upWir) {
			
			// if($update_wiring["imerominia"]==""){
			
				// $new_data = array("new_data" =>
				// "aa_wir='" . $update_wiring["aa_wir"] . "'" .
				// ", aa_wir_emp='" . $update_wiring["aa_wir_emp"] . "'" . 
				// ", descr='" . $update_wiring["descr"] . "'" .
			//	", imerominia='" . $update_wiring["imerominia"] . "'" .
				// ", start='" . $update_wiring["start"] . "'" .
				// ", fin='" . $update_wiring["fin"] . "'" .
				// ", idnote='" . $update_wiring["idnote"] . "'" .
				// ", year='" .	 $update_wiring["year"] . "'"				
				// );
			// }else{
				// $new_data = array("new_data" =>
				// "aa_wir='" . $update_wiring["aa_wir"] . "'" .
				// ", aa_wir_emp='" . $update_wiring["aa_wir_emp"] . "'" . 
				// ", descr='" . $update_wiring["descr"] . "'" .
				// ", imerominia='" . $update_wiring["imerominia"] . "'" .
				// ", start='" . $update_wiring["start"] . "'" .
				// ", fin='" . $update_wiring["fin"] . "'" .
				// ", idnote='" . $update_wiring["idnote"] . "'" .
				// ", year='" .	 $update_wiring["year"] . "'"				
				// );
			// }
		// }	

// print_r($update_wiring);

		// $sql_update = sprintf("UPDATE %s SET %s WHERE %s",
								// "wiring",
								// implode($new_data),
								// "idwiring = " . $update_wiring["idwiring"]
		// );
		
		// $statement = $connection->prepare($sql_update);
		// $statement->execute();
		// }
	// }	
	// } catch(PDOException $error) {
		// echo $sql_update . "<br>" . $error->getMessage();
	// }
// }

// if (isset($_POST['iso_emp'])||isset($_POST['iso_descr'])) {

	// try {

		// $connection = new PDO($dsn, $username, $password, $options);

		// $iso_id		= $_POST['iso_id'];
		// $iso_descr  = $_POST['iso_descr'];
		// $iso_emp	= $_POST['iso_emp'];
		// $currentDataIso = 0;

		// foreach ($iso_id as $isoID) {
			// $currentDataIso = $currentDataIso+1;

		// if ($iso_id[$currentDataIso-1]=="new_isol_line"){

		// $new_isolation = array(	
			// "aa_isol"  		=> $currentDataIso,
			// "aa_isol_emp"  	=> $iso_emp[$currentDataIso-1],
			// "descr"  		=> $iso_descr[$currentDataIso-1],
			// "idnote"		=> $note['idnoteyear'],
			// "year"			=> $note['year']
		// );	
			
		// $sql_new_isolation = sprintf(
				// "INSERT INTO %s (%s) values (%s)",
				// "isolation",
				// implode(", ", array_keys($new_isolation)),
				// ":" . implode(", :", array_keys($new_isolation))
				// );
		
		// $statement = $connection->prepare($sql_new_isolation);
		// $statement->execute($new_isolation);
		
		// }else{
			
		//note object
		// $update_isolation = array(
			// "idisolation"  	=> $iso_id[$currentDataIso-1],
			// "aa_isol"  		=> $currentDataIso,
			// "aa_isol_emp"  	=> $iso_emp[$currentDataIso-1],
			// "descr"  		=> $iso_descr[$currentDataIso-1],
			// "idnote"		=> $note['idnoteyear'],
			// "year"			=> $note['year']
			// );

		
		// foreach ($update_isolation as $upIso) {
				// $new_data = array("new_data" =>
				// "aa_isol='" . $update_isolation["aa_isol"] . "'" .
				// ", aa_isol_emp='" . $update_isolation["aa_isol_emp"] . "'" . 
				// ", descr='" . $update_isolation["descr"] . "'" .
				// ", idnote='" . $update_isolation["idnote"] . "'" .
				// ", year='" .	 $update_isolation["year"] . "'"				
				// );
			// }

		// $sql_update = sprintf("UPDATE %s SET %s WHERE %s",
								// "isolation",
								// implode($new_data),
								// "idisolation = " . $update_isolation["idisolation"]
		// );
		
		// $statement = $connection->prepare($sql_update);
		// $statement->execute();
		// }	
	// }
	// } catch(PDOException $error) {
		// echo $sql_update . "<br>" . $error->getMessage();
	// }
// }
?>
