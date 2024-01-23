<?php

$tekst = "3814100154"; // Przykładowy tekst

$wyrazenie_regularne = "^[0-9]{10}$";

if (preg_match('/' . $wyrazenie_regularne . '/', $tekst)) {
    echo "Tekst zawiera dokładnie 10 cyfr.";
} else {
    echo "Tekst nie zawiera dokładnie 10 cyfr.";
}

?>