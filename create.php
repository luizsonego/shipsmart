<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php require('./header.php'); ?>

<body>
  <div class="container">
    <div clas="span10 offset1">
      <div class="card">
        <div class="card-header">
          <h3 class="well"> Criar Item </h3>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="sendData.php" method="post" name="product">


            <div class="control-group">
              <label class="control-label">SKU</label>
              <div class="controls">
                <input size="10" class="form-control" name="sku" id="sku" type="text" placeholder="SKU" required onblur="skuInput()" pattern="[A-Z0-9]+" >
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Nome</label>
              <div class="controls">
                <input size="10" class="form-control" name="name" type="text" placeholder="Nome" >
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Descrição</label>
              <div class="controls">
                <input size="10" class="form-control" name="description" type="text" placeholder="Descrição" value="<?php echo !empty($description) ? $description : ''; ?>">
                <?php if (!empty($error)) : ?>
                  <span class="text-danger"><?php echo $error; ?></span>
                <?php endif; ?>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">Valor</label>
              <div class="controls">
                <input size="10" class="form-control" name="price" id="price" type="text" placeholder="Valor" onkeyup="moneyFormat()" value="">
                
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Moeda</label>
              <div class="controls">
                <input size="10" class="form-control" name="currency" type="text" placeholder="Moeda" value="" maxlength="3">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Peso</label>
              <div class="controls">
                <input size="10" class="form-control" name="weight" type="text" placeholder="Peso" value="" onkeyup="weightFormat()">
                
              </div>
            </div>


            <div class="form-actions">
              <br />
              <!-- <button type="submit" class="btn btn-success">Adicionar</button> -->
              <input type="submit" name="send" value="Criar" class="btn btn-success" onclick="validateForm()" />
              <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <script>
    document.getElementById('sku').addEventListener('keyup', (ev) => {
      const input = ev.target;
      input.value = input.value.toUpperCase();
    })

    function skuInput() {
      const input = document.forms["product"]["sku"].value
      const regex = new RegExp("^[A-Z0-9]+$")
      if(!regex.test(input)){
        console.log('erro')
      }
    }

    function validateForm() {
      const name = document.getElementById('sku')

      if (name.value == '') {
        console.log('ta vazio sku')
        name.focus()
        return
      }
    }

    function moneyFormat(string) {
      var input = document.forms["product"]["price"]
      var price = input.value
      
      price = price + ''
      price = parseInt(price.replace(/[\D]+/g, ''))
      price = price + ''
      price = price.replace(/([0-9]{2})$/g, ",$1")

      if(price.length > 6){
        price = price.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
      }

      input.value = price
    }

    function weightFormat(string) {
      var input = document.forms["product"]["weight"]
      var weight = input.value
      
      weight = weight + ''
      weight = parseInt(weight.replace(/[\D]+/g, ''))
      weight = weight + ''
      weight = weight.replace(/([0-9]{3})$/g, ",$1")

      input.value = weight
    }
      

  </script>
</body>

</html>