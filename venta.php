<?php
  $products = array();
  session_start();
  $_SESSION["user"] = "1234";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página prueba</title>
</head>
<body>
  <input class="userID" type="hidden" name="userId" value=<?php echo $_SESSION["user"]; ?>>
    <div class="card" id="1">
      <img src="" alt="" class="photo">
      <div class="title">Mi titulo</div>
      <div>Descripcion</div>
      <div class="price">9.00</div>
      <div>
        <button class="pay">Pagar</button>
      </div>
    </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script>
    let body = document.querySelector('body')
    let userID = document.querySelector(".userID").value
    body.addEventListener('click', async(e) => {
      let isButton = e.target.classList.contains("pay")
      if (isButton) {
        let card = e.target.parentNode.parentNode
        let productID = card.id
        let productPrice = parseFloat(card.querySelector('.price').innerHTML)

        let formData = new FormData()
        formData.append("productID", productID)
        formData.append("productPrice", productPrice)
        formData.append("userID", userID)

        let response = await fetch("process.php", {
          method: "POST",
          body: formData
        })       

        let data = await response.json()
        if (data.response) {
          let alerta = await swal({
            title: data.message,
            text: "¿Deseas realizar otra venta?",
            icon: "success",
          })

          if(alerta) window.location = 'products.php'
    
        }

      }
    })
  </script>
</body>
</html>