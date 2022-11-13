<?php

  if (
    isset($_POST['productID']) && 
    isset($_POST['productPrice']) && 
    isset($_POST['userID'])
  ) {
    $productID = $_POST['productID'];
    $productPrice = $_POST['productPrice'];
    $userID = $_POST['userID'];

    $conn = mysqli_connect('localhost', 'root', '', 'ventas');
    // Check connection
    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }

    // Aqui va tu codigo de insercion de los datos
    $sql = "INSERT INTO detalle(productId, productPrice, userId) values('$productID', '$productPrice', '$userID') ";

    if (mysqli_query($conn, $sql)) {
      echo json_encode(array("response"=> true, "message" => "Venta exitosa"));
    } else {
      echo "Error:" . mysqli_error($conn);
    }
    ;
  } else {
    print_r(array("error" => "No se han recibido los datos"));
  }

?>