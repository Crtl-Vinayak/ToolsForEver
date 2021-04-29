<?php

  /**
    Same code as overzicht.php
    define the URL, start session, make object variable and initialize it.
    Check if you logged in normally.
    Check if you are in the website in a hour, if not, then go back to login page.
  */

  define('URL', 'http://localhost/toolsforever/');
  session_start();
  $object = new Dbh;

  // if you did not login into this website, you will get back to the login screen!
  if (empty($_SESSION['naam'])) {
    header('Location: '.URL.'index.php', TRUE, 302);
  }

  // if (time() - $_SESSION["login_time_stamp"] > 3600) {
  //   session_unset();
  //   session_destroy();
  //   header('Location: '.URL.'index.php', TRUE, 302);
  // }
  // header("refresh: 3600");

  /**
    Call 3 functions.
    - uitlog function.
    - overzicht function.
    - setFormSelectOptionData function.
  */

  $object->uitlog();
  $object->overzicht();
  $object->setFormSelectOptionData();

  /**
    This big IF STATEMENT is for checking if you filled in some data and checks if you pressed some buttons.
  */

  if (isset($_GET['addLocatie']) && isset($_GET['addPlaceSubmit'])) {
    $object->addLocatie();
  } else if (isset($_GET['changeLocatieSelect']) && isset($_GET['changePlaceLocatieInput']) && isset($_GET['changeLocatieSubmit'])) {
    $object->changeLocatie();
  } else if (isset($_GET['removeLocatieSelect']) && isset($_GET['removePlaceSubmit'])) {
    $object->removeLocatie();
  } else if (isset($_GET['addProductsNaam']) && isset($_GET['addProductsType']) && isset($_GET['addProductsFabriek']) &&
              isset($_GET['addProductsVoorraad']) && isset($_GET['addProductsMinimumVoorraad']) && isset($_GET['addProductsMaximumVoorraad']) &&
              isset($_GET['addProductsVerkoopprijs']) && isset($_GET['addProductSubmit'])) {
    $object->addProduct();
  } else if (isset($_GET['changeProductNaamSelect']) && isset($_GET['changeProductNaam']) && isset($_GET['changeProductNaamSubmit'])) {
    $object->changeProductNaam();
  } else if (isset($_GET['changeProductTypeSelect']) && isset($_GET['changeProductType']) && isset($_GET['changeProductTypeSubmit'])) {
    $object->changeProductType();
  } else if (isset($_GET['changeProductFabriekSelect']) && isset($_GET['changeProductFabriek']) && isset($_GET['changeProductFabriekSubmit'])) {
    $object->changeProductFabriek();
  } else if (isset($_GET['changeProductsNaamSelect3']) && isset($_GET['changeProductsTypeSelect3']) &&
              isset($_GET['changeProductsFabriekSelect3']) && isset($_GET['changeProductsVoorraad']) &&
              isset($_GET['changeProductVoorraadSubmit'])) {
    $object->changeProductVoorraad();
  }
  // else if (isset($_GET['changeProductsNaamSelect4']) && isset($_GET['changeProductsTypeSelect4']) &&
  //             isset($_GET['changeProductsFabriekSelect4']) && isset($_GET['changeProductsMinimumVoorraad']) &&
  //             isset($_GET['changeProductMinimumSubmit'])) {
  //   $object->changeProductMinimumVoorraad();
  // } else if (isset($_GET['changeProductsNaamSelect5']) && isset($_GET['changeProductsTypeSelect5']) &&
  //             isset($_GET['changeProductsFabriekSelect5']) && isset($_GET['changeProductsVerkoopprijs']) &&
  //             isset($_GET['changeProductVerkoopprijsSubmit'])) {
  //   $object->changeProductVerkoopprijs();
  // } else if (isset($_GET['removeProductsNaamSelect']) && isset($_GET['removeProductsTypeSelect']) &&
  //             isset($_GET['removeProductsFabriekSelect']) && isset($_GET['removeProductSubmit'])) {
  //   $object->removeProduct();
  // }



  // else if (isset($_POST['addMedewerkersVoornaam']) && isset($_POST['addMedewerkersTussenvoegsel']) &&
  //             isset($_POST['addMedewerkersAchternaam']) && isset($_POST['addMedewerkersWachtwoord']) &&
  //             isset($_POST['addMedewerkersRolSelect']) && isset($_POST['addMedewerkerSubmit'])) {
  //   $object->addMedewerker();
  // } else if (isset($_POST['changeMedewerkerVoornaamSelect1']) && isset($_POST['changeMedewerkerTussenvoegselSelect1']) &&
  //             isset($_POST['changeMedewerkerAchternaamSelect1']) && isset($_POST['changeMedewerkersVoornaam']) &&
  //             isset($_POST['changeMedewerkerVoornaamSubmit'])) {
  //   $object->changeMedewerkerVoornaam();
  // } else if (isset($_POST['changeMedewerkerVoornaamSelect2']) && isset($_POST['changeMedewerkerTussenvoegselSelect2']) &&
  //             isset($_POST['changeMedewerkerAchternaamSelect2']) && isset($_POST['changeMedewerkersTussenvoegsel']) &&
  //             isset($_POST['changeMedewerkerTussenvoegselSubmit'])) {
  //   $object->changeMedewerkerTussenvoegsel();
  // } else if (isset($_POST['changeMedewerkerVoornaamSelect3']) && isset($_POST['changeMedewerkerTussenvoegselSelect3']) &&
  //             isset($_POST['changeMedewerkerAchternaamSelect3']) && isset($_POST['changeMedewerkersAchternaam']) &&
  //             isset($_POST['changeMedewerkerAchternaamSubmit'])) {
  //   $object->changeMedewerkerAchternaam();
  // } else if (isset($_POST['changeMedewerkerVoornaamSelect4']) && isset($_POST['changeMedewerkerTussenvoegselSelect4']) &&
  //             isset($_POST['changeMedewerkerAchternaamSelect4']) && isset($_POST['changeMedewerkerRolSelect']) &&
  //             isset($_POST['changeMedewerkerRolSubmit'])) {
  //   $object->changeMedewerkerRol();
  // } else if (isset($_POST['changeMedewerkerVoornaamSelect5']) && isset($_POST['changeMedewerkerTussenvoegselSelect5']) &&
  //             isset($_POST['changeMedewerkerAchternaamSelect5']) && isset($_POST['changePassW']) &&
  //             isset($_POST['changeMedewerkerWachtwoordSubmit'])) {
  //   $object->changeMedewerkerW8();
  // } else if (isset($_POST['removeMedewerkerVoornaamSelect']) && isset($_POST['removeMedewerkerTussenvoegselSelect']) &&
  //             isset($_POST['removeMedewerkerAchternaamSelect']) && isset($_POST['removeMedewerkerSubmit'])) {
  //   $object->removeMedewerker();
  // }
