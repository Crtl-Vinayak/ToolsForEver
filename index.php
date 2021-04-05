<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>ToolsForEver voorraad opvragen</title>
  </head>
  <body>
    <div id="yellow_bg">

    <!-- top part is where the logo is,
    the blue bold text is
    and the "Medewerker name is" -->

    <!-- middle part is where the form is,
    it shows the text "Kies een locatie en een product"
    en de 2 keuze lijst met 2 knoppen. -->

    <!-- below part is where the overzicht is van het product
    type, fabriek, in voorraad, verkoopprijs, locatie en waarschijnlijk
    zijn er nog meer, hier gebruik je de database gegevens... -->

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
