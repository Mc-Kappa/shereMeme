<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź, czy plik został przesłany bez błędów
    if (isset($_FILES["plik"]) && $_FILES["plik"]["error"] == UPLOAD_ERR_OK) {
        // Pobierz informacje o pliku za pomocą pathinfo
        $fileInfo = pathinfo($_FILES["plik"]["name"]);

        // Pobierz rozszerzenie pliku
        $fileExtension = $fileInfo["extension"];

        // Dozwolone rozszerzenia
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        // Sprawdź, czy rozszerzenie jest dozwolone
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            // Przesuń przesłany plik do docelowego katalogu
            move_uploaded_file($_FILES["plik"]["tmp_name"], "sciezka/do/katalogu/" . $_FILES["plik"]["name"]);

            echo "Plik został pomyślnie przesłany.";
        } else {
            echo "Niedozwolone rozszerzenie pliku.";
        }
    } else {
        echo "Błąd podczas przesyłania pliku.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    Wybierz plik do przesłania: <input type="file" name="plik">
    <input type="submit" value="Prześlij plik">
</form>
