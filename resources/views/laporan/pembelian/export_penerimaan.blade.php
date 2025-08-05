<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Faktur Pembelian</th>
                <th>No. Penerimaan</th>
                <th>Tgl. Penerimaan</th>
                <th>Keterangan</th>
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

                @foreach($pemasok->penerimaanPembelian as $penerimaan)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{-- $penerimaan->no_faktur --}}</td>
                        <td>{{ $penerimaan->no_penerimaan }}</td>
                        <td>{{ $penerimaan->tgl_penerimaan }}</td>
                        <td>{{ $penerimaan->deskripsi_penerimaan }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</x-export.pdf>