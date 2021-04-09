<?php
    class Dbh {

      private $servername;
      private $username;
      private $password;
      private $dbname;
      private $charset;

      public function test() {
        if(isset($_POST['connect'])) {
          echo "string<br>";
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

      private function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toolsforever";

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $passwordUser = "k:nnr'5s!?[PBf!T";
          $hashedPwd = password_hash($passwordUser, PASSWORD_DEFAULT);
          echo password_verify($passwordUser, $hashedPwd);

          // TODO AAAAAAAAAAA
          // TODO WACHTWOORD EN HEADERS OORZAAK!!!
          // header('Location: '.URL.'overzicht.php', TRUE, 302);               <--- goed!!!

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 1;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 2;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 3;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 4;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 5;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 6;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 7;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 8;";
          $conn->exec($sql);

          $sql = "UPDATE medewerkers SET wachtwoord = '$hashedPwd' WHERE idmedewerker = 9;";
          $conn->exec($sql);


        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>test</title>
  </head>
  <body>
    <form method="POST">
      <input type="submit" name="connect" value="connect"/>
    </form>
    <?php
        $object = new Dbh;
        $object->test();
    ?>
  </body>
</html>
