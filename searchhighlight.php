<?php

//define the style for search-terms
$HTMLStylesFmt['highlight']=".highlight { background-color: #9999FF }";
//get the referrer and separate the arguments
$query=explode('&', parse_url($_SERVER['HTTP_REFERER'],PHP_URL_QUERY));
//initialisation
$terms=array();
//check arguments if they are search-terms
foreach($query as $part){
    //separate argument in key-value-pairs
    list($key, $value)=explode('=',$part);
    //check if current argument is a search-term
    if ($key=="q"){
        //separate words and save them as search-terms
        $terms=explode('+',$value);
    }
}
//generate dynamic markup for each word the user was searching for
foreach($terms as $term){
    if($term){
        Markup("hl".$term, "<_end", "/(<[^>]*>|".$term.")/ie", "highlight('$1')");
    }
}

function highlight($input){
    if ($input[0]=="<"){
        return $input;
    }else{
        return "<span class='highlight'>".$input."</span>";
    }
}
