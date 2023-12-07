<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Social Hub Manager</title>
    <style>
        body main{
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

        main header h1 {
            font-size: 2em;
        }

        main div {
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

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>