<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SGEBD - Sistema de Gestão de Escola Bíblica</title>
    <style media="print">
        table {
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            border: .5px solid #102b3f;
        }

        thead tr {
            background-color: #102b3f;
            text-align: left;
        }

        th {
            color: #ffffff;
        }

        th,
        td {
            padding: 12px 15px;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #102b3f;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="wrapper">
    <div class="row">
        <div class="col-xs-12">
            {{-- <p align="center"><img src="{{ public_path('img/ipad.jpg') }}" width="110" height="auto" /></p> --}}
            <h4 style="text-align: center;"><strong>IPAD</strong></h4>
            <h5 style="text-align: center;"><strong>Igreja Pentecostal Assembleia de Deus</strong></h5>
            <h5 style="text-align: center;"><strong>Sistema de Gestão de Escola Bíblica Dominical</strong></h5>
        </div>
    </div>
    <br />
    @yield('content')
    <br />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>
<footer>
    <div class="container">
        <div class="row">
            Sistema desenvolvido por <a href="http://fb.com/Joao7dom">João Franco </a>
        </div>
        <div class="row">
            © Copyright 2017
        </div>
    </div>
</footer>

</html>
