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
            <option value=""><?php echo "Rotterdam";?></option>
            <option value=""><?php echo "Almere";?></option>
            <option value=""><?php echo "Eindhoven";?></option>
          </select>
          <select name="address" id="addressSelect">
            <option value=""><?php echo "3401 VR";?></option>
            <option value=""><?php echo "8102 IR";?></option>
            <option value=""><?php echo "2771 TM";?></option>
          </select>
          <select name="product" id="productSelect">
            <option value=""><?php echo "accuboorhamer";?></option>
            <option value=""><?php echo "4-in-1 schuurmachine";?></option>
            <option value=""><?php echo "verstekzaag";?></option>
            <option value=""><?php echo "alleszuiger";?></option>
            <option value=""><?php echo "accuboormachine";?></option>
            <option value=""><?php echo "33-delige borenset";?></option>
            <option value=""><?php echo "Workmate";?></option>
            <option value=""><?php echo "Kruislijnlaserset";?></option>
          </select>
          <div id="submitDiv">
            <input type="submit" name="verzend" value="verzenden" id="verzendSubmit">
            <input type="submit" name="uitlog" value="uitloggen" id="uitlogSubmit">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
