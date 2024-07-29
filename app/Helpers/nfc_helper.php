<?php





 function name(){
   echo "<h1>Saurbh</h1>";
}


function get_setting($id){
  $db = db_connect();
  $arr =  $db->table("setting")->where("id",$id)->get()->getRowArray();
  return $arr;
}



?>