<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Añadir Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <?php
  include('nav.php');
  ?>
  <h1 class="page-header text-center">AGREGAR UN NUEVO PRODUCTO</h1>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <?php
  if (isset($_POST['save'])) {
    $data = file_get_contents('productos.json');
    $data_array = json_decode($data, true);

    $input = [];
    $input['id'] = intval($_POST['id']);
    $input['numero'] = $_POST['numero'];
    $input['nombre'] = $_POST['nombre'];

    $ingredientes = [];

    // $nombres = $_POST['nombpro'];
    // $cantidades = $_POST['cantidad'];
    // $precios = $_POST['unipro'];

 

        $recetas = [];

    foreach ($nombres as $index => $nombreProd) {
      $nombreProd_parts = explode('|', $nombreProd);
      $ingrediente = [];
      $ingrediente['nombpro'] = $nombreProd_parts[0];
      $ingrediente['unipro'] = $nombreProd_parts[1];
      $ingrediente['id'] = $nombreProd_parts[2];
      $ingrediente['preciopro'] = $nombreProd_parts[3];
      $ingrediente['cantidad'] = intval($cantidades[$index]);
      $ingredientes[] = $receta;
    }

    $input['ingredientes'] = $ingredientes;

    $data_array[] = $input;
    $data = json_encode($data_array, JSON_PRETTY_PRINT);
    file_put_contents('productos.json', $data);

    header('location: productos.php');
  }

  ?>
  <div class="container">
    <div class="row">
      <div class="col-8"><a class="btn btn-primary addx" href="productos.php">Atras</a>
        <form method="post">
          <label class="col-sm-2 col-form-label" for="id">ID:</label>
          <input class="form-control" type="text" name="id"><br>

          <label class="col-sm-2 col-form-label" for="numero">Numero:</label>
          <input class="form-control" type="text" name="numero"><br>

          <label class="col-sm-2 col-form-label" for="nombre">Nombre:</label>
          <input class="form-control" type="text" name="nombre"><br>






          <h2>Orden de Produccion</h2>
          <div id="recetas">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Unidad </th>
                    <th>Precio de ingrediente </th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="recetas2">
                  <tr class="receta">
                    <td>
                      <div class="form-group">
                        <select class="form-select" name="nombpro[]" id="nombpro" onchange="actualizarValor(this)">
                          <option value="">Seleccione....</option>
                          <?php
                          $productos = file_get_contents('members.json');
                          $productos = json_decode($productos, true);
                          foreach ($productos as $nombreProd) {
                            echo '<option value="'
                              . $nombreProd['nombpro'] . '|'
                              . $nombreProd['unipro'] . '|'
                              . $nombreProd['id'] . '|'
                              . $nombreProd['preciopro'] . '|'
                              . '">' . $nombreProd['nombpro'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input class="form-control" type="text" name="cantidad[]">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input class="form-control valor" type="text" name="unipro[]" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input class="form-control valor2" type="text" name="preciopro[]" readonly>
                      </div>
                    </td>
                    <td>
                      <button class="btn btn-danger" type="button" onclick="borrarReceta(this)">Borrar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
          <button class="btn btn-secondary addx" type="button" onclick="addReceta()">Agregar Plato</button>
          <!-- <button class="btn btn-primary addx" type="submit" name="save">Guardar</button>-->
          <button class="btn btn-primary reporte5" type="submit" name="save">Guardar Producto</button>
          <script src="script_imprimir.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


          <script>
            function addReceta() {
              var receta = document.createElement('tr');
              receta.className = 'receta';
              receta.innerHTML = `
    <td>
        <div class="form-group">
        <select class="form-select" name="nombpro[]" id="nombpro"
                                                onchange="actualizarValor(this)">
                                                <option value="">Seleccione....</option>
                                                <?php
                                                $productos = file_get_contents('members.json');
                                                $productos = json_decode($productos, true);
                                                foreach ($productos as $nombreProd) {
                                                  echo '<option value="'
                                                    . $nombreProd['nombpro'] . '|'
                                                    . $nombreProd['unipro'] . '|'
                                                    . $nombreProd['id'] . '|'
                                                    . $nombreProd['preciopro'] . '|'
                                                    . '">' . $nombreProd['nombpro'] . '</option>';
                                                }
                                                ?>
                                            </select>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" type="text" name="cantidad[]">
        </div>
    </td>
    <td>
        <div class="form-group">
        <input class="form-control valor" type="text" name="unipro[]" readonly>
        </div>
    </td>
    <td>
        <div class="form-group">
        <input class="form-control valor2" type="text" name="preciopro[]" readonly>
        </div>
        </td>
    <td>
        <button class="btn btn-danger" type="button"
        onclick="borrarReceta(this)">Borrar</button>
    </td>
`;
              document.getElementById('recetas2').appendChild(receta);
            }

            function borrarReceta(btn) {
              var fila = btn.parentNode.parentNode;
              fila.parentNode.removeChild(fila);
            }
          </script>

</body>

</html>
<script>
  function actualizarValor(select) {
    var unipro = select.value.split('|')[1];
    var fila = select.closest('tr');
    var valorInput = fila.querySelector('.valor');
    valorInput.value = unipro;

    var preciopro = select.value.split('|')[2];
    var fila = select.closest('tr');
    var valorInput = fila.querySelector('.valor2');
    valorInput.value = preciopro;

  }
</script>
</body>

</html>