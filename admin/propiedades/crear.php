<?php
    require '../../includes/funciones.php';
    $auth = estaAutenticado();
    
    if(!$auth){
        header('Location: /');
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];
    
    $titulo = $_POST[''];
    $precio = $_POST[''];
    $descripcion = $_POST[''];
    $habitaciones = $_POST[''];
    $wc = $_POST[''];
    $estacionamiento = $_POST[''];
    $vendedorId = $_POST[''];
    $creado = date('Y/m/d');

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];
    
    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);

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
        if(!$vendedorId){
            $errores[] = "Debes elegir un vendedor";
        }
        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "Debes añadir una imagen";
        }

        //Validar la imagen por tamaño (max 1MB)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){
            $errores[] = "La imagen es muy pesada";
        }


        if(empty($errores)){

            // ** Subida de archivos **
            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //Generar nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);


            //Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) 
            VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redireccionar al usuario
                header('Location: /admin?resultado=1');
            }
        }
}
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
   
        
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo: </label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio: </label>
                <input type="number" min="0" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion: </label>
                <textarea id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones: </label>
                <input type="number" min="1" max="9" id="habitaciones" name="habitaciones" placeholder="Ej: 3" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños: </label>
                <input type="number" min="1" max="9" id="wc" name="wc" placeholder="Ej: 2" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento: </label>
                <input type="number" min="1" max="9" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccione--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>




    </main>

<?php
    incluirTemplate('footer');  
?>