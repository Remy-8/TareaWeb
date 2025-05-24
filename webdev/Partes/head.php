<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #mitarea1{
            width: 80%;
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        #divMenu{
            margin: 20px 0;
            background-color: black;
            padding: 2px;
            border-radius: 5px;
            color: white;
            text-align: center;
        }
        #divMenu ul{
            list-style-type: none;
            padding: 0px;
        }
        #divMenu li{
            display: inline;
            margin-right: 20px;
        }
        #divMenu a{
            text-decoration: none;
            color: white ;
            font-weight: bold;

        }
        #divMenu a:hover{
            text-decoration: underline;
            color: #ccc;
        }
        #divContenido {
            min-height: 400px;
        }
    </style>
</head>
<body>
    
    <div id="mitarea1">
        <div>
            <h1>Tarea 1</h1>
            <p>Esta es la pagina de la tarea 1</p>
        </div>

        <div id="divMenu">
            <ul>
                <li>
                    <a href="tarjeta.php">Tarjeta</a>
                </li>
                 <li>
                    <a href="Calculadora.php">Calculadora</a>
                </li>
                 <li>
                    <a href="Adivina.php">Adivina</a>
                </li>
                 <li>
                    <a href="Acercade.php">Acerca de</a>
                </li>
            </ul>
            
        </div>
           <div id="divContenido">   