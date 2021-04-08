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
          </div>
          <div id="productDiv"></div>
          <div id="medewerkerDiv"></div>
          <div id="lastDiv_overzichtVenster"></div>
        </div>
      </div>
    </div>
  </body>
</html>
