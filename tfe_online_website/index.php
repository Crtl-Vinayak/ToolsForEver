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

        This -> ($row[1].' '.$row[2].' '.$row[3] == $_POST['naam']), means, Voornaam + Tussenvoegsel + Achternaam equals to the full name that the user filled in the ("input text //naam") form.
        This -> ($row[1].' '.$row[3] == $_POST['naam']), means, Voornaam + Achternaam equals to the full name that the user filled in the ("input text //naam") form.
        This -> (password_verify($_POST['wwoord'], $row[4])), means Password equals to the password that the user filled in the ("input password //password") form.

        Also note: $row[4], also known as password value(s), the passwords are hashed.

        If you met with the conditions, then you will login.
        First thing what will happen is, a session will start.
        This makes it so, that these variables will be accessed to other php files and classes.
        session rol is made, it gives a value of 0 or 1, 0 = medewerker and 1 = manager.
        session naam is your full name, but first name (voornaam) is just your first character of your first name.
        session login_time_stamp is setting the time for now. It will be used for users inactivity. If you stay too long on the website, you will be logged out.
        header('Location: '.URL.'overzicht.php', TRUE, 302); is just, that you will be send to the overzicht.php page.

        If your sql does not work, you will get an PDOException message.
        Like: Connection failed: .... PDOException message .....
        die() is just quits php script. see more info at: https://www.w3schools.com/php/func_misc_die.asp

        Also note: $row[0] is not needed in this code, because I do not use the idMedewerker column.
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
              $_SESSION["naam"] = substr($row[1], 0, 1).'. '.$row[2].' '.$row[3];
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

  define('URL', 'http://toolsforever.freevar.com/');

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
        <div id="tfeDiv"><span id="title">ToolsForEver Voorraad</span></div>

        <!--
          When you fill the form in, you won't get immediatly go to the overzicht page, but it
          call the function inloggen in the php code in this php index file.
        -->

        <form method="POST">
          <label for="naam" id="naamLabel">naam</label>
          <input type="text" name="naam" value="" id="naam" required autofocus>
          <label for="wachtwoord" id="wachtwoordLabel">wachtwoord</label>
          <input type="password" name="wwoord" value="" id="wachtwoord" required>
          <input type="submit" name="inloggen" value="inloggen" id="inlogSubmit">
        </form>
      </div>
    </div>
  </body>
</html>
