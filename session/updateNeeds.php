<?php
    // atualizar necessidades no login
    $getDate  = ("SELECT UNIX_TIMESTAMP() - UNIX_TIMESTAMP(close_date) from player where Player_ID = ".$player_id."");
    $result = @mysqli_query($dbcon, $getDate);
    $a = mysqli_fetch_assoc($result);
    $string =  json_encode($a);
    $pieces = explode('"', $string);
    $last_word = array_pop($pieces);
    $other_last =  array_pop($pieces);
    $difference = intval ($other_last) * 0.0007;


    $query_needs =("SELECT hygiene, hunger, health, energy, happiness from pet where player_id =".$player_id."");
    $queryResult_needs= @mysqli_query($dbcon, $query_needs);

    while($row = mysqli_fetch_array($queryResult_needs, MYSQLI_ASSOC)){
        
        if($row['hygiene'] < $difference){
            $update  = ("UPDATE pet set hygiene = 0 where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }else{
            $update  = ("UPDATE pet set hygiene = hygiene -".$difference." where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }
        if($row['hunger'] < $difference){
            $update  = ("UPDATE pet set hunger = 0 where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }else{
            $update  = ("UPDATE pet set hunger = hunger -".$difference." where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }
        if($row['happiness'] < $difference){
            $update  = ("UPDATE pet set happiness = 0 where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }else{
            $update  = ("UPDATE pet set happiness = happiness -".$difference." where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }
        if($row['energy'] < $difference){
            $update  = ("UPDATE pet set energy = 0 where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }else{
            $update  = ("UPDATE pet set energy = energy -".$difference." where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }      
        if($row['health'] < $difference){
            $update  = ("UPDATE pet set health = 0 where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }else{
            $update  = ("UPDATE pet set health = health -".$difference." where player_id = ".$player_id."");
            $updateNeed  = @mysqli_query($dbcon, $update);
        }
    }
?>