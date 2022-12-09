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
    <div id="info">
        <div id="about">
            <a>Chi Siamo:</a>
        </div>
        <div style="clear: both;"></div>
        <img src="images/group.jpg"></img>
        <p>Siamo delle persone che producono suoni considerati piacevoli</p>
        <div style="clear: both;"></div>
    </div>
    <div style="clear: both;"></div>
    <?php
    require_once("dbConnector.php");

    $query = "SELECT * FROM teventi";
    $rec = mysqli_query($dbConcerto, $query) or die($query);
    if (mysqli_num_rows($rec) > 0) {
        $placeOnLeft = false;
        while ($currentRecord = mysqli_fetch_array($rec)) {
            $placeOnLeft = !$placeOnLeft;
            $idEvento = $currentRecord["id"];
            echo "
            <div class=\"evento\" style=\"float:" . ($placeOnLeft ? "left\"" : "right\"") . ">"
                . "<div class=\"eventImage\">"
                . "<img src=\"" . $currentRecord['imgPath'] . "\"></img>"
                . "</div>"
                . "Data: " . $currentRecord['data'] . "<br></br>"
                . "Posti Disponibili: " . $currentRecord['posti'] . "<br></br>"
                . "Prenota: " . "<input type=\"button\" title=\"" . ($currentRecord['posti'] > 0 ? "Prenota ora!" : "Posti esauriti") . "\" onclick=\"location.href='prenota.php?evento=" . $currentRecord['id'] . "'\" value=\"" . $currentRecord['costoBiglietto'] . "\"/>"
                . "<br></br>"
                . "</div>";
            if (!$placeOnLeft) {
                echo "<div style=\"clear: both;\"></div>";
            }
        }
    } else {
        echo "Non sono stati trovati eventi. Prova a ricontrollare più tardi";
    }
    ?>
</body>