<?php


class plantilla{

    static $instancia = null;
    public static function aplicar(){
        if (self::$instancia == null) {
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }

    function __construct()
    {

        $pagina_actual = (defined('PAGINA_ACTUAL') ? PAGINA_ACTUAL : 'inicio');
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

        <style>
            
    body {
        background: linear-gradient(to bottom right, #ffe4f0, #fff0f5);
        font-family: 'Comic Sans MS', cursive, sans-serif;
        color: #d63384;
    }

    h1 {
        text-align: center;
        font-size: 3rem;
        font-weight: bold;
        color: #e83e8c;
        margin-top: 20px;
    }

    .nav-tabs .nav-link {
        color: #d63384;
        border-radius: 10px;
        margin-right: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        background-color: #ff69b4;
        color: white !important;
        border-color: #ff69b4;
    }

    .nav-tabs .nav-link:hover {
        background-color: #f8c1dd;
        color: #b0005d;
    }

    .container {
        background-color: #fff0f5;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 0 20px rgba(255, 105, 180, 0.2);
    }

    .contenido {
        padding: 20px;
        background-color: #ffffffcc;
        border-radius: 10px;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9rem;
        color: #b0005d;
    }

    .form-label, .form-select {
        color: #b0005d;
        font-weight: bold;
    }

    .form-select {
        border-radius: 10px;
        border: 2px solid #ff69b4;
    }

    .btn {
        background-color: #ff69b4;
        color: white;
        border-radius: 10px;
        font-weight: bold;
        border: none;
    }

    .btn:hover {
        background-color: #e83e8c;
    }
</style>


        </head>
        <body>
            
            <div class ="container">
                <div>
                    <h1>Mundo Barbie</h1>
                </div>
                <div class="divmenu">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
    <a class="nav-link <?= $pagina_actual == 'inicio'?'active':''; ?>" aria-current="page" href="<?= base_url(); ?>">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $pagina_actual == 'personajes'?'active':''; ?>" href="<?= base_url('modulos/personajes/lista_per.php'); ?>">Personajes</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $pagina_actual == 'profesiones'?'active':''; ?>" href="<?= base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $pagina_actual == 'estadisticas'?'active':''; ?>" href="<?= base_url('modulos/reportes/menu.php'); ?>">Estadisticas</a>
</li>

                     </ul>
                    </div>
                <div class="contenido" style ="min-height: 600px;">



        <?php

    }

    function __destruct()
    {
        ?>
                        </div>
                <div class"footer">
                    <hr>
                    <p>© 2025 Mundo Barbie</p>

                </div>
            </div>
        </body>
        </html>
        <?php
    }
}