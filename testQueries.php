<?php
  $object = new Dbh;
  $object->connect();
?>

<?php
  class Dbh {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "toolsforever";

    public function connect() {
      if(isset($_POST['connect'])) {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS=0");
          // $stmt->execute();
          //
          // $stmt = $conn->prepare("INSERT INTO locatie_has_products (idlocatie, idproduct) VALUES (:idlocatie, :idproduct)");
          // $stmt->bindParam(':idlocatie', $idlocatie);
          // $stmt->bindParam(':idproduct', $idproduct);
          //
          // // insert a row
          // $idlocatie = 200;
          // $idproduct = 300;
          // $stmt->execute();
          //
          // // insert another row
          // $idlocatie = 201;
          // $idproduct = 302;
          // $stmt->execute();
          //
          // // insert another row
          // $idlocatie = 206;
          // $idproduct = 309;
          // $stmt->execute();

          // echo "New records created successfully";






          // now select data and print out on web.
          $stmt = $conn->prepare("SELECT * FROM locatie_has_products");
          $stmt->execute();

          print("Fetch all of the remaining rows in the result set:\n");
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          print_r($result);

          echo "<br>";
          foreach ($result as $key => $row) {
            echo $key." = ".$row['idlocatie'].", ".$row['idproduct']."<br>";
          }




          // now select data and print out on web.
          $stmt = $conn->prepare("SELECT voornaam FROM medewerkers");
          $stmt->execute();

          print("Fetch all of the remaining rows in the result set:\n");
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          print_r($result);

          echo "<br>";
          foreach ($result as $key => $row) {
            echo $key." = ".$row['voornaam']."<br>";
          }

















          $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS=0");
          $stmt->execute();

          $stmt = $conn->prepare("INSERT INTO locatie_has_products (idlocatie, idproduct) VALUES (:idlocatie, :idproduct)");
          $stmt->bindParam(':idlocatie', $idlocatie);
          $stmt->bindParam(':idproduct', $idproduct);

          // insert a row
          $idlocatie = 200;
          $idproduct = 300;
          $stmt->execute();

          // insert another row
          $idlocatie = 201;
          $idproduct = 302;
          $stmt->execute();

          // insert another row
          $idlocatie = 206;
          $idproduct = 309;
          $stmt->execute();






        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        $conn = null;

      }
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
  </body>
</html>
