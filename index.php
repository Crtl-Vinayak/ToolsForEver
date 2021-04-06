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
        <div id="tfeDiv"><span id="tfeText">ToolsForEver Vooraad</span></div>
        <!--<div id="medewerkerNaamDiv"><?php echo "<p>Medewerker: J. Hanssen</p>";?></div>-->
        <form action="overzicht.php" method="post">
          <label for="naam" id="naamLabel">naam</label>
          <input type="text" name="naam" value="" id="naamInput" required>
          <label for="wachtwoord" id="wachtwoordLabel">wachtwoord</label>
          <input type="password" name="wwoord" value="" id="wachtwoordInput" required>
          <input type="submit" name="inlog" value="inloggen" id="inlogSubmit">
        </form>
      </div>
    </div>
  </body>
</html>
