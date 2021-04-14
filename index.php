<?php
    class Dbh {

    /**
      This function just checks if you hit the button "inloggen", and if you press the button, then it calls the next function.
      The next function is "connect" function.
    */

      public function inloggen() {
        if(isset($_POST['inloggen'])) {
          $this->connect();
        }
      }

      /**
        This function will connect with the database, in this case, it will connect with the database "toolsforever".
        This php code uses PDO (PHP data objects). For more info about PDO, check this w3school link: https://www.w3schools.com/php/php_mysql_connect.asp
        As you can see in the try catch code inside connect function, it starts with the variables $dsn and $pdo.
        Then there is a foreach code that gives the code inside the information about the "medewerkers".
        $row[1] gives "voornaam", $row[2] gives "tussenvoegsel", $row[3] gives "achternaam",
        $row[4] gives "wachtwoord" and $row[5] gives "rol".

        $row[2] has a chance of an getting an empty string, not fully empty, but just a space in the string.
        This is, because tussenvoegsel can be nothing. Not everyone has a tussenvoegsel.
        All tussenvoegsel that are not set, are just like this: " ".
        If the tussenvoegsel are set, then the else statement will run the code.



// TODO change comment below, to a better structural documented comment.

        If the
        $row[1].' '.$row[2].' '.$row[3] == $_POST['naam
        does not match, or
        $row[1].' '.$row[3] == $_POST['naam']
        , then you won't login to the overzicht page.
        And, if the
        password_verify($_POST['wwoord'], $row[4])
        does not verify, then you won't login to the overzicht page.
        And at last,
        If "naam" and "wachtwoord" does not match with each other, you won't login too.
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
        foreach ($pdo->query("SELECT * FROM medewerkers") as $row) {
          if($row[2] == " ") {
            if($row[1].' '.$row[3] == $_POST['naam'] && password_verify($_POST['wwoord'], $row[4])) {
              session_start();
              $_SESSION["rol"] = $row[5];
              $_SESSION["naam"] = substr($row[1], 0, 1).' '.$row[3];
              $_SESSION["login_time_stamp"] = time();
              header('Location: '.URL.'overzicht.php', TRUE, 302);
            }
          } else {
            if($row[1].' '.$row[2].' '.$row[3] == $_POST['naam'] && password_verify($_POST['wwoord'], $row[4])) {
              session_start();
              $_SESSION["rol"] = $row[5];
              $_SESSION["naam"] = substr($row[1], 0, 1).'. '.$row[2].'. '.$row[3];
              $_SESSION["login_time_stamp"] = time();
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

  /**
    Here is the begin code of this website.
    This php code is the begin php code.
    It will first define the root link of this website.
    http://localhost/toolsforever/ or http://localhost/toolsforever/index.php is the login page.
    It is defined as http://localhost/toolsforever/, because later I can concate this string with other strings,
    like http://localhost/toolsforever/ + overzicht.php or http://localhost/toolsforever/ + admin.php.
    That is why, I don't add the index.php with this link: http://localhost/toolsforever/
  */

  define('URL', 'http://localhost/toolsforever/');

  /**
    I also made an object variable for the class Dbh.
    Dbh means database handle.
    Below the code where I made the new instance, I called the function "inloggen".
  */

  $object = new Dbh;
  $object->inloggen();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>ToolsForEver voorraad opvragen</title>
  </head>
  <body>
    <div id="yellow_bg">
      <div id="grid">
        <div id="logoDiv"><img src="Tools_For_Ever_Logo.png" alt="ToolsForEver_logo" id="logo"></div>
        <div id="tfeDiv"><span id="tfeText">ToolsForEver Voorraad</span></div>
        <form method="POST">
          <label for="naam" id="naamLabel">naam</label>
          <input type="text" name="naam" value="" id="naamInput" required>
          <label for="wachtwoord" id="wachtwoordLabel">wachtwoord</label>
          <input type="password" name="wwoord" value="" id="wachtwoordInput" required>
          <input type="submit" name="inloggen" value="inloggen" id="inlogSubmit">
        </form>
      </div>
    </div>
  </body>
</html>
