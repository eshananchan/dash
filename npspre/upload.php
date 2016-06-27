<?php

$message = null;

$allowed_extensions = array('csv');

$upload_path = '/var/www/html/uploads';
if (!empty($_FILES['file'])) {
    if ($_FILES['file']['error'] == 0) {
        //echo '<script type="text/javascript">alert("Step: 3");</script>';
        // check extension
        $file      = explode(".", $_FILES['file']['name']);
        $extension = array_pop($file);
        
        if (in_array($extension, $allowed_extensions)) {
            
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . '/' . $_FILES['file']['name'])) {
                if (($handle = fopen($upload_path . '/' . $_FILES['file']['name'], "r")) !== false) {
                    
                    $keys = array();
                    $out  = array();
                    
                    $insert = array();
                    
                    $line = 1;
                    
                    while (($row = fgetcsv($handle, 0, ',', '"')) !== FALSE) {
                        
                        foreach ($row as $key => $value) {
                            if ($line === 1) {
                                $keys[$key] = str_replace("?", "", $value);
                            } else {
                                $out[$line][$key] = $value;
                            }
                        }
                        
                        $line++;
                        
                    }
                    
                    fclose($handle);
                    
                    if (!empty($keys) && !empty($out)) {
                        
                        $db = new PDO('mysql:host=localhost;dbname=pitstop', 'ysb_dashboard', 'NUycXJGtuTFjtSXF');
                        $db->exec("SET CHARACTER SET utf8");
                        foreach ($out as $key => $value) {
                            $sql = "INSERT INTO `NPS_dump` (`";
                            $sql .= implode("`, `", $keys);
                            $sql .= "`) VALUES (";
                            $sql .= implode(", ", array_fill(0, count($keys), "?"));
                            $sql .= ")";
                            $statement = $db->prepare($sql);
                            $statement->execute($value);
                            //echo $sql;
                        }
                        
                        $message = '<span class="green">File has been uploaded successfully</span>';
                        
                    }
                    
                }
                
            }
            
        } else {
            $message = '<span class="red">Only .csv file format is allowed</span>';
        }
        
    } else {
        $message = '<span class="red">There was a problem with your file</span>';
    }
}

?>
<html>
<form action="" method="post" enctype="multipart/form-data">
<table>
            <tr>
            <?php
if (!empty($message)) {
    echo "<div>" . $message . "</div>";
}
?>
           </tr>
            <tr>
                <td><input type="file" name="file" id="file" size="99"/></td>
            </tr>
            <tr>
                <td><input type="submit" id="btn" value="Submit"/></td>
            </tr>
        </table>
        </form>
</html>