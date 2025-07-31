<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesanan Pembelian Per Barang</title>
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
        .barang-header { 
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
    <h1>Pesanan Pembelian Per Barang</h1>
    <h2>From {{ date('d/m/Y', strtotime($tanggal['from'])) }} To {{ date('d/m/Y', strtotime($tanggal['to'])) }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Pesanan</th>
                <th>Tgl. Pesanan</th>
                <th>Kuantitas</th>
                <th>Kts. Diterima</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $barang)
                <tr class="barang-header">
                    <td colspan="6">
                        {{ $barang->no_barang }} - {{ $barang->nama_barang }}
                    </td>
                </tr>

                @php
                    $total_kts_pesanan = 0;
                    $total_kts_diterima = 0;
                @endphp
                @foreach($barang->detailPesanan as $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $detail->rincian->no_pesanan }}</td>
                        <td>{{ $detail->rincian->tgl_pesanan }}</td>
                        <td>{{ $detail->kts_pesanan }}</td>
                        <td>{{ $detail->kts_diterima }}</td>
                        <td>{{ $detail->rincian->status_pesanan }}</td>
                    </tr>
                    @php
                        $total_kts_pesanan += $detail->kts_pesanan;
                        $total_kts_diterima += $detail->kts_diterima;
                    @endphp
                @endforeach

                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td>{{ $total_kts_pesanan }}</td>
                    <td>{{ $total_kts_diterima }}</td>
                    <td style="background-color: #f0f0f0;"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>