<?php
/**
 * set document type
 * @param string $type type of document
 */
function set_content_type($type = 'application/json') {
    header('Content-Type: '.$type);
}

/**
 * Read CSV from URL or File
 * @param  string $filename  Filename
 * @param  string $delimiter Delimiter
 * @return array            [description]
 */
function read_csv($filename, $delimiter = ",") {
    $file_data = array();
    $handle = @fopen($filename, "r") or false;
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $file_data[] = $data;
        }
        fclose($handle);
    }
    return $file_data;
}

/**
 * Print Log to the page
 * @param  mixed  $var    Mixed Input
 * @param  boolean $pre    Append <pre> tag
 * @param  boolean $return Return Output
 * @return string/void     Dependent on the $return input
 */
function plog($var, $pre=true, $return=false) {
    $info = print_r($var, true);
    $result = $pre ? "<pre>$info</pre>" : $info;
    if ($return) return $result;
    else echo $result;
}

/**
 * Log to file
 * @param  string $log Log
 * @return void
 */
function elog($log, $fn = "debug.log") {
    $fp = fopen($fn, "a");
    fputs($fp, "[".date("d-m-Y h:i:s")."][Log] $log\r\n");
    fclose($fp); 
}
function getMonthName($monthId){
    if($monthId==="01"){
        return "มกราคม";
    }else if($monthId==="02"){
        return "กุมภาพันธ์";
    }else if($monthId==="03"){
        return "มีนาคม";
    }else if($monthId==="04"){
        return "เมษายน";
    }else if($monthId==="05"){
        return "พฤษภาคม";
    }else if($monthId==="06"){
        return "มิถุนายน";
    }else if($monthId==="07"){
        return "กรกฎาคม";
    }else if($monthId==="08"){
        return "สิงหาคม";
    }else if($monthId==="09"){
        return "กันยายน";
    }else if($monthId==="10"){
        return "ตุลาคม";
    }else if($monthId==="11"){
        return "พฤศจิกายน";
    }else if($monthId==="12"){
        return "ธันวาคม";
    } 
}
function getDayName($dayId){
    if($dayId==2){
        return "จันทร์";
    }else if($dayId==3){
        return "อังคาร";
    }else if($dayId==4){
        return "พุธ";
    }else if($dayId==5){
        return "พฤหัสบดี";
    }else if($dayId==6){
        return "ศุกร์";
    }else if($dayId==7){
        return "เสาร์";
    }else if($dayId==1){
        return "อาทิตย์";
    }else{
        return $dayId;
    }
}

?>