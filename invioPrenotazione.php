<head>
    <title>Biglietto</title>
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
            $codiceBiglietto = $_REQUEST['evento'] . preg_replace('/[^0-9]/', '', str_replace(' ', '-', (date("Y-m-d h:i:sa") . $currentRecord['costoBiglietto'])));
            $insert = "INSERT INTO tprenotazioni (idEvento, codice) VALUES ('" . $_REQUEST['evento'] . "', '" . $codiceBiglietto . "')";
            if (mysqli_query($dbConcerto, $insert) or die($insert)) {
                $update = "UPDATE teventi SET posti = '" . ($currentRecord['posti'] - 1) . "' WHERE id LIKE " . $_REQUEST['evento'];
                if (mysqli_query($dbConcerto, $update) or die($update)) {
                    echo  "<div>"
                        . "<div id=\"boxTitle\">"
                        . "<a>Il tuo biglietto</a>"
                        . "</div>"
                        . "<div class=\"eventImage\">"
                        . "<img src=\"" . $currentRecord['imgPath'] . "\"></img>"
                        . "</div>"
                        . "Data: " . $currentRecord['data'] . "<br></br>"
                        . "Prezzo: " . $currentRecord['costoBiglietto'] . "<br></br>"
                        . "<a id=\"code\">" . "Codice univoco: " . $codiceBiglietto . "</a>" . "<br></br>"
                        . "<input type=\"button\" title=\"Ritorna\" onclick=\"location.href='index.php'\" value=\"Ritorna alla schermata Home\"/>" . "<br></br>"
                        . "</div>";
                }
            }
        }
        ?>
    </div>
</body>