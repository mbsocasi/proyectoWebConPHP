<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
    //get id from URL
    $index = $_GET['index'];
 
    //get json data
    $data = file_get_contents('proveedor.json');
    $data_array = json_decode($data);
 
    //assign the data to selected index
    $row = $data_array[$index];
 
    if(isset($_POST['save'])){
        $input = array(
            'codigo' => $_POST['codigo'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'telefono' => $_POST['telefono']
        );
 
        //update the selected index
        $data_array[$index] = $input;
 
        //encode back to json
        $data = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents('proveedor.json', $data);
 
        header('location: proveedores.php');
    }
?>
<div class="container">
    <h1 class="page-header text-center">Editar</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-8"><a href="index.php">Back</a>
        <form method="POST">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Codigo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $row->codigo; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nombre del Proveedor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row->nombre; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Apellido del Proveedor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row->apellido; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Direccion del Proveedor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row->direccion; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Telefono del Proveedor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row->telefono; ?>">
                </div>
            </div>
            
            <input type="submit" name="save" value="Guardar" class="btn btn-primary">
        </form>
        </div>
        <div class="col-5"></div>
    </div>
</div>    
</body>
</html>