
<?php
// Database details
$db_server   = 'localhost';
$db_username = 'lohitv';
$db_password = 'redsky123';
$db_name     = 'pitstop2';
// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_lines' ||
      $job == 'get_line' ||
      $job == 'edit_line'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
    }
  } else {
    $job = '';
  }
}
// Prepare array
$mysql_data = array();
// Valid job found
if ($job != ''){
  
  // Connect to database
  $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  
  // Execute job
  if ($job == 'get_lines'){
    
    // Get companies
    $query = "SELECT * FROM csat_dump where flag=0 ORDER BY create_date";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($line = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="' . $line['SummaryID'] . '" data-name="' . $line['case_id'] . '"><span>Edit</span></a></li>';
        $functions .= '</ul></div>';
        $mysql_data[] = array(
          "id"          => $line['SummaryID'],
         // "scrub_Location"  => $line['scrub_Location'],
          "week_ending"    => $line['week_ending'],
          "date"       =>  $line['create_date'],
          "case_id"   => $line['case_id'],
          "queue"     => $line['queue'],
          "channel"    => $line['channel'],
          "manager"  => $line['manager'],
          "agent_name"  => $line['agent_name'],
          "csat_score"  => $line['csat_score'],
          "resolution_rate"  => $line['resolution_rate'],
          "verbatim"  => $line['verbatim'],
          "NPS"  => $line['NPS'],
          "site"  => $line['location'],
          "functions"     => $functions
        );
      }
    }
    
  } elseif ($job == 'get_line'){
    
    // Get Line
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing'.$id;
      
    } else {
      $query = "SELECT * FROM csat_dump WHERE SummaryID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($line = mysqli_fetch_array($query)){
          $mysql_data[] = array(
            "id" => $line['SummaryID'],
           // "scrub_Location"          => $line['scrub_Location'],
            "week_ending"  => $line['week_ending'],
            "date"    => $line['create_date'],
            "case_id"       => $line['case_id'],
            "queue"   => $line['queue'],
            "channel"     => $line['channel'],
            "manager"    => $line['manager'],
            "agent_name"  => $line['agent_name'],
            "csat_score" => $line['csat_score'],
            "resolution_rate" => $line['resolution_rate'],
            "verbatim" => $line['verbatim'],
            "NPS" => $line['NPS'],
            "level_1" => $line['level_1'],
            "level_2" => $line['level_2'],
            "level_3" => $line['level_3'],
            "site" => $line['site']
          );
        }
      }
    }
  
  } elseif ($job == 'edit_line'){
    
    // Edit company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "UPDATE csat_dump SET ";
      /*
      if (isset($_GET['scrub_Location'])) { $query .= "scrub_Location = '" . mysqli_real_escape_string($db_connection, $_GET['scrub_Location']) . "', "; }
      if (isset($_GET['week_ending'])) { $query .= "week_ending = '" . mysqli_real_escape_string($db_connection, $_GET['week_ending']) . "', "; }
      if (isset($_GET['date']))   { $query .= "date = '" . mysqli_real_escape_string($db_connection, $_GET['date'])   . "', "; }
      if (isset($_GET['case_id']))      { $query .= "case_id = '" . mysqli_real_escape_string($db_connection, $_GET['case_id'])      . "', "; }
      if (isset($_GET['queue']))  { $query .= "queue = '" . mysqli_real_escape_string($db_connection, $_GET['queue'])  . "', "; }
      if (isset($_GET['channel']))    { $query .= "channel = '" . mysqli_real_escape_string($db_connection, $_GET['channel'])    . "', "; }
      if (isset($_GET['manager']))   { $query .= "manager = '" . mysqli_real_escape_string($db_connection, $_GET['manager'])   . "', "; }
      if (isset($_GET['agent_name'])) { $query .= "agent_name = '" . mysqli_real_escape_string($db_connection, $_GET['agent_name']) . "', "; }
      if (isset($_GET['csat_score'])) { $query .= "csat_score = '" . mysqli_real_escape_string($db_connection, $_GET['csat_score']) . "', "; }
      if (isset($_GET['resolution_rate'])) { $query .= "resolution_rate = '" . mysqli_real_escape_string($db_connection, $_GET['resolution_rate']) . "', "; }
      if (isset($_GET['verbatim'])) { $query .= "verbatim = '" . mysqli_real_escape_string($db_connection, $_GET['verbatim']) . "', "; }
      if (isset($_GET['NPS'])) { $query .= "NPS = '" . mysqli_real_escape_string($db_connection, $_GET['NPS']) . "', "; }
      if (isset($_GET['scrub_name'])) { $query .= "scrub_name = '" . mysqli_real_escape_string($db_connection, $_GET['scrub_name']) . "', "; }
      */
      if (isset($_GET['level_1'])) { $query .= "level_1 = '" . mysqli_real_escape_string($db_connection, $_GET['level_1']) . "', "; }
      if (isset($_GET['level_2'])) { $query .= "level_2 = '" . mysqli_real_escape_string($db_connection, $_GET['level_2']) . "', "; }
      if (isset($_GET['level_3'])) { $query .= "level_3 = '" . mysqli_real_escape_string($db_connection, $_GET['level_3']) . "', "; }
      if (isset($_GET['yid'])) { $query .= "scrub_name = '" . mysqli_real_escape_string($db_connection, $_GET['yid']) . "', "; }
      if (isset($_GET['flag'])) { $query .= "flag = '" . mysqli_real_escape_string($db_connection, $_GET['flag']) . "', "; } 
      if (isset($_GET['relevant_comment'])) { $query .= "relevant_comment = '" . mysqli_real_escape_string($db_connection, $_GET['relevant_comment']) . "'"; }  

     // if (isset($_GET['site'])) { $query .= "site = '" . mysqli_real_escape_string($db_connection, $_GET['site']) . "'";   }
      $query .= "WHERE SummaryID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      //echo $query;
      
      $query  = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
    
  }
  
  // Close database connection
  mysqli_close($db_connection);
}
// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);
// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>