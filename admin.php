<?php
    class Dbh {

      private $servername;
      private $username;
      private $password;
      private $dbname;
      private $charset;

      public function inloggen() {
        if(isset($_POST['inloggen'])) {
          $this->connect();
        }
      }

      // p1 = 7\52AMZ83{,s_{XZ
      // p2 = tY\cjLE^s=D7w{%)
      // p3 = JXd}}H)e+7Za6q^q
      // p4 = RQ/w`zG{yk%5[yv%
      // p5 = hJm-'GPn=3DLC_HF
      // p6 = gT88]e.)XCmdTv!'
      // p7 = swC%M,zv8Z,(/;!6
      // p8 = 3>hL]S/{f%EXmkRw
      // p9 = k:nnr'5s!?[PBf!T

      public function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
        $charset = "utf8";

      try {
        $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset".$charset;
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach ($pdo->query("SELECT * FROM medewerkers") as $row) {
          if($row[2] == "") {
            if($row[1].' '.$row[3] == $_POST['naam'] && password_verify($_POST['wwoord'], $row[4])) {
              session_start();
              $_SESSION["rol"] = $row[5];
              $_SESSION["naam"] = substr($row[1], 0, 1).' '.$row[3];
              header('Location: '.URL.'overzicht.php', TRUE, 302);
            }
          } else {
            if($row[1].' '.$row[2].' '.$row[3] == $_POST['naam'] && password_verify($_POST['wwoord'], $row[4])) {
              session_start();
              $_SESSION["rol"] = $row[5];
              $_SESSION["naam"] = substr($row[1], 0, 1).'. '.$row[2].'. '.$row[3];
              header('Location: '.URL.'overzicht.php', TRUE, 302);
            }
          }
        }
        $pdo = null;
      } catch (PDOException $e) {
        echo "Connection failed: ".$e->getMessage();
        die();
      }
    }
  }
?>

<?php
  define('URL', 'http://localhost/toolsforever/');
  session_start();
  $object = new Dbh;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/admin.css">
    <title>ToolsForEver administatie venster</title>
  </head>
  <body>
    <div id="yellow_bg">
      <div id="grid">
        <div id="logoDiv"><img src="Tools_For_Ever_Logo.png" alt="ToolsForEver_logo" id="logo"></div>
        <div id="tfeDiv"><span id="tfeText">ToolsForEver</span></div>
        <div id="naam_formDiv">
          <p>Manager. <?php echo $_SESSION['naam']; ?></p>
          <form method="GET">
            <input type="submit" name="uitlog" value="uitloggen" id="uitlogSubmit">
          </form>
        </div>
        <div id="bigFormDiv">
          <div id="line1"></div>
          <div id="line2"></div>
          <div id="line3"></div>
          <div id="line4"></div>
          <div id="locatieDiv">
            <span id="locatieInfo">Hier kan je de locatie EN ADDRESS wijzigen, toevoegen of verwijderen.</span>
            <div id="locatieAddDiv">
              <span id="locatieInfo1">- locatie en address toevoegen</span>
              <form method="GET" id="addPlaceForm">
                <input type="text" name="addLocatie" value="" placeholder="type hier de nieuwe locatie" required id="addPlaceLocatieInput">
                <input type="text" name="addAddress" value="" placeholder="type hier de nieuwe address" required id="addPlaceAddressInput">
                <input type="submit" name="addPlaceSubmit" value="Toevoegen" id="addPlaceSubmit">
              </form>
            </div>
            <div id="locatieChangeDiv">
              <!-- selects option needs to variable (backend) -->
              <span id="locatieInfo2">- locatie of address wijzigen (laat je het tekst vakje leeg, dan wijzig je voor dat categorie niet.)</span>
              <form method="GET" id="changePlaceForm">
                <select name="changeLocatieSelect" id="changeLocatieSelect">
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                </select>
                <select name="changeAddressSelect" id="changeAddressSelect">
                  <option value="1234AB">1234AB</option>
                  <option value="1234AB">1234AB</option>
                  <option value="1234AB">1234AB</option>
                </select>
                <input type="text" name="changeLocatie" value="" placeholder="type hier de nieuwe gewijzigde locatie" id="changePlaceLocatieInput">
                <input type="text" name="changeAddress" value="" placeholder="type hier de nieuwe gewijzigde address" id="changePlaceAddressInput">
                <input type="submit" name="changePlaceSubmit" value="Wijziging opslaan" id="changePlaceSubmit">
              </form>
            </div>
            <div id="locatieRemoveDiv">
              <span id="locatieInfo3">- locatie of address verwijderen</span>
              <form method="GET" id="removeLocatiePlaceForm">
                <select name="removeLocatieSelect" id="removeLocatieSelect">
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                </select>
                <input type="submit" name="removeLocatiePlaceSubmit" value="Verwijder" id="removeLocatiePlaceSubmit">
              </form>
              <form method="GET" id="removeAddressPlaceForm">
                <select name="removeAddressSelect" id="removeAddressSelect">
                  <option value="1234AB">1234AB</option>
                  <option value="1234AB">1234AB</option>
                  <option value="1234AB">1234AB</option>
                </select>
                <input type="submit" name="removeAddressPlaceSubmit" value="Verwijder" id="removeAddressPlaceSubmit">
              </form>
            </div>
          </div>
          <div id="productDiv">
            <span id="productInfo">Hier kan je de product informatie wijzigen, toevoegen of verwijderen.</span>
            <div id="productAddDiv">
              <span id="productInfo1">- artiekel, type, fabriek, voorraad, (locatie van artiekel), minimumvoorraad, verkoopprijs toevoegen</span>
              <form method="GET" id="addProductForm">
                <input type="text" name="addProductsNaam" value="" placeholder="type hier de nieuwe product naam" id="addProductsNaam" required>
                <input type="text" name="addProductsType" value="" placeholder="type hier de type van het product" id="addProductsType" required>
                <input type="text" name="addProductsFabriek" value="" placeholder="type hier van welke fabriek het product komt" id="addProductsFabriek" required>
                <input type="number" name="addProductsVoorraad" value="" min="0" placeholder="type hier het getal van hoeveel van dit product in het voorraad zit" id="addProductsVoorraad" required>
                <input type="text" value="Selecteer hier beneden de nieuwe locatie en address, van waar het voorraad ligt van het product." id="addProductsInfoSelect" readonly>
                <select name="addProductsLocatieSelect" id="addProductsLocatieSelect">
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                </select>
                <select name="addProductsAddressSelect" id="addProductsAddressSelect">
                  <option value="1234AB">1234AB</option>
                  <option value="1234AB">1234AB</option>
                  <option value="1234AB">1234AB</option>
                </select>
                <input type="number" name="addProductsMinimumVoorraad" value="" min="0" placeholder="type hier het getal van het minimum voorraad van dit product" id="addProductsMinimumVoorraad" required>
                <input type="number" name="addProductsVerkoopprijs" value="" min="0" step=".01" placeholder="type hier wat de nieuwe verkoopprijs is van dit product" id="addProductsVerkoopprijs" required>
                <input type="submit" name="addProductSubmit" value="Toevoegen" id="addProductSubmit">
              </form>
            </div>
            <div id="productChangeDiv"></div>
            <div id="productRemoveDiv"></div>
          </div>
          <div id="medewerkerDiv"></div>
          <div id="lastDiv_overzichtVenster"></div>
        </div>
      </div>
    </div>
  </body>
</html>
