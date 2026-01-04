<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Subida</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 40px 20px;
            max-width: 400px;
            width: 100%;
        }

        .logo {
            max-width: 50%;
            height: auto;
            margin-bottom: 20px;
        }

        h2 {
            color: #77a432;
            margin-bottom: 20px;
        }

        p {
            margin: 20px 0;
            font-size: 18px;
        }

        .btn-subir {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .btn-subir:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="img/logo-removebg-preview.png" alt="Logo" class="logo">
        <h2>Confirmación de Subida</h2>
        <p>La imagen se ha subido exitosamente.</p>
        <p><a href="subir_fotos.php" class="btn-subir">Subir otra imagen</a></p>
    </div>
</body>
</html>
