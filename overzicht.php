<?php
    class Dbh {

      public $locatie;
      public $address;
      public $product;
      public $type;
      public $fabriek;
      public $inVoorraad;
      public $verkoopprijs;

      private $servername;
      private $username;
      private $password;
      private $dbname;
      private $charset;

      public function verzend() {
        if(isset($_GET['verzend'])) {
          $GLOBALS['locatieSelected'] = $_GET['locatie'];
          $GLOBALS['addressSelected'] = $_GET['address'];
          $GLOBALS['productSelected'] = $_GET['product'];
          echo $GLOBALS['locatieSelected'];
          echo $GLOBALS['addressSelected'];
          echo $GLOBALS['productSelected'];
        }
      }

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

        // get locatie values
        $GLOBALS['locatie'] = array("");
        foreach ($pdo->query("SELECT naam FROM locatie") as $row) {
          array_push($GLOBALS['locatie'], $row[0]);
        }
        array_shift($GLOBALS['locatie']);

        // get address values
        $GLOBALS['address'] = array("");
        foreach ($pdo->query("SELECT address FROM locatie") as $row) {
          array_push($GLOBALS['address'], $row[0]);
        }
        array_shift($GLOBALS['address']);

        // get product values
        $GLOBALS['product'] = array("");
        foreach ($pdo->query("SELECT product FROM products") as $row) {
          array_push($GLOBALS['product'], $row[0]);
        }
        array_shift($GLOBALS['product']);

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
  $object->verzend();
  $object->connect();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/overzicht.css">
    <title>ToolsForEver voorraad opvragen</title>
  </head>
  <body>
    <div id="yellow_bg">
      <div id="grid">
        <div id="logoDiv"><img src="Tools_For_Ever_Logo.png" alt="ToolsForEver_logo" id="logo"></div>
        <div id="tfeDiv"><span id="tfeText">ToolsForEver Vooraad</span></div>
        <div id="naamDiv"><?php echo "<p>Medewerker: J. Hanssen</p>";?></div>
        <form action="overzicht.php" method="GET">
          <div id="line1"></div>
          <div id="line2"></div>
          <div id="line3"></div>
          <div id="line4"></div>
          <div id="line5"></div>
          <span id="kiesTxt">Kies een locatie en een product</span>
          <select name="locatie" id="locatieSelect">
            <?php
              foreach ($GLOBALS['locatie'] as $val) {
                echo "<option value=\"".$val."\">".$val."</option>";
              }
            ?>
          </select>
          <select name="address" id="addressSelect">
            <?php
              foreach ($GLOBALS['address'] as $val) {
                echo "<option value=\"".$val."\">".$val."</option>";
              }
            ?>
          </select>
          <select name="product" id="productSelect">
            <?php
              foreach ($GLOBALS['product'] as $val) {
                echo "<option value=\"".$val."\">".$val."</option>";
              }
            ?>
          </select>
          <div id="submitDiv">
            <input type="submit" name="verzend" value="verzenden" id="verzendSubmit">
            <input type="submit" name="uitlog" value="uitloggen" id="uitlogSubmit">
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
          <span id="addressTxt">
            Address:
            <?php
              if (empty($GLOBALS['addressSelected'])) {
                echo "---";
              } else {
                echo $GLOBALS['addressSelected'];
              }
            ?>
          </span>
          <div id="table">
            <!-- Col means column -->
            <span id="productCol" class="textStyleBold"><?php echo "Product";?></span>
            <span id="typeCol" class="textStyleBold"><?php echo "Type";?></span>
            <span id="fabriekCol" class="textStyleBold"><?php echo "Fabriek";?></span>
            <span id="inVoorraadCol" class="textStyleBold"><?php echo "In voorraad";?></span>
            <span id="verkoopprijsCol" class="textStyleBold"><?php echo "Verkoopprijs";?></span>
            <!-- Val means Value -->
            <span id="productVal" class="textStyle">
              <?php
                if (empty($GLOBALS['productSelected'])) {
                  echo "---";
                } else {
                  echo $GLOBALS['productSelected'];
                }
              ?>
            </span>
            <span id="typeVal" class="textStyle">
              <?php
              echo "WX 382";
              ?>
            </span>
            <span id="fabriekVal" class="textStyle">
              <?php
              echo "Worx";
              ?>
            </span>
            <span id="inVoorraadVal" class="textStyle">
              <?php
              echo "10";
              ?>
            </span>
            <span id="verkoopprijsVal" class="textStyle">
              <?php
              echo "€ 111,75";
              ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
