<?php
// 1) Incluir la conexión a PostgreSQL (variable $conn)
include "../db_connection.php"; // Ejemplo: $conn = pg_connect("host=... dbname=... user=... password=...");

// 2) Recibir variables (aquí por GET, podrías usar POST también)
$email            = $_GET["email"]            ?? "";
$question         = $_GET["question"]         ?? "";
$municipalityName = $_GET["municipalityName"] ?? "";
$municipalityID   = $_GET["municipalityID"]   ?? "";
$age              = $_GET["age"]              ?? "";
$gender           = $_GET["gender"]           ?? "";
$responses_json   = $_GET["responses"]        ?? "";

// 3) Fecha/hora actual
date_default_timezone_set("America/Mexico_City");
$fecha = date("Y-m-d H:i:s");

// 4) Variables fijas
$id_campania   = "Encuesta-Jalisco120225201251";
$campaign_name = "Encuesta-Jalisco";

// 5) Construir la sentencia de INSERT
$sql = "
INSERT INTO form_responses (
  campaign_name,
  campaign_id,
  date,
  responses,
  email,
  question,
  municipality,
  municipality_id,
  age,
  gender
)
VALUES (
  '$campaign_name',
  '$id_campania',
  '$fecha',
  '$responses_json',
  '$email',
  '$question',
  '$municipalityName',
  '$municipalityID',
  '$age',
  '$gender'
)
";

// 6) Ejecutar la consulta en PostgreSQL
$result = pg_query($conn, $sql);
if (!$result) {
    die("Error al insertar: " . pg_last_error($conn));
}

// 7) Cerrar la conexión
pg_close($conn);

?>

                <!DOCTYPE HTML>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
                    <title>Gracias por navegar con nosotros</title>
                    <style>
                        *{
                            margin: 0;
                            padding: 0;
                            font-family: "Montserrat", sans-serif;
                            text-align: center;
                        }
                        body{
                            background-image: url("../5239017.jpg");
                        }
                        #main-container{
                            height: 100vh;
                            background: radial-gradient(circle, rgba(2, 8, 39, 0.8) 0%, rgba(2,0,36,0.9) 60%);
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                        }
                        title{
                            font-weight: 600;
                        }
                        span{
                            font-weight: 200;
                            color: #FFF;
                            margin-bottom: 8px;
                        }
                        h2{
                            font-family: "Montserrat";
                            color: white;
                            text-shadow: 2px 2px 2px #000000;
                        }
                        img{
                            max-width: 100%;
                            max-height: 70%;
                        }
                    </style>
                </head>
                <body>
                    <div id="main-container">
                        <h2>¡Gracias por navegar con nosotros!</h2><br>
                        <span id="message">Serás conectado en 3 segundos. Por favor, espera</span>
                        <img src="Lib_wifi-2.webp">
                    </div>
                </body>
                <script>
                    const span = document.getElementById("message");
                    var counter = 3;
                    var timeOut = setInterval(function(){
                        if(counter <= 0){
                            clearInterval(timeOut);
                             window.location.replace('https://na.network-auth.com/splash/r_CYqazg.0.1093/grant?continue_url=http://google.com/');
                        }
                        else{
                            span.innerHTML = `Serás conectado en ${counter} segundos. Por favor, espera`;
                        }
                        counter--;
                    }, 1000);
                </script>
            </html>
