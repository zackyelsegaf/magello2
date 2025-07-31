<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesanan Pembelian Per Pemasok</title>
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
        .pemasok-header { 
            background-color: #f0f0f0; 
            font-weight: bold; 
        }
        .total-row { 
            font-weight: bold; 
        }
        h1, h2{
            text-align: center;
            margin: 0px 0px 10px 0px
        }
    </style>
</head>
<body>
    <h2>PT ANUGRAH MAGELLO NUSANTARA</h2>
    <h1>Pesanan Pembelian Per Pemasok</h1>
    <h2>From {{ date('d/m/Y', strtotime($tanggal['from'])) }} To {{ date('d/m/Y', strtotime($tanggal['to'])) }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Pesanan</th>
                <th>Tgl. Pesanan</th>
                <th>Tgl. Perkiraan</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $pemasok)
                <tr class="pemasok-header">
                    <td colspan="7">
                        {{ $pemasok->pemasok_id }} - {{ $pemasok->nama }}
                    </td>
                </tr>

                @foreach($pemasok->pesanan as $pesanan)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pesanan->no_pesanan }}</td>
                        <td>{{ $pesanan->tgl_pesanan }}</td>
                        <td>{{ $pesanan->tgl_perkiraan }}</td>
                        <td>{{ $pesanan->deskripsi }}</td>
                        <td>{{ $pesanan->status_pesanan }}</td>
                        <td>{{ number_format($pesanan->jumlah) }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>