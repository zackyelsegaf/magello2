<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
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
                <tr class="group-header">
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
</x-export.pdf>