<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Materia Prima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 

</head>
<body>

<?php 
include('nav.php');
?>

<div class="container">
    <h1 class="page-header text-center"> Materia Prima</h1>

    

    <div class="row">
        <div class="col-12">
            <a href="add_MP.php" class="btn btn-primary addx">Agregar Materia Prima</a>
            <button  class="btn btn-primary reporte5" onclick="printReport()">Imprimir Reporte</button>

            <table class="table table-bordered table-striped" style="margin-top:20px;">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Marca</th>
                    <th>Fecha Caducidad</th>
                    <th>Cantidad</th>
                    <th>Unidades</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Accion</th>
                </thead>
                <tbody>
                    <?php
                        //fetch data from json
                        $data = file_get_contents('members_MP.json');
                        //decode into php array
                        $data_array = json_decode($data, true);

                        $total = 0; // variable para sumar los precios

                        $index = 0;
                        foreach($data_array as $row){
                            echo "
                                <tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['nombpro']."</td>
                                    <td>".$row['descpro']."</td>
                                    <td>".$row['marcapro']."</td>
                                    <td>".$row['fechapro']."</td>
                                    <td>".$row['cantpro']."</td>
                                    <td>".$row['unipro']."</td>
                                    <td>".$row['proveedor']."</td>
                                    <td>".$row['preciopro']."</td>
                                    <td>
                                        <a href='edit_MP.php?index=".$index."' class='btn btn-success btn-sm'>Editar</a>
                                    </td>
                                </tr>
                            ";
                            $total += $row['preciopro']; // sumar el precio de cada fila
                            $index++;
                        }
                        // fila adicional con la suma total de los precios
                        echo "
                            <tr>
                                <td colspan='8' class='text-end'><strong>Total:</strong></td>
                                <td>".$total."</td>
                                <td></td>
                            </tr>
                        ";
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="script_imprimir.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


 </div>
</body>
</html>