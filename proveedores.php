<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proovedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


</head>
<body>
<?php 
include('../nav.php');
?>
<div class="container">
    <h1 class="page-header text-center">Proveedores</h1>
    <div class="row">
        <div class="col-12">
            <a href="addp.php" class="btn btn-primary addx">Añadir Proveedor</a>
            <button  class="btn btn-primary reporte5" onclick="printReport()">Imprimir Reporte</button>
            <table class="table table-bordered table-striped" style="margin-top:20px;">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Opcion</th>
                </thead>
                <tbody>
                    <?php
                        //fetch data from json
                        $data = file_get_contents('proveedor.json');
                        //decode into php array
                        $data = json_decode($data);
 
                        $index = 0;
                        foreach($data as $row){
                            echo "
                                <tr>
                                    <td>".$row->codigo."</td>
                                    <td>".$row->nombre."</td>
                                    <td>".$row->apellido."</td>
                                    <td>".$row->direccion."</td>
                                    <td>".$row->telefono."</td>

                                    <td>
                                        <a href='editp.php?index=".$index."' class='btn btn-success btn-sm'>Editar&nbsp&nbsp&nbsp</a>
                                        <a href='deletep.php?index=".$index."' class='btn btn-danger btn-sm'>Eliminar</a>
                                    </td>
                                </tr>
                            ";
 
                            $index++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../script_imprimir.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>