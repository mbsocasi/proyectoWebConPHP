<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Materia Prima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">    <style>

</style>
</head>
<body>
<?php

if(isset($_POST['save'])){
    //open the json file
    $data = file_get_contents('members.json');
    $data = json_decode($data, true);

    //data in out POST
    $input = array(
        'id' => $_POST['id'],
        'nombpro' => $_POST['nombpro'],
        'descpro' => $_POST['descpro'],
        'marcapro' => $_POST['marcapro'],
        'fechapro' => $_POST['fechapro'],
        'cantpro' => $_POST['cantpro'],
        'unipro' => $_POST['unipro'],
        'proveedor' => $_POST['proveedor'],
        'preciopro' => $_POST['preciopro']
    );
    
    
    //append the input to our array
    $data[] = $input;
    //encode back to json
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('members.json', $data);

    header('location: materiapirma.php');
    exit;
}    
?>
<div class="container">
    <h1 class="page-header text-center">SISTEMA INVENTARIOS - Materia Prima</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-8"><a class="btn btn-primary" href="materiapirma.php">Atras</a>
        <form method="POST">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Codigo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id"  >
                    <span id="error-id" style="color: red;"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombpro" name="nombpro" >
                    <span id="error-nombpro" style="color: red;"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="descpro" name="descpro">
                    <span id="error-descpro" style="color: red;"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="marcapro" name="marcapro">
                    <span id="error-marcapro" style="color: red;"></span>
                </div>
            </div>  
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Fecha Caducidad</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="fechapro" name="fechapro">
                    <span id="error-fechapro" style="color: red;"></span>
                </div>
            </div>  
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="cantpro" name="cantpro">
                    <span id="error-cantpro" style="color: red;"></span>
                </div>
            </div>  

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Unidades</label>
                <div class="col-sm-10">
                 <select class="form-control" name="unipro" id="unipro">
                    <option value="litros">litros</option>
                    <option value="kg">kg</option>
                    <option value="libras">libras</option>
                    <option value="unidades">unidades</option>
                     </select>
                </div>
            </div>  

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Proveedor</label>
                <div class="col-sm-10">
                <select class="form-control" name="proveedor" id="proveedor">
                        <?php
                            $proveedores = file_get_contents('proveedor.json');
                            $proveedores = json_decode($proveedores, true);
                            foreach($proveedores as $proveedor) {
                                echo '<option value="' . $proveedor['nombre'] . '">' . $proveedor['nombre'] . '</option>';}
                        ?>
                     </select>
                </div>
            </div>


            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                    <input type="number" step="any" class="form-control" id="preciopro" name="preciopro" >
                    <span id="error-preciopro" style="color: red;"></span>
                </div>
            </div>
 
            <input type="submit" name="save" value="Save" class="btn btn-primary" id="save-button">
        </form>
        </div>
        <div class="col-5"></div>
    </div>
</div>    


