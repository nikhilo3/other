<?php
    $str = "this is string";
    echo $str;
    echo "<br><br>";

    echo var_dump($str)."<br>";
    echo "the lenght of this string is :". strlen($str)."<br>";
    echo "the word of the string is :". str_word_count($str)."<br>";
    echo "reverse  : ". strrev($str)."<br>";
    echo "position of the number is : ". strpos($str,"str")."<br>";
    echo "replace string is  : ". str_replace("string","array",$str)."<br>";

    
    ?>