<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>ToolsForEver voorraad opvragen</title>
  </head>
  <body>
    <div id="yellow_bg">

<!-- top part is where the logo is,
the blue bold text is
and the "Medewerker name is" -->
      <div id="columnOne">
        <div id="logoDiv"><img src="Tools_For_Ever_Logo.png" alt="ToolsForEver_logo" id="logo"></div>
        <div id="tfeDiv"><span id="tfeText">ToolsForEver Vooraad</span></div>
        <div id="medewerkerNaamDiv"><?php echo "<p>Medewerker: J. Hanssen</p>";?></div>
      </div>

<!-- middle part is where the form is,
it shows the text "Kies een locatie en een product"
en de 2 keuze lijst met 2 knoppen. -->
        <div id="columnTwo"></div>

<!-- below part is where the overzicht is van het product
type, fabriek, in voorraad, verkoopprijs, locatie en waarschijnlijk
zijn er nog meer, hier gebruik je de database gegevens... -->
        <div id="columnThree"></div>
    </div>
  </body>
</html>
