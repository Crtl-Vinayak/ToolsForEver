<?php
  define('URL', 'http://toolsforever.freevar.com/');
  $object = new Dbh;
  session_start();

  /**
    if you try to enter overzicht page without login in, you will get send back
    to the login page. As you can see, by using if statement and using the function empty,
    to check if the SESSION variable of "naam" is empty or not. If SESSION "naam" is empty,
    you get back to the login page.
  */

  if (empty($_SESSION['naam'])) {
    header('Location: http://toolsforever.freevar.com/', TRUE, 302);
  }

  /**
    If the time of now minus the SESSION login_time_stamp is greater than 3600 seconds,
    the session will be unset and destroyed and you get back to the login page.
    The header "refresh 3600" means, that you enter this page overzicht, that the counter will start.
    After the 3600 seconds, the page will refresh and checks the time and login_time_stamp again, to go back to the login page.
  */

  if (time() - $_SESSION["login_time_stamp"] > 3600) {
    session_unset();
    session_destroy();
    header('Location: '.URL.'index.php', TRUE, 302);
  }
  header("refresh: 3600");

  /**
    Below, it calls 4 php functions.
    verzend func.
    connect func.
    uitlog func.
    admin func.
  */

  $GLOBALS['totalRows'] = 0;
  $GLOBALS['rowsRemainder'] = 0;
  $object->verzend();
  $object->connect();
  $object->uitlog();
  $object->admin();
?>

