<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Barang</th>
                <th>Deskripsi Barang</th>
                <th>Kuantitas</th>
                <th>Kts. Faktur</th>
                <th>No. Faktur</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $penerimaan)
                <tr class="group-header">
                    <td colspan="7">
                        <span class="group-space">{{ $penerimaan->no_penerimaan }}</span>
                        <span class="group-space">{{ $penerimaan->tgl_penerimaan }}</span>
                        <span class="group-space">{{ $penerimaan->pemasok_penerimaan }}</span>
                        <span class="group-space">{{ $penerimaan->status_penerimaan }}</span>
                    </td>
                </tr>

                @php
                    $total_kts_penerimaan = 0;
                    $total_kts_faktur = 0;
                @endphp
                @foreach($penerimaan->detail as $i => $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $detail->no_barang }}</td>
                        <td>{{ $detail->deskripsi_barang }}</td>
                        <td>{{ $detail->kts_penerimaan }}</td>
                        <td>{{ $detail->kts_faktur }}</td>
                        <td>
                            @if ($penerimaan->faktur->isNotEmpty())
                            {{ $penerimaan->faktur[0]->rincian->no_faktur }}
                            @endif
                        </td>
                        <td>{{ $penerimaan->status_penerimaan }}</td>
                    </tr>
                    @php
                        $total_kts_penerimaan += $detail->kts_penerimaan;
                        $total_kts_faktur += $detail->kts_faktur;
                    @endphp
                @endforeach 
                
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td>{{ $total_kts_penerimaan }}</td>
                    <td>{{ $total_kts_faktur }}</td>
                    <td colspan="2"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-export.pdf>