<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Añadir Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_POST['save'])) {
        $data = file_get_contents('productos.json');
        $data_array = json_decode($data, true);

        $input = [];
        $input['id'] = intval($_POST['id']);
        $input['numero'] = $_POST['numero'];

        $recetas = [];

        $nombres = $_POST['nombre'];
        $cantidades = $_POST['cantidad'];
        $precios = $_POST['precio'];

        foreach ($nombres as $index => $nombre) {
            $receta = [];
            $receta['nombre'] = $nombre;
            $receta['cantidad'] = intval($cantidades[$index]);
            $receta['precio'] = floatval($precios[$index]);
            $recetas[] = $receta;
        }

        $input['recetas'] = $recetas;

        $data_array[] = $input;
        $data = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents('productos.json', $data);

        header('location: productos.php');
    }

    ?>
    <div class="container">
        <div class="row">
            <form method="post">
                <label class="col-sm-2 col-form-label" for="id">ID:</label>
                <input class="form-control" type="text" name="id"><br>

                <label class="col-sm-2 col-form-label" for="numero">Numero:</label>
                <input class="form-control" type="text" name="numero"><br>





                <h2>Ingredientes </h2>
                <div id="recetas">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="recetas2">
                                <tr class="receta">
                                    <td>
                                        <div class="form-group">
                                            <select class="form-select" name="nombre[]" id="nombre">
                                                <?php
                                                $productos = file_get_contents('members.json');
                                                $productos = json_decode($productos, true);
                                                foreach ($productos as $nombre) {
                                                    echo '<option value="' . $nombre['nombpro']  . '">' . $nombre['nombpro'] . '</option>';
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
                                            <input class="form-control" type="text" name="precio[]">
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
                <button class="btn btn-secondary" type="button" onclick="addReceta()">Agregar receta</button>
                <button class="btn btn-primary" type="submit" name="save">Guardar</button>
                <script>
                    function addReceta() {
                        var receta = document.createElement('tr');
                        receta.className = 'receta';
                        receta.innerHTML = `
        <td>
            <div class="form-group">
                <select class="form-select" name="nombre[]">
                <?php
                $productos = file_get_contents('members.json');
                $productos = json_decode($productos, true);
                foreach ($productos as $nombre) {
                    echo '<option value="' . $nombre['nombpro'] . '">' . $nombre['nombpro'] . '</option>';
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
                <input class="form-control" type="text" name="precio[]">
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