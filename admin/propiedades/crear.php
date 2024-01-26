<?php
    //Base de datos

    require '../../includes/config/database.php';
    $db = conectarDB();

    //Arreglo con mensajes de errores
    $errores = [];
    


    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = $_POST[''];
        $precio = $_POST[''];
        $descripcion = $_POST[''];
        $habitaciones = $_POST[''];
        $wc = $_POST[''];
        $estacionamiento = $_POST[''];
        $vendedor = $_POST[''];

        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }
        if(strlen($descripcion) < 50){
            $errores[] = "Descripcion obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "Debes añadir habitaciones";
        }
        if(!$wc){
            $errores[] = "Debes añadir wc";
        }
        if(!$estacionamiento){
            $errores[] = "Debes añadir estacionamiento";
        }
        if(!$vendedor){
            $errores[] = "Debes elegir un vendedor";
        }


        if(empty($errores)){
            //Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) 
            VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedor')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                echo "Insertado Correctamente";
            }
        }
}

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Crear</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
   
        
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo: </label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio: </label>
                <input type="number" min="0" id="precio" name="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripcion: </label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones: </label>
                <input type="number" min="1" max="9" id="habitaciones" name="habitaciones" placeholder="Ej: 3">

                <label for="wc">Baños: </label>
                <input type="number" min="1" max="9" id="wc" name="wc" placeholder="Ej: 2">

                <label for="estacionamiento">Estacionamiento: </label>
                <input type="number" min="1" max="9" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccione--</option>
                    <option value="1">Juan</option>
                    <option value="2">Karen</option>
                </select>
            </fieldset>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>




    </main>

<?php
    incluirTemplate('footer');  
?>