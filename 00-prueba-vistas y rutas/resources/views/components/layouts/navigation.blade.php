<!--esta es una vista solo para navegación a la cual se le llama en las vistas blade sin
necesidad de repetir código con @ include('nombre-vista')-->
<nav>
    <ul>
        <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
        <li><a href="<?php echo e(route('about')); ?>">A cerca de...</a></li>
        <li><a href="<?php echo e(route('contact')); ?>">Contacto</a></li>
        <li><a href="<?php echo e(route('home')); ?>">Welcome</a></li>
    </ul>
</nav>