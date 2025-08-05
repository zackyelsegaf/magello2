<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe Proses</th>
                <th>No. Faktur</th>
                <th>Tgl. Faktur</th>
                <th>Kuantitas</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $pesanan)
                <tr class="group-header">
                    <td colspan="5">
                        <span class="group-space">{{ $pesanan->no_pesanan }}</span>
                        <span class="group-space">{{ $pesanan->tgl_pesanan }}</span>
                        <span class="group-space">{{ $pesanan->status_pesanan }}</span>
                    </td>
                </tr>
                
                @if ($pesanan->faktur->isEmpty())
                    @foreach($pesanan->detail as $detail)
                        <tr>
                            <td rowspan="2">{{ $no++ }}</td>
                            <td colspan="4" class="total-row">
                                <span class="group-space">{{ $detail->barang->nama_barang }}</span>
                                <span class="group-space">{{ $detail->kts_pesanan .' '. $detail->satuan }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $detail->kts_pesanan }}</td>
                        </tr>
                    @endforeach 
                @else
                    @foreach($pesanan->faktur as $faktur)
                        <tr>
                            <td rowspan="2">{{ $no++ }}</td>
                            <td colspan="4" class="total-row">
                                <span class="group-space">{{ $faktur->barang->nama_barang }}</span>
                                <span class="group-space">{{ $faktur->kts_faktur .' '. $faktur->satuan }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Faktur Pembelian</td>
                            <td>{{ $faktur->rincian->no_faktur }}</td>
                            <td>{{ $faktur->rincian->tgl_faktur }}</td>
                            <td>{{ $faktur->kts_faktur }}</td>
                        </tr>
                    @endforeach 
                @endif
            @endforeach
        </tbody>
    </table>
</x-export.pdf>