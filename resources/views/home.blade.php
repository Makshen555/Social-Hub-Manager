<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Hub Manager</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 50px 0;

        }

        header h1 {
            font-size: 2em;
        }

        section {
            max-width: 800px;
            margin: 40px auto;
            text-align: center;
        }

        section h2 {
            color: #3498db;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
        }

        #cta {
            background-color: #ecf0f1;
            padding: 50px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .logout-button {
        order: -1; /* Esto coloca el .logout-button primero en el orden de visualización */
        }
    </style>
</head>
<body>
<header>
    <div class="logout-button"> 
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Salir</button>
        </form>
    </div>
    <div>
        <h1>Social Hub Manager</h1>
        <p>Maneja tus publicaciones en redes sociales de manera eficiente.</p>
    </div>
</header>

<section id="cta">
    <h2>LINKEDIN</h2>
    <p>Share your posts in the social web LinkedIn.</p>
    <a href="#" class="button">Post in LinkedIn</a>
</section>

<footer>
    <p>&copy; 2023 Social Hub Manager. Todos los derechos reservados.</p>
</footer>
</body>
</html>