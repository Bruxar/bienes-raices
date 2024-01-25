<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Conoce sobre Nosotros</h2>
        <div class="nosotros">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
            </picture>
            <div class="info-nosotros">
                <h3>25 años de Experiencia</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae perspiciatis iste odio tempore quibusdam
                    cum maiores cupiditate non, doloribus nemo, repellendus dolore quo! Perspiciatis qui aperiam voluptas 
                    debitis quaerat magnam?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint eligendi dignissimos nobis esse mollitia 
                    sequi quis, assumenda nostrum possimus exercitationem et optio non dolore. Aliquid repellendus
                    perspiciatis dicta temporibus numquam!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint eligendi dignissimos nobis esse mollitia 
                        sequi quis, assumenda nostrum possimus exercitationem et optio non dolore. Aliquid repellendus
                        perspiciatis dicta temporibus numquam nostrum possimus exercitationem et optio non!</p>
            </div>
        </div>
    </main>

    <?php
    incluirTemplate('footer');  
?>

