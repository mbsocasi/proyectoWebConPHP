<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Añadir Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
    include('nav.php');
    ?>
<div class="container">
    <h1 class="page-header text-center">Añadir Cliente</h1>
    <div class="row">
        <div class="col-1"></div>
        
        <form method="POST">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Codigo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="codigo" name="codigo">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nombre del cliente</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Apellido del cliente</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Direccion</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Telefono</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
            </div>
            <input type="submit" name="save" value="Guardar" class="btn btn-primary">
            <div style="margin-left: 20px;display:inline;"><a href="clientes.php">Back</a>
        </form>
        </div>
        <div class="col-5"></div>
    </div>
</div>  

<?php
    if(isset($_POST['save'])){
        //open the json file
        $data = file_get_contents('cliente.json');
        $data = json_decode($data);
 
        //data in out POST
        $input = array(
            'codigo' => $_POST['codigo'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'telefono' => $_POST['telefono']



        );
 
        //append the input to our array
        $data[] = $input;
        //encode back to json
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('cliente.json', $data);
 
        header('location: clientes.php');
    }
?>
</body>
</html>