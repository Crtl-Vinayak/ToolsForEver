<?php
  define('URL', 'http://localhost/toolsforever/');
  session_start();
  $object = new Dbh;

  if (empty($_SESSION['naam'])) {
    header('Location: '.URL.'index.php', TRUE, 302);
  }

  // $object->verzend();
  // $object->connect();

  $object->uitlog();
  $object->overzicht();
  $object->getData();

  $object->addLocatie();
  $object->changeLocatie();
  $object->removeLocatie1();
  $object->removeLocatie2();

  $object->addProduct();
  $object->changeProduct1();
  $object->changeProduct2();
  $object->changeProduct3();
  $object->removeProduct();

  $object->addMedewerker();
  $object->changeMedewerker1();
  $object->changeMedewerker2();
  $object->changeMedewerker3();
  $object->removeMedewerker();
?>

<?php
class Dbh {

    public function uitlog() {
      if(isset($_GET['uitlog'])) {
        session_unset();
        session_destroy();
        header('Location: '.URL.'index.php', TRUE, 302);
      }
    }

    public function overzicht() {
      if(isset($_GET['overzichtVenster'])) {
        header('Location: '.URL.'overzicht.php', TRUE, 302);
      }
    }

    public function getData() {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "toolsforever";
      $charset = "utf8mb4";

      try {
        $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset".$charset;
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // get name of location
        $GLOBALS['locatieNaam'] = array("");
        foreach ($pdo->query("SELECT naam FROM locatie") as $row) {
          array_push($GLOBALS['locatieNaam'], $row[0]);
        }
        array_shift($GLOBALS['locatieNaam']);

        // get address of location
        $GLOBALS['locatieAddress'] = array("");
        foreach ($pdo->query("SELECT address FROM locatie") as $row) {
          array_push($GLOBALS['locatieAddress'], $row[0]);
        }
        array_shift($GLOBALS['locatieAddress']);

        // get name of product
        $GLOBALS['productName'] = array("");
        foreach ($pdo->query("SELECT product FROM products") as $row) {
          array_push($GLOBALS['productName'], $row[0]);
        }
        array_shift($GLOBALS['productName']);

        // get type of product
        $GLOBALS['productType'] = array("");
        foreach ($pdo->query("SELECT type FROM products") as $row) {
          array_push($GLOBALS['productType'], $row[0]);
        }
        array_shift($GLOBALS['productType']);

        // get fabriek of product
        $GLOBALS['productFabriek'] = array("");
        foreach ($pdo->query("SELECT fabriek FROM products") as $row) {
          array_push($GLOBALS['productFabriek'], $row[0]);
        }
        array_shift($GLOBALS['productFabriek']);

        // get voornaam of medewerker
        $GLOBALS['medewerkerVoornaam'] = array("");
        foreach ($pdo->query("SELECT voornaam FROM medewerkers") as $row) {
          array_push($GLOBALS['medewerkerVoornaam'], $row[0]);
        }
        array_shift($GLOBALS['medewerkerVoornaam']);

        // get tussenvoegsel of medewerker
        $GLOBALS['medewerkerTussenvoegsel'] = array("");
        foreach ($pdo->query("SELECT tussenvoegsel FROM medewerkers") as $row) {
          array_push($GLOBALS['medewerkerTussenvoegsel'], $row[0]);
        }
        array_shift($GLOBALS['medewerkerTussenvoegsel']);

        // get achternaam of medewerker
        $GLOBALS['medewerkerAchternaam'] = array("");
        foreach ($pdo->query("SELECT achternaam FROM medewerkers") as $row) {
          array_push($GLOBALS['medewerkerAchternaam'], $row[0]);
        }
        array_shift($GLOBALS['medewerkerAchternaam']);

        $pdo = null;
      } catch (PDOException $e) {
        echo "Connection failed: ".$e->getMessage();
        die();
      }
    }