<script>
  // Selecciona el botón de "Save" por su id
  const saveButton = document.querySelector('#save-button');

  // Agrega un evento 'click' al botón de "Save"
  saveButton.addEventListener('click', (event) => {
    // Selecciona cada campo por su id
    const idField = document.querySelector('#id');
    const nameField = document.querySelector('#nombpro');
    const descField = document.querySelector('#descpro');
    const marcaField = document.querySelector('#marcapro');
    const fechaField = document.querySelector('#fechapro');
    const cantidadField = document.querySelector('#cantpro');
    const uniField = document.querySelector('#unipro');
    const proveedorField = document.querySelector('#proveedor');
    const precioField = document.querySelector('#preciopro');
    const regexNumE = /^\d+$/;
    const regexNum = /^\d+(\.\d{1,2})?$/;
    const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
    const fechaIngresada = new Date(fechaField.value.trim());
    const fechaActual = new Date();
    const regexLetras = /^[a-zA-Z]+$/;

    if (idField.value.trim() === '') {
  // Si el campo está vacío, muestra una alerta y previene que se envíe el formulario
  document.getElementById("error-id").innerHTML = "Este campo es obligatorio";
  event.preventDefault();
} else if (!regexNumE.test(idField.value.trim())) {
  // Si el valor no contiene solo números, muestra una alerta y previene que se envíe el formulario
  document.getElementById("error-id").innerHTML = "Por favor, ingrese solo números en este campo";
  event.preventDefault();
}

    // Verifica si alguno de los campos está vacío
    if (nameField.value.trim() === '' ) {
      // Si algún campo está vacío, muestra una alerta y previene que se envíe el formulario
      document.getElementById("error-nombpro").innerHTML = "Este campo es obligatorio";
      event.preventDefault();
    } else if (!regexLetras.test(nameField.value.trim())) {
  // Si el valor contiene caracteres que no son letras, muestra un mensaje de error y previene que se envíe el formulario
  document.getElementById("error-nombpro").innerHTML = "Por favor, ingrese solo letras";
  event.preventDefault();
    }

    if (descField.value.trim() === '' ) {
      // Si algún campo está vacío, muestra una alerta y previene que se envíe el formulario
      document.getElementById("error-descpro").innerHTML = "Este campo es obligatorio";
      event.preventDefault();
    }

    if (marcaField.value.trim() === '') {
  // Si el campo está vacío, muestra un mensaje de error y previene que se envíe el formulario
  document.getElementById("error-marcapro").innerHTML = "Este campo es obligatorio";
  event.preventDefault();
    } else if (!regexLetras.test(marcaField.value.trim())) {
  // Si el valor contiene caracteres que no son letras, muestra un mensaje de error y previene que se envíe el formulario
  document.getElementById("error-marcapro").innerHTML = "Por favor, ingrese solo letras";
  event.preventDefault();
    }

    if (fechaField.value.trim() === '') {
  // Si el campo está vacío, muestra un mensaje de error y previene que se envíe el formulario
  document.getElementById("error-fechapro").innerHTML = "Este campo es obligatorio";
  event.preventDefault();
    } else if (!regexFecha.test(fechaField.value.trim())) {
  // Si el valor no es una fecha válida, muestra un mensaje de error y previene que se envíe el formulario
  document.getElementById("error-fechapro").innerHTML = "Por favor, ingrese una fecha válida en formato YYYY-MM-DD";
  event.preventDefault();
    } else {

  if (fechaIngresada.getTime() < fechaActual.getTime()) {
    // Si la fecha ingresada es anterior a la fecha actual, muestra un mensaje de error y previene que se envíe el formulario
    document.getElementById("error-fechapro").innerHTML = "Por favor, ingrese una fecha a partir de la fecha actual";
    event.preventDefault();
    }
    }
    if (cantidadField.value.trim() === '' ) {
      // Si algún campo está vacío, muestra una alerta y previene que se envíe el formulario
      document.getElementById("error-cantpro").innerHTML = "Este campo es obligatorio";
      event.preventDefault();
    } else if (!regexNum.test(cantidadField.value.trim())) {
      // Si el valor no contiene solo números, muestra una alerta y previene que se envíe el formulario
    document.getElementById("error-cantpro").innerHTML = "Por favor, ingrese un número válido en este campo (por ejemplo, 12.34)";
    event.preventDefault();
    }

    if (precioField.value.trim() === '') {
     // Si el campo está vacío, muestra una alerta y previene que se envíe el formulario
     document.getElementById("error-preciopro").innerHTML = "Este campo es obligatorio";
     event.preventDefault();
    } else if (!regexNum.test(precioField.value.trim())) {
      // Si el valor no contiene solo números, muestra una alerta y previene que se envíe el formulario
    document.getElementById("error-preciopro").innerHTML = "Por favor, ingrese un número válido en este campo (por ejemplo, 12.34)";
    event.preventDefault();
    }
    
  });
</script>

</body>
</html>