<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Retur</th>
                <th>Deskripsi Persediaan</th>
                <th>Kuantitas</th>
                <th>Harga Satuan</th>
                <th>Jumlah Harga</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $no = 1; 
                $grand_total_kts_barang = 0;
                $grand_total_harga_satuan = 0;
                $grand_total_jumlah_harga = 0;
            @endphp
            @foreach($data as $retur)
                <tr class="group-header">
                    <td colspan="6">
                        {{ $retur->no_retur . ' - ' . $retur->tgl_retur . ' - ' . $retur->pemasok_retur }}
                    </td>
                </tr>

                @php 
                    $total_kts_barang = 0;
                    $total_harga_satuan = 0;
                    $total_jumlah_harga = 0;
                @endphp
                @foreach($retur->detail as $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $retur->no_retur }}</td>
                        <td>{{ $detail->deskripsi_barang }}</td>
                        <td>{{ $detail->kts_barang }}</td>
                        <td>{{ $detail->harga_satuan }}</td>
                        <td>{{ $detail->jumlah_total_harga }}</td>
                    </tr>
                    @php 
                        $total_kts_barang += $detail->kts_barang;
                        $total_harga_satuan += $detail->harga_satuan;
                        $total_jumlah_harga += $detail->jumlah_total_harga;
                    @endphp
                @endforeach

                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td>{{ $total_kts_barang }}</td>
                    <td>{{ $total_harga_satuan }}</td>
                    <td>{{ $total_jumlah_harga }}</td>
                </tr>

                @php 
                    $grand_total_kts_barang += $total_kts_barang;
                    $grand_total_harga_satuan += $total_harga_satuan;
                    $grand_total_jumlah_harga += $total_jumlah_harga;
                @endphp
            @endforeach

            <tr class="group-header">
                <td colspan="3">Grand Total</td>
                <td>{{ $grand_total_kts_barang }}</td>
                <td>{{ $grand_total_harga_satuan }}</td>
                <td>{{ $grand_total_jumlah_harga }}</td>
            </tr>
        </tbody>
    </table>
</x-export.pdf>