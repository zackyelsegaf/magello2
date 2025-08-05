<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        body { 
            font-family: sans-serif; 
            font-size: 12px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #000; 
            padding: 6px; 
            text-align: left; 
        }
        thead {
            background-color: #075697;
            color: white;
        }
        .group-header { 
            background-color: #f0f0f0; 
            font-weight: bold; 
        }
        .group-space{
            margin-right: 2rem;
        }
        .total-row { 
            font-weight: bold; 
        }
        .negative {
            color: red
        }
        h1, h2{
            text-align: center;
            margin: 0px 0px 10px 0px
        }
    </style>
</head>
<body>
    <h2>PT ANUGRAH MAGELLO NUSANTARA</h2>
    <h1>{{ $title }}</h1>
    <h2>From {{ date('d/m/Y', strtotime($tanggalAwal)) }} To {{ date('d/m/Y', strtotime($tanggalAkhir)) }}</h2>

    {{ $slot }}
    
</body>
</html>