<?php
    class Dbh {

      private $servername = "localhost";
      private $username = "263918";
      private $password = "ASDF9871QWERTYUI";
      private $dbname = "263918";
      private $charset = "utf8";

      /**
        uitlog function.
        When you press on the uitlog button, you will meet up with the condition
        inside the uitlog function.
        The SESSIONS will get unset and destroyed and you will go back to the login page.
      */

      public function uitlog() {
        if(isset($_GET['uitlog'])) {
          session_unset();
          session_destroy();
          header('Location: '.URL.'index.php', TRUE, 302);
        }
      }

      /**
        admin function.
        If you press the button "Naar admin venster", then you go to the admin venster.
        If you are a "medewerker" and not an "admin", then this function still calls the function admin,
        but it won't meet up with the condition inside the admin function,
        because the user that is "medewerker", does not have the button "Naar admin venster".
        Thus it won't go to the admin page.
      */

      public function admin() {
        if(isset($_GET['admin'])) {
          header('Location: '.URL.'admin.php', TRUE, 302);
        }
      }

      /**
        verzend function.
        If the user press the button "verzenden", then the selected options becomes GLOBAL variables.
        These GLOBAL variables is used for the html code, to print out the "locatie", "adres" and "product".
        "locatie" and "adres" are printed above the table.
        "product" is printed in the table under the column Product.

        These 3 values are also "saved" when you press on the "verzenden" button.
        The usage of script, inside the html code of this overzicht.php file,
        it can change the selected value for you.
        This is because it makes it easier for the user to select what he/she had selected in the form.

        If the user press the button "verzenden", it also calls the next function.
        function "getTableData".
      */

      public function verzend() {
        if(isset($_GET['verzend']) || isset($_GET['prev']) || isset($_GET['next'])) {
          $GLOBALS['locatieSelected'] = $_GET['locatie'];
          $this->getTableData();
        }
      }

      /**
        getTableData function.
        This has a basic pdo setup code.
        The query selects the "type", "fabriek", "voorraad", "minimumVoorraad" and "verkoopprijs".
        $row[0] = type. $row[1] = fabriek. $row[2] = voorraad. $row[3] = minimumVoorraad. $row[4] = verkoopprijs.
        array_push function is just that the element will be added in an array.
        array_shift function is just that the first element gets removed.
      */

      public function getTableData() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $GLOBALS['product'] = array("");
          $GLOBALS['type'] = array("");
          $GLOBALS['fabriek'] = array("");
          $GLOBALS['voorraad'] = array("");
          $GLOBALS['minimumVoorraad'] = array("");
          $GLOBALS['maximumVoorraad'] = array("");
          $GLOBALS['aantalTeBestellen'] = array("");
          $GLOBALS['verkoopprijs'] = array("");
          $GLOBALS['naam'] = array("");

          if (isset($_GET['prev'])) {
            if ($_SESSION['tabelNum'] != 1) {
              $_SESSION['tabelNum']--;

              $stmt = $conn->prepare("SELECT products.product, products.type, products.fabriek, \n
                locatie_has_products.voorraad, locatie_has_products.minimumVoorraad, locatie_has_products.maximumVoorraad, products.verkoopprijs, \n
                vestiging_locatie.naam \n
                FROM products \n
                INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
                INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = vestiging_locatie.idlocatie \n
                WHERE vestiging_locatie.naam = :naam AND locatie_has_products.voorraad < locatie_has_products.maximumVoorraad ORDER BY products.product LIMIT 100 OFFSET :off");

                $stmt->bindParam(':naam', $vestiging_locatie);
                $stmt->bindParam(':off', $off, PDO::PARAM_INT);
                $vestiging_locatie = $_GET['locatie'];
                $off = ($_SESSION['tabelNum'] - 1) * 100;
            } else {
              $_SESSION['tabelNum'] = 1;

              $stmt = $conn->prepare("SELECT products.product, products.type, products.fabriek, \n
                locatie_has_products.voorraad, locatie_has_products.minimumVoorraad, locatie_has_products.maximumVoorraad, products.verkoopprijs, \n
                vestiging_locatie.naam \n
                FROM products \n
                INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
                INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = vestiging_locatie.idlocatie \n
                WHERE vestiging_locatie.naam = :naam AND locatie_has_products.voorraad < locatie_has_products.maximumVoorraad ORDER BY products.product LIMIT 100");

                $stmt->bindParam(':naam', $vestiging_locatie);
                $vestiging_locatie = $_GET['locatie'];
            }
          }

          if (isset($_GET['next'])) {
            $_SESSION['tabelNum']++;

            $stmt = $conn->prepare("SELECT products.product, products.type, products.fabriek, \n
              locatie_has_products.voorraad, locatie_has_products.minimumVoorraad, locatie_has_products.maximumVoorraad, products.verkoopprijs, \n
              vestiging_locatie.naam \n
              FROM products \n
              INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
              INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = vestiging_locatie.idlocatie \n
              WHERE vestiging_locatie.naam = :naam AND locatie_has_products.voorraad < locatie_has_products.maximumVoorraad ORDER BY products.product LIMIT 100 OFFSET :off");

              $stmt->bindParam(':naam', $vestiging_locatie);
              $stmt->bindParam(':off', $off, PDO::PARAM_INT);
              $vestiging_locatie = $_GET['locatie'];
              $off = ($_SESSION['tabelNum'] - 1) * 100;
          }

          if (isset($_GET['verzend'])) {
            $_SESSION['tabelNum'] = 1;

            $stmt = $conn->prepare("SELECT products.product, products.type, products.fabriek, \n
              locatie_has_products.voorraad, locatie_has_products.minimumVoorraad, locatie_has_products.maximumVoorraad, products.verkoopprijs, \n
              vestiging_locatie.naam \n
              FROM products \n
              INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
              INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = vestiging_locatie.idlocatie \n
              WHERE vestiging_locatie.naam = :naam AND locatie_has_products.voorraad < locatie_has_products.maximumVoorraad ORDER BY products.product LIMIT 100");

              $stmt->bindParam(':naam', $vestiging_locatie);
              $vestiging_locatie = $_GET['locatie'];
          }

          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            $GLOBALS['totalRows']++;
            array_push($GLOBALS['product'], $row['product']);
            array_push($GLOBALS['type'], $row['type']);
            array_push($GLOBALS['fabriek'], $row['fabriek']);
            array_push($GLOBALS['voorraad'], $row['voorraad']);
            array_push($GLOBALS['minimumVoorraad'], $row['minimumVoorraad']);
            array_push($GLOBALS['maximumVoorraad'], $row['maximumVoorraad']);
            array_push($GLOBALS['aantalTeBestellen'], ($row['maximumVoorraad'] - $row['voorraad']));
            array_push($GLOBALS['verkoopprijs'], $row['verkoopprijs']);
          }
          array_shift($GLOBALS['product']);
          array_shift($GLOBALS['type']);
          array_shift($GLOBALS['fabriek']);
          array_shift($GLOBALS['voorraad']);
          array_shift($GLOBALS['minimumVoorraad']);
          array_shift($GLOBALS['maximumVoorraad']);
          array_shift($GLOBALS['aantalTeBestellen']);
          array_shift($GLOBALS['verkoopprijs']);

          // check how many rows all tables can have in total without its limit.
          $stmt = $conn->prepare("SELECT products.product, products.type, products.fabriek, \n
            locatie_has_products.voorraad, locatie_has_products.minimumVoorraad, locatie_has_products.maximumVoorraad, products.verkoopprijs, \n
            vestiging_locatie.naam \n
            FROM products \n
            INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
            INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = vestiging_locatie.idlocatie \n
            WHERE vestiging_locatie.naam = :naam AND locatie_has_products.voorraad < locatie_has_products.maximumVoorraad ORDER BY products.product");

            $stmt->bindParam(':naam', $vestiging_locatie);
            $vestiging_locatie = $_GET['locatie'];
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $key => $row) {
              $GLOBALS['rowsRemainder']++;
            }

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
      }

      /**
        connect function.
        "locatie", "adres" and "product" GLOBAL variables are used for
        to print these values inside the (select, option) form.

        Note: DISTINCT is added in locatie query and also in product query.
        This is because, the same locatie can have more adresses and
        the same product can have more types of it. Adres is just unique.
      */

      public function connect() {
        $servername = "localhost";
        $username = "263918";
        $password = "ASDF9871QWERTYUI";
        $dbname = "263918";
        $charset = "utf8";

        try {
          $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset".$charset;
          $pdo = new PDO($dsn, $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // get product values
          $GLOBALS['locatie'] = array("");
          foreach ($pdo->query("SELECT DISTINCT naam FROM vestiging_locatie") as $row) {
            array_push($GLOBALS['locatie'], $row[0]);
          }
          array_shift($GLOBALS['locatie']);

          $pdo = null;
        } catch (PDOException $e) {
          echo "Connection failed: ".$e->getMessage();
          die();
        }
      }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="style/overzicht.css">
    <title>ToolsForEver voorraad opvragen</title>
  </head>
  <body>
    <div id="yellow_bg">
        <div
        <?php
          if (isset($GLOBALS['totalRows']) && $GLOBALS['totalRows'] > 0) {
            echo "style=\"display:grid; grid-template-columns: 10px 4fr 9fr 4fr 10px; grid-template-rows: 10px 100px 30px auto 50px;\"";
          } else {
            echo "style=\"display:grid; grid-template-columns: 10px 4fr 9fr 4fr 10px; grid-template-rows: 10px 100px 30px auto 50px;\"";
          }
        ?>
        >
        <div id="logoDiv"><img src="Tools_For_Ever_Logo.png" alt="ToolsForEver_logo" id="logo"></div>
        <div id="tfeDiv"><span id="tfeText">ToolsForEver Voorraad</span></div>
        <div id="naamDiv"><?php

        $rol;
        if ($_SESSION['rol'] == 1) {
          $rol = "Manager";
        } else {
          $rol = "Medewerker";
        }

        echo "<p style=\"font-size: 25px;\">".$rol.". ".$_SESSION['naam']."</p>";

          ?></div>
        <form action="overzicht.php" method="GET">
          <div id="line1"></div>
          <div id="line2"></div>
          <div id="line3"></div>
          <div id="line4"></div>
          <div id="line5"></div>
          <span id="kiesTxt">Kies een vestiging locatie</span>
          <select name="locatie" id="locatieSelect">
            <?php
              foreach ($GLOBALS['locatie'] as $val) {
                echo "<option value=\"".$val."\">".$val."</option>";
              }
            ?>
          </select>
          <div id="submitDiv">
            <?php

            /**
              if rol equals 1, that means that you are a manager.
              Managers get an extra button for "Naar admin venster".
              And if rol equals to 0, that means you are a medewerker.
              Medewerkers do not get an extra button for "Naar admin venster".
            */

              if($_SESSION['rol'] == 1) {
                echo "<input type=\"submit\" name=\"verzend\" value=\"verzenden\" id=\"verzendSubmita\" style=\"font-size: 25px; grid-column-start: 2; grid-column-end: 4; grid-row-start: 1; grid-row-end: 2;\">";
                echo "<input type=\"submit\" name=\"admin\" value=\"Naar admin venster\" id=\"adminSubmit\" style=\"font-size: 25px; grid-column-start: 5; grid-column-end: 8; grid-row-start: 1; grid-row-end: 2;\">";
                echo "<input type=\"submit\" name=\"uitlog\" value=\"uitloggen\" id=\"uitlogSubmita\" style=\"font-size: 25px; grid-column-start: 9; grid-column-end: 11; grid-row-start: 1; grid-row-end: 2;\">";
              } else {
                echo "<input type=\"submit\" name=\"verzend\" value=\"verzenden\" id=\"verzendSubmitb\" style=\"font-size: 25px; grid-column-start: 3; grid-column-end: 6; grid-row-start: 1; grid-row-end: 2;\">";
                echo "<input type=\"submit\" name=\"uitlog\" value=\"uitloggen\" id=\"uitlogSubmitb\" style=\"font-size: 25px; grid-column-start: 7; grid-column-end: 10; grid-row-start: 1; grid-row-end: 2;\">";
              }
            ?>
        </div>
        <span id="locatieTxt">
          Vestigingslocatie:
          <?php
            if (empty($GLOBALS['locatieSelected'])) {
              echo "---";
            } else {
              echo $GLOBALS['locatieSelected'];
            }
          ?>
        </span>
        <div id="overzicht">
          <div id="table"
          <?php
            if (isset($GLOBALS['totalRows'])) {
              echo "style=\"display:grid; grid-template-columns: repeat(8, 1fr); grid-template-rows: 80px repeat(".$GLOBALS['totalRows'].", auto);\"";
            } else {
              echo "style=\"display:grid; grid-template-columns: repeat(8, 1fr); grid-template-rows: 80px;\"";
            }
          ?>>
            <!-- Col means column -->
            <span id="productCol" class="textStyleBold">Product</span>
            <span id="typeCol" class="textStyleBold">Type</span>
            <span id="fabriekCol" class="textStyleBold">Fabriek</span>
            <span id="inVoorraadCol" class="textStyleBold">In voorraad</span>
            <span id="inMinimumCol" class="textStyleBold">Minimum voorraad</span>
            <span id="inMaximumCol" class="textStyleBold">Maximum voorraad</span>
            <span id="inBestelCol" class="textStyleBold">Aantal te bestellen</span>
            <span id="verkoopprijsCol" class="textStyleBold" style="border-right: 1px solid black;">Verkoopprijs</span>

            <?php
              if (isset($_GET['verzend']) || isset($_GET['prev']) || isset($_GET['next'])) {
                for ($i = 0; $i < $GLOBALS['totalRows']; $i++) {
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black; padding: 10px; min-height: 70px;\">". $GLOBALS['product'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black;\">". $GLOBALS['type'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black;\">". $GLOBALS['fabriek'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black;\">". $GLOBALS['voorraad'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black;\">". $GLOBALS['minimumVoorraad'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black;\">". $GLOBALS['maximumVoorraad'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black;\">". $GLOBALS['aantalTeBestellen'][$i] ."</span>";
                  echo "<span class=\"textStyle\" style=\"grid-row-start: ".($i + 2)."; grid-row-end: ".($i + 3)."; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;\">&euro;". number_format((float) $GLOBALS['verkoopprijs'][$i], 2, '.', '') ."</span>";
                }
              }
            ?>
          </div>
        </div>
        <!-- newTableContainer is a container, that contains 2 submit buttons, but if you clicked on "verzend" and there is less than 100 product results on the table, then there is no button for "next".
            If the table results have 100 products on it and if the results of the server side says there is more than 100 products to show the next table, then you can click on "next".
            If you clicked on "next", than you can also go back. -->
        <div id="newTableContainer">
          <?php
            if (isset($_GET['verzend']) || isset($_GET['prev']) || isset($_GET['next'])) {
              if ($_SESSION['tabelNum'] != 1) {
                echo "<input id=\"prev\" type=\"submit\" value=\"vorige tabel\" name=\"prev\">";
              }
              if ($GLOBALS['totalRows'] == 100 && ($GLOBALS['rowsRemainder'] - (($_SESSION['tabelNum']) * 100) > 0)) {
                echo "<input id=\"next\" type=\"submit\" value=\"volgende tabel\" name=\"next\">";
              }
            }
          ?>
        </div>
        </form>
      </div>
    </div>
  </body>
</html>
