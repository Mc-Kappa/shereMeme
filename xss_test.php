<?php
    
    $factor_regex = "^[0-9]{10}$";

    $text = '6481316878';
    if (!preg_match('/'.$factor_regex.'/', $text))
    {
    echo "10"; 
    }
    else
    {
      echo "NIE 10"; 
    }