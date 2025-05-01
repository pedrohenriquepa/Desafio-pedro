<!doctype html>
<html lang="pt-br">

<head>
    <title>Desafio-Avelar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="icon" href="{{ asset('IconeAvelar.png') }}" type="image/png" sizes="128x128">


    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            background-color: #eeeeee;
            /* Azul bem clarinho */
            color: #000000;
            /* Cor do texto preta */
        }


        .navbar {
            background-color: #ffffff;
            /* azul escuro semelhante ao favicon */
        }

        .navbar .nav-link {
            color: #ffffff !important;
            /* dourado Bootstrap (parecido com o tom do ícone) */
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            color: #f2bc27 !important;
        }

        .btn-primary {
            background-color: #053d84;
            border-color: #053d84;
        }

        .btn-primary:hover {
            background-color: #053c84f1;
            border-color: #053d84;
            color: #f2bc27
        }

        /* CABEÇALHO DA TABELA*/
        .tabela-custom {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        .tabela-custom thead {
            background-color: #053d84;
            color: white;
        }

        .tabela-custom th {
            text-align: center;
            vertical-align: middle;
        }

        .tabela-custom td {
            vertical-align: middle;
        }

        .tabela-cabecalho {
            background-color: #053d84 !important;
            color: white;
        }

        .tabela-cabecalho th {
            text-align: center;
            vertical-align: middle;
            background-color: #053d84 !important;
            color: white !important;
        }



        .form-control:focus {
            border-color: #ffd146;
            box-shadow: 0 0 0 0.2rem rgba(243, 203, 84, 0.76);
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            color: #053d84;
        }

        label {
            color: #053d84;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand navbar-dark" style="background-color: #053d84;">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('imagem.png') }}" alt="Logo">
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('avelar') }}" aria-current="page">CRUD <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('avelar') }}">AVELAR</a>
            </li>
        </ul>
    </nav>


    <main class="container-fluid p-3">
        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
