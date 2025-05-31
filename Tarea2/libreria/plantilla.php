<?php


class plantilla
{


    public static $instancia = null;


    public static function aplicar(): plantilla
    {

        if (self::$instancia == null) {
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }

    public function __construct()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        </head>

        <body>
            <div class="container">
                <h1 class="mt-3">Entretenimiento</h1>
                <p>Listado de peliculas y series las cuales he visto </p>



                <div style="min-height: 500px;">
                <?php

            }

            public function __destruct()
            {
                ?>
                </div>
                <div class="text-center">
                    <hr>
                    Derechos reservados &copy; <?= date(format: "Y") ?> - Lo que he visto
                </div>
            </div>

        </body>

        </html>
<?php

            }
        }
