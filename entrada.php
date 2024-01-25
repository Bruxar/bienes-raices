<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar sin gastar demasiado</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="anuncio">
        </picture>

        <p class="informacion-meta">Escrito el <span>20/10/2021</span> Por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque in ducimus perferendis necessitatibus consectetur, quibusdam aspernatur eaque qui iure impedit tempore deserunt facilis exercitationem provident illo nesciunt cumque temporibus voluptatum?</p>
        </div>
    </main>

    <?php
    incluirTemplate('footer');  
?>