<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Faktur</th>
                <th>Tgl. Faktur</th>
                <th>Keterangan</th>
                <th>Jumlah Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $pemasok)
                <tr class="group-header">
                    <td colspan="5">
                        {{ $pemasok->pemasok_id }} - {{ $pemasok->nama }}
                    </td>
                </tr>

                @php $total = 0; @endphp
                @foreach($pemasok->fakturPembelian as $faktur)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $faktur->no_faktur }}</td>
                        <td>{{ $faktur->tgl_faktur }}</td>
                        <td>{{ $faktur->deskripsi_faktur }}</td>
                        <td>{{ $faktur->sub_total }}</td>
                    </tr>

                    @php $total += $faktur->sub_total; @endphp
                @endforeach

                <tr class="total-row">
                    <td colspan="4">Total</td>
                    <td>{{ $total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-export.pdf>