?>

<?php
  class Dbh {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "toolsforever";
    private $charset = "utf8mb4";

      public function uitlog() {
        if(isset($_GET['uitlog'])) {
          session_unset();
          session_destroy();
          header('Location: '.URL.'index.php', TRUE, 302);
        }
      }

      public function overzicht() {
        if(isset($_GET['overzichtVenster'])) {
          header('Location: '.URL.'overzicht.php', TRUE, 302);
        }
      }

      /**
        setFormSelectOptionData function.
        The name says it all.
        It sets the data in the select option form.

        types of data:
          - locatie
          - product
          - type
          - fabriek
          - voornaam
          - tussenvoegsel
          - achternaam
      */

      public function setFormSelectOptionData() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // set "locatie naam" for the forms.
          $GLOBALS['locatieNaam'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT naam FROM vestiging_locatie ORDER BY naam");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['locatieNaam'], $row['naam']);
          }
          array_shift($GLOBALS['locatieNaam']);

          // set "product naam" for the forms.
          $GLOBALS['productNaam'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT product FROM products ORDER BY product");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['productNaam'], $row['product']);
          }
          array_shift($GLOBALS['productNaam']);

          // set "product type" for the forms.
          $GLOBALS['productType'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT type FROM products ORDER BY type");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['productType'], $row['type']);
          }
          array_shift($GLOBALS['productType']);

          // set "product fabriek" for the forms.
          $GLOBALS['productFabriek'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT fabriek FROM products ORDER BY fabriek");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['productFabriek'], $row['fabriek']);
          }
          array_shift($GLOBALS['productFabriek']);

          // set "medewerker voornaam" for the forms.
          $GLOBALS['medewerkerVoornaam'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT voornaam FROM medewerkers ORDER BY voornaam");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['medewerkerVoornaam'], $row['voornaam']);
          }
          array_shift($GLOBALS['medewerkerVoornaam']);

          // set "medewerker tussenvoegsel" for the forms.
          $GLOBALS['medewerkerTussenvoegsel'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT tussenvoegsel FROM medewerkers ORDER BY tussenvoegsel");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['medewerkerTussenvoegsel'], $row['tussenvoegsel']);
          }
          array_shift($GLOBALS['medewerkerTussenvoegsel']);

          // set "medewerker achternaam" for the forms.
          $GLOBALS['medewerkerAchternaam'] = array("");
          $stmt = $conn->prepare("SELECT DISTINCT achternaam FROM medewerkers ORDER BY achternaam");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($GLOBALS['medewerkerAchternaam'], $row['achternaam']);
          }
          array_shift($GLOBALS['medewerkerAchternaam']);

        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        $conn = null;
      }

      public function addLocatie() {
          try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
            $stmt->execute();
            $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS=0");
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO vestiging_locatie (naam) VALUES (:naam)");
            $stmt->bindParam(':naam', $naam);

            $naam = $_GET['addLocatie'];
            $stmt->execute();
          } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function changeLocatie() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();

          $stmt = $conn->prepare("UPDATE vestiging_locatie SET naam = :nieuwLocatie WHERE naam = :oudLocatie");
          $stmt->bindParam(':nieuwLocatie', $nieuwLocatie);
          $stmt->bindParam(':oudLocatie', $oudLocatie);

          $nieuwLocatie = $_GET['changePlaceLocatieInput'];
          $oudLocatie = $_GET['changeLocatieSelect'];
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function removeLocatie() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();

          $stmt = $conn->prepare("DELETE FROM vestiging_locatie WHERE naam = :naam");
          $stmt->bindParam(':naam', $naam);

          $naam = $_GET['removeLocatieSelect'];
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function addProduct() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();
          $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS=0");
          $stmt->execute();

          $stmt = $conn->prepare("INSERT INTO products (product, type, fabriek, verkoopprijs) VALUES (:product, :type, :fabriek, :verkoopprijs)");
          $stmt->bindParam(':product', $product);
          $stmt->bindParam(':type', $type);
          $stmt->bindParam(':fabriek', $fabriek);
          $stmt->bindParam(':verkoopprijs', $verkoopprijs);

          $product = $_GET['addProductsNaam'];
          $type = $_GET['addProductsType'];
          $fabriek = $_GET['addProductsFabriek'];
          $verkoopprijs = $_GET['addProductsVerkoopprijs'];
          $stmt->execute();

          $getLocatieId = array("");
          $getProductId;

          $stmt = $conn->prepare("SELECT idlocatie FROM vestiging_locatie");
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            array_push($getLocatieId, $row['idlocatie']);
          }
          array_shift($getLocatieId);

          $stmt = $conn->prepare("SELECT idproduct FROM products WHERE product = :product AND type = :type AND fabriek = :fabriek");
          $stmt->bindParam(':product', $product);
          $stmt->bindParam(':type', $type);
          $stmt->bindParam(':fabriek', $fabriek);

          $product = $_GET['addProductsNaam'];
          $type = $_GET['addProductsType'];
          $fabriek = $_GET['addProductsFabriek'];
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            $getProductId = $row['idproduct'];
            echo $getProductId;
          }

          foreach ($getLocatieId as $key => $value) {
            $stmt = $conn->prepare("INSERT INTO locatie_has_products (idlocatie, idproduct, voorraad, minimumVoorraad, maximumVoorraad) VALUES (:idlocatie, :idproduct, :voorraad, :minimumVoorraad, :maximumVoorraad)");
            $stmt->bindParam(':idlocatie', $idLocatie);
            $stmt->bindParam(':idproduct', $idProduct);
            $stmt->bindParam(':voorraad', $voorraad);
            $stmt->bindParam(':minimumVoorraad', $minimumVoorraad);
            $stmt->bindParam(':maximumVoorraad', $maximumVoorraad);

            $idLocatie = $value;
            $idProduct = $getProductId;
            $voorraad = $_GET['addProductsVoorraad'];
            $minimumVoorraad = $_GET['addProductsMinimumVoorraad'];
            $maximumVoorraad = $_GET['addProductsMaximumVoorraad'];
            $stmt->execute();
          }

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function changeProductNaam() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();

          $stmt = $conn->prepare("UPDATE products SET product = :nieuwProduct WHERE product = :oudProduct");
          $stmt->bindParam(':nieuwProduct', $nieuwProduct);
          $stmt->bindParam(':oudProduct', $oudProduct);

          $nieuwProduct = $_GET['changeProductNaam'];
          $oudProduct = $_GET['changeProductNaamSelect'];
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function changeProductType() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();

          $stmt = $conn->prepare("UPDATE products SET type = :nieuwType WHERE type = :oudType");
          $stmt->bindParam(':nieuwType', $nieuwType);
          $stmt->bindParam(':oudType', $oudType);

          if ($_GET['changeProductType'] == '') {
            $nieuwType = ' ';
          } else {
            $nieuwType = $_GET['changeProductType'];
          }

          $oudType = $_GET['changeProductTypeSelect'];
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function changeProductFabriek() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();

          $stmt = $conn->prepare("UPDATE products SET fabriek = :nieuwFabriek WHERE fabriek = :oudFabriek");
          $stmt->bindParam(':nieuwFabriek', $nieuwFabriek);
          $stmt->bindParam(':oudFabriek', $oudFabriek);

          $nieuwFabriek = $_GET['changeProductFabriek'];
          $oudFabriek = $_GET['changeProductFabriekSelect'];
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          header('Location: '.URL.'admin.php', TRUE, 302);
      }

      public function changeProductVoorraad() {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
          $stmt->execute();

          $getProductId;

          $stmt = $conn->prepare("SELECT idproduct FROM products WHERE product = :product AND type = :type AND fabriek = :fabriek");
          $stmt->bindParam(':product', $product);
          $stmt->bindParam(':type', $type);
          $stmt->bindParam(':fabriek', $fabriek);

          $product = $_GET['changeProductsNaamSelect3'];
          $type = $_GET['changeProductsTypeSelect3'];
          $fabriek = $_GET['changeProductsFabriekSelect3'];
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            $getProductId = $row['idproduct'];
            echo $getProductId;
          }

          $stmt = $conn->prepare("SELECT idlocatie FROM vestiging_locatie WHERE naam = :naam");
          $stmt->bindParam(':naam', $naam);

          $naam = $_GET['changeProductsVestigingLocatieSelect3'];
          $stmt->execute();
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          foreach ($result as $key => $row) {
            $getLocatieId = $row['idlocatie'];
            echo $getLocatieId;
          }


          $stmt = $conn->prepare("UPDATE locatie_has_products SET voorraad = :voorraad WHERE idproduct = :idproduct AND idlocatie = :idlocatie");
          $stmt->bindParam(':voorraad', $voorraad);
          $stmt->bindParam(':idproduct', $idproduct);
          $stmt->bindParam(':idlocatie', $idlocatie);

          $voorraad = $_GET['changeProductsVoorraad'];
          $idproduct = $getProductId;
          $idlocatie = $getLocatieId; 
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
          $conn = null;
          // header('Location: '.URL.'admin.php', TRUE, 302);
      }

      // public function changeProductMinimumVoorraad() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE products SET minimumVoorraad = :minimumVoorraad WHERE product = :product AND type = :type AND fabriek = :fabriek");
      //     $stmt->bindParam(':minimumVoorraad', $minimumVoorraad);
      //     $stmt->bindParam(':product', $product);
      //     $stmt->bindParam(':type', $type);
      //     $stmt->bindParam(':fabriek', $fabriek);
      //
      //     $minimumVoorraad = $_GET['changeProductsMinimumVoorraad'];
      //     $product = $_GET['changeProductsNaamSelect4'];
      //     $type = $_GET['changeProductsTypeSelect4'];
      //     $fabriek = $_GET['changeProductsFabriekSelect4'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function changeProductVerkoopprijs() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE products SET verkoopprijs = :verkoopprijs WHERE product = :product AND type = :type AND fabriek = :fabriek");
      //     $stmt->bindParam(':verkoopprijs', $verkoopprijs);
      //     $stmt->bindParam(':product', $product);
      //     $stmt->bindParam(':type', $type);
      //     $stmt->bindParam(':fabriek', $fabriek);
      //
      //     $verkoopprijs = $_GET['changeProductsVerkoopprijs'];
      //     $product = $_GET['changeProductsNaamSelect5'];
      //     $type = $_GET['changeProductsTypeSelect5'];
      //     $fabriek = $_GET['changeProductsFabriekSelect5'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function removeProduct() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $getProductId;
      //
      //     $stmt = $conn->prepare("SELECT idproduct FROM products WHERE product = :product AND type = :type AND fabriek = :fabriek");
      //     $stmt->bindParam(':product', $product);
      //     $stmt->bindParam(':type', $type);
      //     $stmt->bindParam(':fabriek', $fabriek);
      //
      //     $product = $_GET['removeProductsNaamSelect'];
      //     $type = $_GET['removeProductsTypeSelect'];
      //     $fabriek = $_GET['removeProductsFabriekSelect'];
      //     $stmt->execute();
      //     $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      //     foreach ($result as $key => $row) {
      //       $getProductId = $row['idproduct'];
      //     }
      //
      //     $stmt = $conn->prepare("DELETE FROM products WHERE idproduct = :idproduct");
      //     $stmt->bindParam(':idproduct', $idProduct);
      //
      //     $idProduct = $getProductId;
      //     $stmt->execute();
      //
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function addMedewerker() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("INSERT INTO medewerkers (voornaam, tussenvoegsel, achternaam, wachtwoord, rol) VALUES (:voornaam, :tussenvoegsel, :achternaam, :wachtwoord, :rol)");
      //     $stmt->bindParam(':voornaam', $voornaam);
      //     $stmt->bindParam(':tussenvoegsel', $tussenvoegsel);
      //     $stmt->bindParam(':achternaam', $achternaam);
      //     $stmt->bindParam(':wachtwoord', $wachtwoord);
      //     $stmt->bindParam(':rol', $rol);
      //
      //     $passwordUser = $_POST['addMedewerkersWachtwoord'];
      //     $hashedPwd = password_hash($passwordUser, PASSWORD_DEFAULT);
      //
      //     if ($_POST['addMedewerkersTussenvoegsel'] == '') {
      //       $tussenvoegsel = ' ';
      //     } else {
      //       $tussenvoegsel = $_POST['addMedewerkersTussenvoegsel'];
      //     }
      //
      //     $voornaam = $_POST['addMedewerkersVoornaam'];
      //     $achternaam = $_POST['addMedewerkersAchternaam'];
      //     $wachtwoord = $hashedPwd;
      //     $rol = $_POST['addMedewerkersRolSelect'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function changeMedewerkerVoornaam() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE medewerkers SET voornaam = :nieuwVoornaam WHERE voornaam = :oudVoornaam AND tussenvoegsel = :tussenvoegsel AND achternaam = :achternaam");
      //     $stmt->bindParam(':nieuwVoornaam', $nieuwVoornaam);
      //     $stmt->bindParam(':oudVoornaam', $oudVoornaam);
      //     $stmt->bindParam(':tussenvoegsel', $tussenvoegsel);
      //     $stmt->bindParam(':achternaam', $achternaam);
      //
      //     $nieuwVoornaam = $_POST['changeMedewerkersVoornaam'];
      //     $oudVoornaam = $_POST['changeMedewerkerVoornaamSelect1'];
      //     $tussenvoegsel = $_POST['changeMedewerkerTussenvoegselSelect1'];
      //     $achternaam = $_POST['changeMedewerkerAchternaamSelect1'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function changeMedewerkerTussenvoegsel() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE medewerkers SET tussenvoegsel = :nieuwTussenvoegsel WHERE voornaam = :voornaam AND tussenvoegsel = :oudTussenvoegsel AND achternaam = :achternaam");
      //     $stmt->bindParam(':voornaam', $voornaam);
      //     $stmt->bindParam(':nieuwTussenvoegsel', $nieuwTussenvoegsel);
      //     $stmt->bindParam(':oudTussenvoegsel', $oudTussenvoegsel);
      //     $stmt->bindParam(':achternaam', $achternaam);
      //
      //     if ($_POST['changeMedewerkersTussenvoegsel'] == '') {
      //       $nieuwTussenvoegsel = ' ';
      //     } else {
      //       $nieuwTussenvoegsel = $_POST['changeMedewerkersTussenvoegsel'];
      //     }
      //
      //     $voornaam = $_POST['changeMedewerkerVoornaamSelect2'];
      //     $oudTussenvoegsel = $_POST['changeMedewerkerTussenvoegselSelect2'];
      //     $achternaam = $_POST['changeMedewerkerAchternaamSelect2'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function changeMedewerkerAchternaam() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE medewerkers SET achternaam = :nieuwAchternaam WHERE voornaam = :voornaam AND tussenvoegsel = :tussenvoegsel AND achternaam = :oudAchternaam");
      //     $stmt->bindParam(':voornaam', $voornaam);
      //     $stmt->bindParam(':tussenvoegsel', $tussenvoegsel);
      //     $stmt->bindParam(':nieuwAchternaam', $nieuwAchternaam);
      //     $stmt->bindParam(':oudAchternaam', $oudAchternaam);
      //
      //     $voornaam = $_POST['changeMedewerkerVoornaamSelect3'];
      //     $tussenvoegsel = $_POST['changeMedewerkerTussenvoegselSelect3'];
      //     $oudAchternaam = $_POST['changeMedewerkerAchternaamSelect3'];
      //     $nieuwAchternaam = $_POST['changeMedewerkersAchternaam'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function changeMedewerkerRol() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE medewerkers SET rol = :rol WHERE voornaam = :voornaam AND tussenvoegsel = :tussenvoegsel AND achternaam = :achternaam");
      //     $stmt->bindParam(':rol', $rol);
      //     $stmt->bindParam(':voornaam', $voornaam);
      //     $stmt->bindParam(':tussenvoegsel', $tussenvoegsel);
      //     $stmt->bindParam(':achternaam', $achternaam);
      //
      //     $rol = $_POST['changeMedewerkerRolSelect'];
      //     $voornaam = $_POST['changeMedewerkerVoornaamSelect4'];
      //     $tussenvoegsel = $_POST['changeMedewerkerTussenvoegselSelect4'];
      //     $achternaam = $_POST['changeMedewerkerAchternaamSelect4'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function changeMedewerkerW8() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("UPDATE medewerkers SET wachtwoord = :wachtwoord WHERE voornaam = :voornaam AND tussenvoegsel = :tussenvoegsel AND achternaam = :achternaam");
      //     $stmt->bindParam(':wachtwoord', $wachtwoord);
      //     $stmt->bindParam(':voornaam', $voornaam);
      //     $stmt->bindParam(':tussenvoegsel', $tussenvoegsel);
      //     $stmt->bindParam(':achternaam', $achternaam);
      //
      //     $passwordUser = $_POST['changePassW'];
      //     $hashedPwd = password_hash($passwordUser, PASSWORD_DEFAULT);
      //
      //     $wachtwoord = $hashedPwd;
      //     $voornaam = $_POST['changeMedewerkerVoornaamSelect5'];
      //     $tussenvoegsel = $_POST['changeMedewerkerTussenvoegselSelect5'];
      //     $achternaam = $_POST['changeMedewerkerAchternaamSelect5'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
      //
      // public function removeMedewerker() {
      //   try {
      //     $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //
      //     $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
      //     $stmt->execute();
      //
      //     $stmt = $conn->prepare("DELETE FROM medewerkers WHERE voornaam = :voornaam AND tussenvoegsel = :tussenvoegsel AND achternaam = :achternaam");
      //     $stmt->bindParam(':voornaam', $voornaam);
      //     $stmt->bindParam(':tussenvoegsel', $tussenvoegsel);
      //     $stmt->bindParam(':achternaam', $achternaam);
      //
      //     $voornaam = $_POST['removeMedewerkerVoornaamSelect'];
      //     $tussenvoegsel = $_POST['removeMedewerkerTussenvoegselSelect'];
      //     $achternaam = $_POST['removeMedewerkerAchternaamSelect'];
      //     $stmt->execute();
      //   } catch(PDOException $e) {
      //     echo $sql . "<br>" . $e->getMessage();
      //   }
      //     $conn = null;
      //     header('Location: '.URL.'admin.php', TRUE, 302);
      // }
  }
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
          <span id="medewerkerStatus">Manager. <?php echo $_SESSION['naam']; ?></span>
          <form method="GET" id="uitlogForm">
            <input type="submit" name="uitlog" value="uitloggen" id="uitlogSubmit">
          </form>
        </div>
        <div id="bigFormDiv">
          <div id="line1"></div>
          <div id="line2"></div>
          <div id="line3"></div>
          <div id="line4"></div>
          <div id="locatieDiv">
            <span id="locatieInfo">Hier kan je de vestiging locatie toevoegen, wijzigen of verwijderen</span>
            <div id="locatieAddDiv">
              <span id="locatieInfo1">- vestiging locatie toevoegen.</span>
              <form method="GET" id="addPlaceForm" class="formColumns">
                <input type="text" name="addLocatie" value="" placeholder="type hier de nieuwe locatie" required id="addPlaceLocatieInput">
                <input type="submit" name="addPlaceSubmit" value="Toevoegen" class="formSubmitColumns">
              </form>
            </div>
            <div id="locatieChangeDiv">
              <span id="locatieInfo2">- vestiging locatie wijzigen.</span>
              <form method="GET" id="changeLocatieForm" class="formColumns">
                <select name="changeLocatieSelect" id="changeLocatieSelect">
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="text" name="changePlaceLocatieInput" value="" placeholder="type hier de nieuwe gewijzigde locatie" required id="changePlaceLocatieInput">
                <input type="submit" name="changeLocatieSubmit" value="Wijziging opslaan" class="formSubmitColumns">
              </form>
            </div>
            <div id="locatieRemoveDiv">
              <span id="locatieInfo4">- vestiging locatie verwijderen.</span>
              <form method="GET" id="removePlaceForm" class="formColumns">
                <select name="removeLocatieSelect" id="removeLocatieSelect">
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="submit" name="removePlaceSubmit" value="Verwijder" class="formSubmitColumns">
              </form>
            </div>
          </div>
          <div id="productDiv">
            <span id="productInfo">Hier kan je de product informatie toevoegen, wijzigen of verwijderen</span>
            <div id="productAddDiv">
              <span id="productInfo1">- artikel gegevens toevoegen.</span>
              <form method="GET" id="addProductForm" class="formColumns">
                <input type="text" name="addProductsNaam" value="" placeholder="type hier de nieuwe product naam" id="addProductsNaam" required>
                <input type="text" name="addProductsType" value="" placeholder="type hier de nieuwe type van het product" id="addProductsType">
                <input type="text" name="addProductsFabriek" value="" placeholder="type hier van welke fabriek het product komt" id="addProductsFabriek" required>
                <input type="number" name="addProductsVoorraad" value="" min="0" placeholder="type hier het getal van het voorraad van dit product" id="addProductsVoorraad" required>
                <input type="number" name="addProductsMinimumVoorraad" value="" min="0" placeholder="type hier het getal van het minimum voorraad van dit product" id="addProductsMinimumVoorraad" required>
                <input type="number" name="addProductsMaximumVoorraad" value="" min="0" placeholder="type hier het getal van het maximum voorraad van dit product" id="addProductsMaximumVoorraad" required>
                <input type="number" name="addProductsVerkoopprijs" value="" min="0" step=".01" placeholder="type hier wat de nieuwe verkoopprijs is van dit product" id="addProductsVerkoopprijs" required>
                <input type="submit" name="addProductSubmit" value="Toevoegen" id="addProductSubmit" class="formSubmitColumns">
              </form>
            </div>
            <div id="productChangeDiv">
              <span id="productInfo2">- artikel naam wijzigen.</span>
              <form method="GET" id="changeProductNaamForm" class="formColumns">
                <select name="changeProductNaamSelect" id="changeProductNaamSelect">
                  <?php
                    foreach ($GLOBALS['productNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="text" name="changeProductNaam" value="" placeholder="type hier de nieuwe product naam" required id="changeProductNaam">
                <input type="submit" name="changeProductNaamSubmit" value="Wijziging opslaan" class="formSubmitColumns">
              </form>
              <span id="productInfo3">- artikel type wijzigen.</span>
              <form method="GET" id="changeProductTypeForm" class="formColumns">
                <select name="changeProductTypeSelect" id="changeProductTypeSelect">
                  <?php
                    foreach ($GLOBALS['productType'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="text" name="changeProductType" value="" placeholder="type hier de nieuwe product type" id="changeProductType">
                <input type="submit" name="changeProductTypeSubmit" value="Wijziging opslaan" class="formSubmitColumns">
              </form>
              <span id="productInfo4">- artikel fabriek wijzigen.</span>
              <form method="GET" id="changeProductFabriekForm" class="formColumns">
                <select name="changeProductFabriekSelect" id="changeProductFabriekSelect">
                  <?php
                    foreach ($GLOBALS['productFabriek'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="text" name="changeProductFabriek" value="" placeholder="type hier de nieuwe product fabriek" required id="changeProductFabriek">
                <input type="submit" name="changeProductFabriekSubmit" value="Wijziging opslaan" class="formSubmitColumns">
              </form>
              <span id="productInfo8">- artikel voorraad of verkoopprijs gegeven(s) wijzigen.</span>
              <form method="GET" id="changeProductForm" class="formColumns">
                <input type="text" readonly value="Artikel naam:" class="productChangeReadInfo" id="pcri_1">
                <input type="text" readonly value="Artikel type:" class="productChangeReadInfo" id="pcri_2">
                <input type="text" readonly value="Artikel fabriek:" class="productChangeReadInfo" id="pcri_3">
                <input type="text" readonly value="Vestiging locatie:" class="productChangeReadInfo" id="pcri_4">
                <select name="changeProductsNaamSelect3" id="changeProductsNaamSelect3">
                  <?php
                    foreach ($GLOBALS['productNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsTypeSelect3" id="changeProductsTypeSelect3">
                  <?php
                    foreach ($GLOBALS['productType'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsFabriekSelect3" id="changeProductsFabriekSelect3">
                  <?php
                    foreach ($GLOBALS['productFabriek'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <select name="changeProductsVestigingLocatieSelect3" id="changeProductsVestigingLocatieSelect3">
                  <?php
                    foreach ($GLOBALS['locatieNaam'] as $val) {
                      echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                    }
                  ?>
                </select>
                <input type="number" name="changeProductsVoorraad" value="" min="0" placeholder="type hier het nieuwe getal voor de voorraad" id="changeProductsVoorraad">
                <input type="number" name="changeProductsMinimumVoorraad" value="" min="0" placeholder="type hier het nieuwe getal voor de minimum voorraad." id="changeProductsMinimumVoorraad">
                <input type="number" name="changeProductsMaximumVoorraad" value="" min="0" placeholder="type hier het nieuwe getal voor de maximum voorraad." id="changeProductsMaximumVoorraad">
                <input type="number" name="changeProductsVerkoopprijs" value="" min="0" step="0.1" placeholder="type hier het nieuwe getal voor de verkoopprijs." id="changeProductsVerkoopprijs">
                <input type="submit" name="changeProductVoorraadSubmit" value="Wijziging opslaan" id="changeProductVoorraadSubmit" class="formSubmitColumns">
              </form>
          </div>
          <div id="productRemoveDiv">
            <span id="productInfo11">- artikel verwijderen van een bepaalde type en fabriek.</span>
            <form method="GET" id="removeProductForm">
              <select name="removeProductsNaamSelect" id="removeProductsNaamSelect">
                <?php
                  foreach ($GLOBALS['productNaam'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="removeProductsTypeSelect" id="removeProductsTypeSelect">
                <?php
                  foreach ($GLOBALS['productType'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="removeProductsFabriekSelect" id="removeProductsFabriekSelect">
                <?php
                  foreach ($GLOBALS['productFabriek'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <input type="submit" name="removeProductSubmit" value="Verwijder" id="removeProductSubmit" class="formSubmitColumns">
            </form>
          </div>
        </div>
        <div id="medewerkerDiv">
          <span id="medewerkerInfo">Hier kan je medewerkers informatie toevoegen, wijzigen of verwijderen</span>
          <div id="medewerkerAddDiv">
            <span id="medewerkerInfo1">- medewerker naam, wachtwoord en rol toevoegen.</span>
            <form method="POST" id="addMedewerkerForm" class="formColumns">
              <input type="text" name="addMedewerkersVoornaam" value="" placeholder="type hier de voornaam van de nieuwe medewerker" required id="addMedewerkersVoornaam" class="addMedewerker">
              <input type="text" name="addMedewerkersTussenvoegsel" value="" placeholder="type hier de tussenvoegsel van de nieuwe medewerker" id="addMedewerkersTussenvoegsel" class="addMedewerker">
              <input type="text" name="addMedewerkersAchternaam" value="" placeholder="type hier de achternaam van de nieuwe medewerker" required id="addMedewerkersAchternaam" class="addMedewerker">
              <input type="password" name="addMedewerkersWachtwoord" value="" placeholder="type hier een wachtwoord van de nieuwe medewerker" required id="addMedewerkersWachtwoord" class="addMedewerker">
              <select name="addMedewerkersRolSelect" id="addMedewerkersRolSelect" class="addMedewerker">
                <option value="0">Medewerker</option>
                <option value="1">Manager</option>
              </select>
              <input type="submit" name="addMedewerkerSubmit" value="Toevoegen" id="addMedewerkerSubmit" class="formSubmitColumns">
            </form>
          </div>
          <div id="medewerkerChangeDiv">
            <span id="medewerkerInfo2">- medewerker gegeven(s) wijzigen.</span>
            <form method="POST" id="changeMedewerkerForm" class="formColumns">
              <input type="text" readonly name="readVoornaam" value="Voornaam:" class="readVoornaam">
              <input type="text" readonly name="readTussenvoegsel" value="Tussenvoegsel:" class="readTussenvoegsel">
              <input type="text" readonly name="readAchternaam" value="Achternaam:" class="readAchternaam">
              <input type="text" readonly name="readRol" value="Rol:" id="changeMedewerkersRol">
              <select name="changeMedewerkerVoornaamSelect1" class="changeMedewerkerVoornaamSelect">
                <?php
                  foreach ($GLOBALS['medewerkerVoornaam'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="changeMedewerkerTussenvoegselSelect1" class="changeMedewerkerTussenvoegselSelect">
                <?php
                  foreach ($GLOBALS['medewerkerTussenvoegsel'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="changeMedewerkerAchternaamSelect1" class="changeMedewerkerAchternaamSelect">
                <?php
                  foreach ($GLOBALS['medewerkerAchternaam'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="changeMedewerkerRolSelect" id="changeMedewerkerRolSelect">
                <option value="no change">Selecteer hier voor een nieuwe rol</option>
                <option value="0">Medewerker</option>
                <option value="1">Manager</option>
              </select>
              <input type="text" name="changeMedewerkersVoornaam" value="" placeholder="type hier de nieuwe gewijzigde voornaam" required id="changeMedewerkersVoornaam">
              <input type="text" name="changeMedewerkersTussenvoegsel" value="" placeholder="type hier de nieuwe gewijzigde tussenvoegsel" required id="changeMedewerkersTussenvoegsel">
              <input type="text" name="changeMedewerkersAchternaam" value="" placeholder="type hier de nieuwe gewijzigde achternaam" required id="changeMedewerkersAchternaam">
              <input type="text" name="changeMedewerkersWachtwoord" value="" placeholder="type hier de nieuwe gewijzigde sterke wachtwoord" required id="changeMedewerkersWachtwoord">
              <input type="submit" name="changeMedewerkerSubmit" value="Wijziging opslaan" id="changeMedewerkerSubmit" class="formSubmitColumns">
            </form>
          </div>
          <div id="medewerkerRemoveDiv">
            <span id="medewerkerInfo7">- medewerker verwijderen.</span>
            <form method="POST" id="removeMedewerkerForm" class="formColumns">
              <input type="text" readonly name="readVoornaam" value="Voornaam:" class="readVoornaam">
              <input type="text" readonly name="readTussenvoegsel" value="Tussenvoegsel:" class="readTussenvoegsel">
              <input type="text" readonly name="readAchternaam" value="Achternaam:" class="readAchternaam">
              <select name="removeMedewerkerVoornaamSelect" id="removeMedewerkerVoornaamSelect">
                <?php
                  foreach ($GLOBALS['medewerkerVoornaam'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="removeMedewerkerTussenvoegselSelect" id="removeMedewerkerTussenvoegselSelect">
                <?php
                  foreach ($GLOBALS['medewerkerTussenvoegsel'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <select name="removeMedewerkerAchternaamSelect" id="removeMedewerkerAchternaamSelect">
                <?php
                  foreach ($GLOBALS['medewerkerAchternaam'] as $val) {
                    echo "<option value=\"".utf8_encode($val)."\">".utf8_encode($val)."</option>";
                  }
                ?>
              </select>
              <input type="submit" name="removeMedewerkerSubmit" value="Verwijder" id="removeMedewerkerSubmit" class="formSubmitColumns">
            </form>
          </div>
        </div>
        <div id="lastDiv_overzichtVenster">
          <form method="GET" id="overzichtForm">
            <input type="submit" name="overzichtVenster" value="Naar overzicht venster gaan" id="overzichtVenster">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
