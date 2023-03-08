<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orden Produccion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"></head>

</head>
<body>
    
<?php 
include('nav.php');
?>

<div class="container">
    <h1 class="page-header text-center">SISTEMA DE INVENTARIOS - ORDEN DE PRODUCCION</h1>
    <div class="row">
        <div class="col-12">
            <a href="addOP.php" class="btn btn-primary addx">Agregar</a>
            <button  class="btn btn-primary reporte5 " onclick="printReport()">Imprimir Reporte</button>
            <table class="table table-bordered table-striped" style="margin-top:20px;">
                <thead>
                    <th>ID</th>
                    <th>Numero</th>
                    <th>Cliente</th>
                    <th>Produccion</th>
                    <th>Accion</th>
                </thead>
                <tbody>
                    <?php
                        //fetch data from json
                        $data = file_get_contents('orden.json');
                        //decode into php array
                        $data_array = json_decode($data);

                        $index = 0;
                        foreach($data_array as $row){
                         echo "
        <tr>
            <td>". $row->id . "</td>
            <td>". $row->numero . "</td>
            <td>". $row->cliente . "</td>
            <td>
            <table class='table'>
                <thead>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </thead>
                <tbody>";

                $totalfinal = 0; 
                $totalfinalreporte = 0; 

                foreach ($row->recetas as $receta) {
                    echo "
                    <tr>
                        <td>" . $receta->nombre . "</td>
                        <td>" . $receta->cantidad . "</td>
                        <td>" . $receta->precio . "</td>         
                ";
                $total = $receta->cantidad * $receta->precio ; 
                echo "
                        <td>" .$total."</td>       
                    </tr>
                ";
                $totalfinal +=  $total ; // sumar el precio de cada fila
                $totalfinalreporte +=  $totalfinal ; 
                }
                echo "
                            <tr>
                                <td></td>
                                <td></td>

                                <td><strong>Total Final:</strong></td>
                                <td>".$totalfinal."</td>
                                
                            </tr>
                        ";
                echo "
                </tbody>
            </table>
        </td>                                    
        <td>
           
        <a href='deleteOP.php?index=" . $index . "' class='btn btn-danger btn-sm'>Eliminar</a>
        <button class='btn btn-primary btn-sm' onclick='imprimirFila($index)'>Imprimir</button>
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
    
    <script src="script_imprimir.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</div>
</body>
</html>