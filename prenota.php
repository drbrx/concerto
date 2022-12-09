<head>
    <title>Concerti</title>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="style.css">
    <title></title>
</head>

<body>
    <header>
        <img src="images/logo.jpg" onclick="location.href='index.php'"></img>
        <a href="index.php">Biglietteria</a>
    </header>
    <div style="clear: both;"></div>
    <div id="main">

        <?php
        require_once("dbConnector.php");

        $query = "SELECT * FROM teventi WHERE id LIKE " . $_REQUEST['evento'];
        $rec = mysqli_query($dbConcerto, $query) or die($query);
        if ($currentRecord = mysqli_fetch_array($rec)) {
            if ($currentRecord['posti'] > 0) {
                echo  "<div>"
                    . "<div id=\"boxTitle\">"
                    . "<a>Conferma Prenotazione</a>"
                    . "</div>"
                    . "<div class=\"eventImage\">"
                    . "<img src=\"" . $currentRecord['imgPath'] . "\"></img>"
                    . "</div>"
                    . "Data: " . $currentRecord['data'] . "<br></br>"
                    . "Posti Disponibili: " . $currentRecord['posti'] . "<br></br>"
                    . "Prezzo: " . $currentRecord['costoBiglietto'] . "<br></br>"
                    . "<input type=\"button\" title=\"Prenota ora!\" onclick=\"location.href='invioPrenotazione.php?evento=" . $currentRecord['id'] . "'\" value=\"CONFERMA PRENOTAZIONE\"/>" . "<br></br>"
                    . "<input type=\"button\" title=\"Ritorna\" onclick=\"location.href='index.php'\" value=\"Ritorna alla schermata Home\"/>" . "<br></br>"
                    . "</div>";
            } else {
                echo  "<div>"
                    . "<div id=\"boxTitle\">"
                    . "<a>Posti esauriti...</a>"
                    . "</div>"
                    . "<p>"
                    . "Purtroppo i posti dell'evento del " . $currentRecord['data'] . " sono esauriti."
                    . "</p>"
                    . "</div>";
                $query = "SELECT * FROM teventi WHERE id LIKE " . (3 - $_REQUEST['evento']);
                $rec = mysqli_query($dbConcerto, $query) or die($query);
                if ($otherRecord = mysqli_fetch_array($rec)) {
                    if ($otherRecord['posti'] > 0) {
                        echo  "<div>"
                            . "<p>"
                            . "Sono però disponibili posti all'evento del " . $otherRecord['data'] . "!"
                            . "</p>"
                            . "Prenota: " . "<input type=\"button\" title=\"Prenota ora!\" onclick=\"location.href='prenota.php?evento=" . $otherRecord['id'] . "'\" value=\"" . $otherRecord['costoBiglietto'] . "\"/>" . "<br></br>"
                            . "<input type=\"button\" title=\"Ritorna\" onclick=\"location.href='index.php'\" value=\"Ritorna alla schermata Home\"/>" . "<br></br>"
                            . "</div>";
                    } else {
                        echo  "<div>"
                            . "<p>"
                            . "Non sono disponibili in questo momento posti in altre date."
                            . "</p>"
                            . "<input type=\"button\" title=\"Ritorna\" onclick=\"location.href='index.php'\" value=\"Ritorna alla schermata Home\"/>" . "<br></br>"
                            . "</div>";
                    }
                }
            }
        }
        ?>
    </div>
</body>