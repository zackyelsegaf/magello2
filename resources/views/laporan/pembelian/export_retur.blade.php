<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Retur</th>
                <th>Tgl. Retur</th>
                <th>No. Faktur</th>
                <th>Keterangan</th>
                <th>Nilai Retur</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $pemasok)
                <tr class="group-header">
                    <td colspan="6">
                        {{ $pemasok->pemasok_id }} - {{ $pemasok->nama }}
                    </td>
                </tr>

                @foreach($pemasok->returPembelian as $retur)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $retur->no_retur }}</td>
                        <td>{{ $retur->tgl_retur }}</td>
                        <td>{{ $retur->no_faktur }}</td>
                        <td>{{ $retur->deskripsi }}</td>
                        <td>{{ $retur->jumlah }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</x-export.pdf>