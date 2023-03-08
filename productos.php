<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


</head>

<body>
    <?php
    include('nav.php');
    ?>
    <br><br>
    <div class="container">
        <h1 class="page-header text-center">Productos</h1>
        <div class="row">
            <div class="col-12">
                <a href="addprod.php" class="btn btn-primary addx">Añadir Producto</a>
                <button class="btn btn-primary reporte5" onclick="printReport()">Imprimir Reporte</button>
                <table class="table table-bordered table-striped" style="margin-top:20px;">
                    <thead>
                        <th>Codigo</th>
                        <th>Numero</th>
                        <th>Nombre</th>

                        <th>Materias Primas</th>
                        <th>Precio Total</th>
                        </th>

                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php
                        //fetch data from json
                        $data = file_get_contents('productos.json');
                        //decode into php array
                        $data = json_decode($data);

                        $index = 0;
                        foreach ($data as $row) {
                            $costo_total = 0;
                            echo "
                <tr>
                    <td>" . $row->id . "</td>
                    <td>" . $row->numero . "</td>
                    <td>" . $row->nombre . "</td>
                     <td>
                        <table class='table'>
                            <thead>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Unidades</th>
                                <th>Costo</th>
                             </thead>
                            <tbody>";



                            foreach ($row->ingredientes as $ingrediente) {
                                $total_costo = $ingrediente->cantidad * $ingrediente->costo;
                                $costo_total += $total_costo;
                                echo "
                                <tr>
                                    <td>" . $ingrediente->id . "</td>
                                    <td>" . $ingrediente->nombreing . "</td>
                                    <td>" . $ingrediente->cantidad . "</td>
                                    <td>" .  $ingrediente->unidad . "</td>
                                    <td>" . $ingrediente->costo . "</td>
 
                                     
                                </tr>
                            ";

                                
                            }



                            echo "
                            </tbody>
                        </table>
                    </td> 
                    <td>" . $costo_total  . "</td>
                                                                
                    <td>
                    <a href='deleteprod.php?index=" . $index . "' class='btn btn-danger btn-sm'>Eliminar</a>
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






    <script src="script_imprimir.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>