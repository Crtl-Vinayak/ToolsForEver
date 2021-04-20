<?php
    class Dbh {

      private $servername = "localhost";
      private $username = "root";
      private $password = "";
      private $dbname = "toolsforever";
      private $charset = "utf8mb4";

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
        if(isset($_GET['verzend'])) {
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
        // try {
        //   $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset".$charset;
        //   $pdo = new PDO($dsn, $username, $password);
        //   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //
        //   // get other values of products
        //   $GLOBALS['productInfo'] = array("");
        //   foreach ($pdo->query("SELECT products.type, products.fabriek, products.voorraad, products.minimumVoorraad, products.verkoopprijs \n
        //     FROM products \n
        //     INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
        //     INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = locatie.idlocatie \n
        //     WHERE locatie.naam = \"".$_GET['locatie']."\" AND locatie.address = \"".$_GET['address']."\" AND products.product = \"".$_GET['product']."\";") as $row) {
        //     array_push($GLOBALS['productInfo'], $row[0]);
        //     array_push($GLOBALS['productInfo'], $row[1]);
        //     array_push($GLOBALS['productInfo'], $row[2]);
        //     array_push($GLOBALS['productInfo'], $row[3]);
        //     array_push($GLOBALS['productInfo'], $row[4]);
        //   }
        //   array_shift($GLOBALS['productInfo']);
        //
        //   $pdo = null;
        // } catch (PDOException $e) {
        //   echo "Connection failed: ".$e->getMessage();
        //   die();
        // }



        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // set "locatie naam" for the forms.
          // $GLOBALS['locatieNaam'] = array("");

          $GLOBALS['totalRows'] = 0;

          $stmt = $conn->prepare("SELECT products.product, products.type, products.fabriek, \n
            locatie_has_products.voorraad, locatie_has_products.minimumVoorraad, locatie_has_products.maximumVoorraad, products.verkoopprijs, \n
            vestiging_locatie.naam \n
            FROM products \n
            INNER JOIN locatie_has_products ON products.idproduct = locatie_has_products.idproduct \n
            INNER JOIN vestiging_locatie ON locatie_has_products.idlocatie = vestiging_locatie.idlocatie \n
            WHERE vestiging_locatie.naam = :naam ORDER BY products.product");

          $stmt->bindParam(':naam', $vestiging_locatie);
          $vestiging_locatie = $_GET['locatie'];

          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            // array_push($GLOBALS['locatieNaam'], $row['naam']);
            $GLOBALS['totalRows']++;
            echo $row['product']."<br>";
            echo $row['type']."<br>";
            echo $row['fabriek']."<br>";
            echo $row['voorraad']."<br>";
            echo $row['minimumVoorraad']."<br>";
            echo $row['maximumVoorraad']."<br>";
            echo ($row['maximumVoorraad'] - $row['voorraad'])."<br>";
            echo $row['verkoopprijs']."<br>";
            echo $row['naam']."<br>";
            echo "<br><br>";
          }
          // array_shift($GLOBALS['locatieNaam']);
          echo $GLOBALS['totalRows'];

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
        $username = "root";
        $password = "";
        $dbname = "toolsforever";
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

<?php
  define('URL', 'http://localhost/toolsforever/');
  $object = new Dbh;
  session_start();

  /**
    if you try to enter overzicht page without login in, you will get send back
    to the login page. As you can see, by using if statement and using the function empty,
    to check if the SESSION variable of "naam" is empty or not. If SESSION "naam" is empty,
    you get back to the login page.
  */

  if (empty($_SESSION['naam'])) {
    header('Location: http://localhost/toolsforever/', TRUE, 302);
  }

  /**
    If the time of now minus the SESSION login_time_stamp is greater than 3600 seconds,
    the session will be unset and destroyed and you get back to the login page.
    The header "refresh 3600" means, that you enter this page overzicht, that the counter will start.
    After the 3600 seconds, the page will refresh and checks the time and login_time_stamp again, to go back to the login page.
  */

  // if (time() - $_SESSION["login_time_stamp"] > 3600) {
  //   session_unset();
  //   session_destroy();
  //   header('Location: '.URL.'index.php', TRUE, 302);
  // }
  // header("refresh: 3600");

  /**
    Below, it calls 4 php functions.
    verzend func.
    connect func.
    uitlog func.
    admin func.
  */

  $object->verzend();
  $object->connect();
  $object->uitlog();
  $object->admin();
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
      <div id="grid">
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

          <!--
            This script is used, so the selected option won't get reset.
            Usually, when you submit a form. The Select option are going to reset to the First
            value of the options.
          -->

          <script type="text/javascript">
            if (<?php if (!empty($_GET['locatie'])) { echo "true"; } ?>) {
              document.getElementById('locatieSelect').value = "<?php
                if(isset($_GET['verzend'])) {
                  echo $GLOBALS['locatieSelected'];
                }
              ?>";
            }
          </script>
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
        </form>
        <div id="overzicht">
          <span id="locatieTxt">
            Locatie:
            <?php
              if (empty($GLOBALS['locatieSelected'])) {
                echo "---";
              } else {
                echo $GLOBALS['locatieSelected'];
              }
            ?>
          </span>
          <div id="table">
            <!-- Col means column -->
            <span id="productCol" class="textStyleBold">Product</span>
            <span id="typeCol" class="textStyleBold">Type</span>
            <span id="fabriekCol" class="textStyleBold">Fabriek</span>
            <span id="inVoorraadCol" class="textStyleBold">In voorraad</span>
            <span id="inMinimumCol" class="textStyleBold">Minimum voorraad</span>
            <span id="inMaximumCol" class="textStyleBold">Maximum voorraad</span>
            <span id="inBestelCol" class="textStyleBold">Aantal te bestellen</span>
            <span id="verkoopprijsCol" class="textStyleBold" style="border-right: 1px solid black;">Verkoopprijs</span>



            <!-- Val means Value -->
            <!-- <span id="productVal" class="textStyle">
              <?php
                // if (empty($GLOBALS['productSelected'])) {
                //   echo "---";
                // } else {
                //   echo $GLOBALS['productSelected'];
                // }
              ?>
            </span>
            <span id="typeVal" class="textStyle">
              <?php
                // if (empty($GLOBALS['productInfo'])) {
                //   echo "---";
                // } else {
                //   echo utf8_encode($GLOBALS['productInfo'][0]);
                // }
              ?>
            </span>
            <span id="fabriekVal" class="textStyle">
              <?php
              // if (empty($GLOBALS['productInfo'])) {
              //   echo "---";
              // } else {
              //   echo utf8_encode($GLOBALS['productInfo'][1]);
              // }
              ?>
            </span>
            <span id="inVoorraadVal" class="textStyle">
              <?php
              // if (empty($GLOBALS['productInfo'])) {
              //   echo "---";
              // } else {
              //   echo $GLOBALS['productInfo'][2];
              // }
              ?>
            </span>
            <span id="inMinimumVal" class="textStyle">
              <?php
              // if (empty($GLOBALS['productInfo'])) {
              //   echo "---";
              // } else {
              //   echo $GLOBALS['productInfo'][3];
              // }
              ?>
            </span>
            <span id="inMaximumVal" class="textStyle">
              <?php
              // if (empty($GLOBALS['productInfo'])) {
              //   echo "---";
              // } else {
              //   echo $GLOBALS['productInfo'][4];
              // }
              ?>
            </span>
            <span id="verkoopprijsVal" class="rightEndTableBorder">
              <?php
              // if (empty($GLOBALS['productInfo'])) {
              //   echo "---";
              // } else {
              //   echo "€".$GLOBALS['productInfo'][5];
              // }
              ?>
            </span> -->


          </div>
        </div>
      </div>
    </div>
  </body>
</html>
