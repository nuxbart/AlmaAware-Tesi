<?php

//funzione che mi registra l'utente loggato nella sessione 
function registerLoggedUser($user){
    $_SESSION["email"] = $user["email"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["campus"] = $user["campus"];
    $_SESSION["password"] = $user["password"];
    $_SESSION["idMyFlower"] = $user["idMyFlower"];
}

function colorSdg($sdg){
    if($sdg == 1){
        return "#E5243B";
    }
    if($sdg == 2){
        return "#DDA63A";
    }
    if($sdg == 3){
        return "#4C9F38";
    }
    if($sdg == 4){
        return "#C5192D";
    }
    if($sdg == 5){
        return "#ff3a21";
    }
    if($sdg == 6){
        return "#26bde2";
    }
    if($sdg == 7){
        return "#FCC30B";
    }
    if($sdg == 8){
        return "#A21942";
    }
    if($sdg == 9){
        return "#FD6925";
    }
    if($sdg == 10){
        return "#DD1367";
    }
    if($sdg == 11){
        return "#FD9D24";
    }
    if($sdg == 12){
        return "#BF8B2E";
    }
    if($sdg == 13){
        return "#3F7E44";
    }
    if($sdg == 14){
        return "#0A97D9";
    }
    if($sdg == 15){
        return "#56C02B";
    }
    if($sdg == 16){
        return "#00689D";
    }
    if($sdg == 17){
        return "#19486a";
    }
    return "";
}

?>