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
    <header style="display: grid;grid-template-columns: auto 2fr;align-items: center;">
        <div class="logout-button"> 
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
        <div>
            <h1><a href="/home">Social Hub Manager</a></h1>
            <p>Maneja tus publicaciones en redes sociales de manera eficiente.</p>
        </div>
    </header>

<section id="cta">
    <h2>Posts</h2>
    <p>Share your posts in a social media. You can choose between LinkedIn, Reddit or Twitter/X.</p>
    <a href="/postForm" class="button">Share a post</a>
</section>

<section id="cta">
    <h2>Schedule</h2>
    <p>View your pending posts.</p>
    <a href="#" class="button">View schedule</a>
</section>

<section id="cta">
    <h2>History</h2>
    <p>View your post's history.</p>
    <a href="/history" class="button">View history</a>
</section>

<footer>
    <p>&copy; 2023 Social Hub Manager. Todos los derechos reservados.</p>
</footer>
</body>
</html>