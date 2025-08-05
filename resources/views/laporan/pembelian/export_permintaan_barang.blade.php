<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Request</th>
                <th>Tgl. Request</th>
                <th>Kuantitas</th>
                <th>Kts. Dipesan</th>
                <th>Kts. Diterima</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $barang)
                <tr class="group-header">
                    <td colspan="7">
                        {{ $barang->no_barang }} - {{ $barang->nama_barang }}
                    </td>
                </tr>

                @php
                    $total_kts_permintaan = 0;
                    $total_kts_dipesan = 0;
                    $total_kts_diterima = 0;
                @endphp
                @foreach($barang->detailPermintaan as $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $detail->rincian->no_permintaan }}</td>
                        <td>{{ date('d/m/Y', strtotime($detail->tgl_diminta)) }}</td>
                        <td>{{ $detail->kts_permintaan }}</td>
                        <td>{{ $detail->kts_dipesan }}</td>
                        <td>{{ $detail->kts_diterima }}</td>
                        <td>{{ $detail->rincian->status_permintaan }}</td>
                    </tr>
                    @php
                        $total_kts_permintaan += $detail->kts_permintaan;
                        $total_kts_dipesan += $detail->kts_dipesan;
                        $total_kts_diterima += $detail->kts_diterima;
                    @endphp
                @endforeach
                
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td>{{ $total_kts_permintaan }}</td>
                    <td>{{ $total_kts_dipesan }}</td>
                    <td>{{ $total_kts_diterima }}</td>
                    <td style="background-color: #f0f0f0;"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-export.pdf>