<?php
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    //Autenticar Usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        }
        if(!$password) {
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)){
            //Revisar si el user existe
            $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                //revisar si password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    //Usuario autenticado
                    session_start();
                    
                    //Llenar arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                }else{
                    $errores[] = "El password es incorrecto";
                }

            }else{
                $errores[] = "El Usuario no existe";
            }
        }

        echo "<pre>";
        var_dump($errores);
        echo "</pre>";
    }


    //Header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
            <?php endforeach; ?>

        <form method="POST" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password" required>

        </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        </form>
    </main>

<?php
    incluirTemplate('footer');  
?>