    public function addLocatie() {
      if(isset($_GET['addLocatie']) && isset($_GET['addAddress']) && isset($_GET['addPlaceSubmit'])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
        $charset = "utf8mb4";

        $locatie = $_GET['addLocatie'];
        $address = $_GET['addAddress'];

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO locatie (naam, address) VALUES ('$locatie', '$address')";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
        header('Location: '.URL.'admin.php', TRUE, 302);
      }
    }

    public function changeLocatie() {
      // if empty then output 1
      // echo "locatie change = " . empty($_GET['changeLocatie']);
      // echo "address change = " . empty($_GET['changeAddress']);

      if (!empty($_GET['changeLocatie']) && isset($_GET['changePlaceSubmit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
        $charset = "utf8mb4";

        $nieuweLocatie = $_GET['changeLocatie'];
        $selectLocatie = $_GET['changeLocatieSelect'];

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "UPDATE locatie SET naam = '$nieuweLocatie' WHERE naam = '$selectLocatie'";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
        header('Location: '.URL.'admin.php', TRUE, 302);
      }
      if (!empty($_GET['changeAddress']) && isset($_GET['changePlaceSubmit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
        $charset = "utf8mb4";

        $nieuweAddress = $_GET['changeAddress'];
        $selectAddress = $_GET['changeAddressSelect'];

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "UPDATE locatie SET address = '$nieuweAddress' WHERE address = '$selectAddress'";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
        header('Location: '.URL.'admin.php', TRUE, 302);
      }
    }

    public function removeLocatie1() {
      if (isset($_GET['removeLocatiePlaceSubmit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
        $charset = "utf8mb4";

        $removedLocatieNaam = $_GET['removeLocatieSelect'];

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SET SQL_SAFE_UPDATES = 0;";
          $conn->exec($sql);
          $sql = "DELETE FROM locatie WHERE naam = '$removedLocatieNaam'";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
        header('Location: '.URL.'admin.php', TRUE, 302);
      }
    }

    public function removeLocatie2() {
      if (isset($_GET['removeAddressPlaceSubmit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
        $charset = "utf8mb4";

        $removedLocatieAddress = $_GET['removeAddressSelect'];

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SET SQL_SAFE_UPDATES = 0;";
          $conn->exec($sql);
          $sql = "DELETE FROM locatie WHERE address = '$removedLocatieAddress'";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
        header('Location: '.URL.'admin.php', TRUE, 302);
      }
    }

    public function addProduct() {

    }

    public function changeProduct1() {

    }

    public function changeProduct2() {

    }

    public function changeProduct3() {

    }

    public function removeProduct() {

    }

    public function addMedewerker() {

    }

    public function changeMedewerker1() {

    }

    public function changeMedewerker2() {

    }

    public function changeMedewerker3() {

    }

    public function removeMedewerker() {

    }
}
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
              <span id="locatieInfo2">- locatie of address wijzigen (laat je het tekst vakje leeg, dan wijzig je voor dat categorie niet).</span>
              <form method="GET" id="changePlaceForm">
                <select name="changeLocatieSelect" id="changeLocatieSelect">
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeAddressSelect" id="changeAddressSelect">
                  <?php
                    foreach ($GLOBALS['locatieAddress'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
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
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="submit" name="removeLocatiePlaceSubmit" value="Verwijder" id="removeLocatiePlaceSubmit">
              </form>
              <form method="GET" id="removeAddressPlaceForm">
                <select name="removeAddressSelect" id="removeAddressSelect">
                  <?php
                    foreach ($GLOBALS['locatieAddress'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="submit" name="removeAddressPlaceSubmit" value="Verwijder" id="removeAddressPlaceSubmit">
              </form>
            </div>
          </div>
          <div id="productDiv">
            <span id="productInfo">Hier kan je de product informatie wijzigen, toevoegen of verwijderen.</span>
            <div id="productAddDiv">
              <span id="productInfo1">- artiekel, type, fabriek, voorraad, (locatie van artiekel), minimumvoorraad, verkoopprijs toevoegen.</span>
              <form method="GET" id="addProductForm">
                <input type="text" name="addProductsNaam" value="" placeholder="type hier de nieuwe product naam" id="addProductsNaam" required>
                <input type="text" name="addProductsType" value="" placeholder="type hier de type van het product" id="addProductsType" required>
                <input type="text" name="addProductsFabriek" value="" placeholder="type hier van welke fabriek het product komt" id="addProductsFabriek" required>
                <input type="number" name="addProductsVoorraad" value="" min="0" placeholder="type hier het getal van hoeveel van dit product in het voorraad zit" id="addProductsVoorraad" required>
                <input type="text" value="Selecteer hier beneden de nieuwe locatie en address, van waar het voorraad ligt van het product." id="addProductsInfoSelect" readonly>
                <select name="addProductsLocatieSelect" id="addProductsLocatieSelect">
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="addProductsAddressSelect" id="addProductsAddressSelect">
                  <?php
                    foreach ($GLOBALS['locatieAddress'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="number" name="addProductsMinimumVoorraad" value="" min="0" placeholder="type hier het getal van het minimum voorraad van dit product" id="addProductsMinimumVoorraad" required>
                <input type="number" name="addProductsVerkoopprijs" value="" min="0" step=".01" placeholder="type hier wat de nieuwe verkoopprijs is van dit product" id="addProductsVerkoopprijs" required>
                <input type="submit" name="addProductSubmit" value="Toevoegen" id="addProductSubmit">
              </form>
            </div>
            <div id="productChangeDiv">
              <span id="productInfo2">- artiekel, type, fabriek wijzigen.</span>
              <form method="GET" id="changeProductForm1">
                <select name="changeProductsNaamSelect" id="changeProductsNaamSelect">
                  <?php
                    foreach ($GLOBALS['productName'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsTypeSelect" id="changeProductsTypeSelect">
                  <?php
                    foreach ($GLOBALS['productType'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsFabriekSelect" id="changeProductsFabriekSelect">
                  <?php
                    foreach ($GLOBALS['productFabriek'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="text" name="changeProductsNaam" value="" placeholder="type hier de gewijzigde product naam" id="changeProductsNaam">
                <input type="text" name="changeProductsType" value="" placeholder="type hier de gewijzigde product naam" id="changeProductsType">
                <input type="text" name="changeProductsFabriek" value="" placeholder="type hier de gewijzigde product naam" id="changeProductsFabriek">
                <input type="submit" name="changeProductSubmit1" value="Opslaan" id="changeProductSubmit1">
              </form>
              <span id="productInfo3">- artiekel locatie voorraad wijzigen</span>
              <form method="GET" id="changeProductForm2">
                <select name="changeProductsNaamSelect2" id="changeProductsNaamSelect2">
                  <?php
                    foreach ($GLOBALS['productName'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsTypeSelect2" id="changeProductsTypeSelect2">
                  <?php
                    foreach ($GLOBALS['productType'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsFabriekSelect2" id="changeProductsFabriekSelect2">
                  <?php
                    foreach ($GLOBALS['productFabriek'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsLocatieSelect" id="changeProductsLocatieSelect">
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsAddressSelect" id="changeProductsAddressSelect">
                  <?php
                    foreach ($GLOBALS['locatieAddress'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="submit" name="changeProductSubmit2" value="Opslaan" id="changeProductSubmit2">
              </form>
              <span id="productInfo4">- artiekel voorraad, minimumvoorraad en verkoopprijs wijzigen.</span>
              <form method="GET" id="changeProductForm3">
                <select name="changeProductsNaamSelect3" id="changeProductsNaamSelect3">
                  <?php
                    foreach ($GLOBALS['productName'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsTypeSelect3" id="changeProductsTypeSelect3">
                  <?php
                    foreach ($GLOBALS['productType'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsFabriekSelect3" id="changeProductsFabriekSelect3">
                  <?php
                    foreach ($GLOBALS['productFabriek'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="number" name="changeProductsVoorraad" value="" min="0" placeholder="type hier het nieuwe getal van hoeveel van dit product in het voorraad zit" id="changeProductsVoorraad">
                <input type="number" name="changeProductsMinimumVoorraad" value="" min="0" placeholder="type hier het nieuwe getal van het minimum voorraad van dit product" id="changeProductsMinimumVoorraad">
                <input type="number" name="changeProductsVerkoopprijs" value="" min="0" step=".01" placeholder="type hier wat de nieuwe verkoopprijs is van dit product" id="changeProductsVerkoopprijs">
                <input type="submit" name="changeProductSubmit3" value="Opslaan" id="changeProductSubmit3">
              </form>
            </div>
            <div id="productRemoveDiv">
              <span id="productInfo5">- artiekel verwijderen van een bepaalde type en fabriek.</span>
              <form method="GET" id="removeProductForm">
                <select name="removeProductsNaamSelect" id="removeProductsNaamSelect">
                  <?php
                    foreach ($GLOBALS['productName'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="removeProductsTypeSelect" id="removeProductsTypeSelect">
                  <?php
                    foreach ($GLOBALS['productType'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="removeProductsFabriekSelect" id="removeProductsFabriekSelect">
                  <?php
                    foreach ($GLOBALS['productFabriek'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="submit" name="removeProductSubmit" value="Verwijder" id="removeProductSubmit">
              </form>
            </div>
          </div>
          <div id="medewerkerDiv">
            <span id="medewerkerInfo">Hier kan je medewerkers informatie wijzigen, toevoegen of verwijderen.</span>
            <div id="medewerkerAddDiv">
              <span id="medewerkerInfo1">- medewerker naam, wachtwoord en rol toevoegen.</span>
              <form method="POST" id="addMedewerkerForm">
                <input type="text" name="addMedewerkersVoornaam" value="" placeholder="type hier de voornaam van de nieuwe medewerker" required id="addMedewerkersVoornaam">
                <input type="text" name="addMedewerkersTussenvoegsel" value="" placeholder="type hier de tussenvoegsel van de nieuwe medewerker" id="addMedewerkersTussenvoegsel">
                <input type="text" name="addMedewerkersAchternaam" value="" placeholder="type hier de achternaam van de nieuwe medewerker" required id="addMedewerkersAchternaam">
                <input type="password" name="addMedewerkersWachtwoord" value="" placeholder="type hier een wachtwoord van de nieuwe medewerker" required id="addMedewerkersWachtwoord">
                <select name="addMedewerkersRolSelect" id="addMedewerkersRolSelect">
                  <option value="0">Medewerker</option>
                  <option value="1">Manager</option>
                </select>
                <input type="submit" name="addMedewerkerSubmit" value="Toevoegen" id="addMedewerkerSubmit">
              </form>
            </div>
            <div id="medewerkerChangeDiv1">
              <span id="medewerkerInfo2">- medewerker naam wijzigen.</span>
              <form method="POST" id="changeMedewerkerForm1">
                <select name="changeMedewerkerVoornaamSelect" id="changeMedewerkerVoornaamSelect">
                  <?php
                    foreach ($GLOBALS['medewerkerVoornaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerTussenvoegselSelect" id="changeMedewerkerTussenvoegselSelect">
                  <?php
                    foreach ($GLOBALS['medewerkerTussenvoegsel'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerAchternaamSelect" id="changeMedewerkerAchternaamSelect">
                  <?php
                    foreach ($GLOBALS['medewerkerAchternaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="text" name="changeMedewerkersVoornaam" value="" placeholder="type hier de nieuwe gewijzigde voornaam" id="changeMedewerkersVoornaam">
                <input type="text" name="changeMedewerkersTussenvoegsel" value="" placeholder="type hier de nieuwe gewijzigde tussenvoegsel" id="changeMedewerkersTussenvoegsel">
                <input type="text" name="changeMedewerkersAchternaam" value="" placeholder="type hier de nieuwe gewijzigde achternaam" id="changeMedewerkersAchternaam">
                <input type="submit" name="changeMedewerkerSubmit1" value="Opslaan" id="changeMedewerkerSubmit1">
              </form>
            </div>
            <div id="medewerkerChangeDiv2">
              <span id="medewerkerInfo3">- medewerker rol wijzigen.</span>
              <form method="POST" id="changeMedewerkerForm2">
                <input type="text" readonly name="readVoornaam1" value="" placeholder="Voornaam:" id="readVoornaam1">
                <input type="text" readonly name="readTussenvoegsel1" value="" placeholder="Tussenvoegsel:" id="readTussenvoegsel1">
                <input type="text" readonly name="readAchternaam1" value="" placeholder="Achternaam:" id="readAchternaam1">
                <input type="text" readonly name="readRol" value="" placeholder="Rol:" id="readRol">
                <select name="changeMedewerkerVoornaamSelect2" id="changeMedewerkerVoornaamSelect2">
                  <?php
                    foreach ($GLOBALS['medewerkerVoornaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerTussenvoegselSelect2" id="changeMedewerkerTussenvoegselSelect2">
                  <?php
                    foreach ($GLOBALS['medewerkerTussenvoegsel'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerAchternaamSelect2" id="changeMedewerkerAchternaamSelect2">
                  <?php
                    foreach ($GLOBALS['medewerkerAchternaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerRolSelect" id="changeMedewerkerRolSelect">
                  <option value="0">Medewerker</option>
                  <option value="1">Manager</option>
                </select>
                <input type="submit" name="changeMedewerkerSubmit2" value="Opslaan" id="changeMedewerkerSubmit2">
              </form>
            </div>
            <div id="medewerkerChangeDiv3">
              <span id="medewerkerInfo4">- medewerker wachtwoord wijzigen.</span>
              <form method="POST" id="changeMedewerkerForm3">
                <input type="text" readonly name="readVoornaam2" value="" placeholder="Voornaam:" id="readVoornaam2">
                <input type="text" readonly name="readTussenvoegsel2" value="" placeholder="Tussenvoegsel:" id="readTussenvoegsel2">
                <input type="text" readonly name="readAchternaam2" value="" placeholder="Achternaam:" id="readAchternaam2">
                <select name="changeMedewerkerVoornaamSelect3" id="changeMedewerkerVoornaamSelect3">
                  <?php
                    foreach ($GLOBALS['medewerkerVoornaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerTussenvoegselSelect3" id="changeMedewerkerTussenvoegselSelect3">
                  <?php
                    foreach ($GLOBALS['medewerkerTussenvoegsel'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeMedewerkerAchternaamSelect3" id="changeMedewerkerAchternaamSelect3">
                  <?php
                    foreach ($GLOBALS['medewerkerAchternaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="password" name="changePassW" value="" placeholder="type hier een nieuwe gewijzigde sterke wachtwoord voor deze medewerker" id="changePassword">
                <input type="submit" name="changeMedewerkerSubmit3" value="Opslaan" id="changeMedewerkerSubmit3">
              </form>
            </div>
            <div id="medewerkerRemoveDiv">
              <span id="medewerkerInfo5">- medewerker verwijderen.</span>
              <form method="POST" id="removeMedewerkerForm">
                <input type="text" readonly name="readVoornaam3" value="" placeholder="Voornaam:" id="readVoornaam3">
                <input type="text" readonly name="readTussenvoegsel3" value="" placeholder="Tussenvoegsel:" id="readTussenvoegsel3">
                <input type="text" readonly name="readAchternaam3" value="" placeholder="Achternaam:" id="readAchternaam3">
                <select name="removeMedewerkerVoornaamSelect" id="removeMedewerkerVoornaamSelect">
                  <?php
                    foreach ($GLOBALS['medewerkerVoornaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="removeMedewerkerTussenvoegselSelect" id="removeMedewerkerTussenvoegselSelect">
                  <?php
                    foreach ($GLOBALS['medewerkerTussenvoegsel'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="removeMedewerkerAchternaamSelect" id="removeMedewerkerAchternaamSelect">
                  <?php
                    foreach ($GLOBALS['medewerkerAchternaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="submit" name="removeMedewerkerSubmit" value="Verwijder" id="removeMedewerkerSubmit">
              </form>
            </div>
          </div>
          <div id="lastDiv_overzichtVenster">
            <form method="GET" id="overzichtForm">
              <input type="submit" name="overzichtVenster" value="Naar overzicht venster gaan" id="overzichtVenster">
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>