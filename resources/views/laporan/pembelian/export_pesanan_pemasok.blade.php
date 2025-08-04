<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
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
                <tr class="group-header">
                    <td colspan="7">
                        {{ $pemasok->pemasok_id }} - {{ $pemasok->nama }}
                    </td>
                </tr>

                @foreach($pemasok->pesananPembelian as $pesanan)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pesanan->no_pesanan }}</td>
                        <td>{{ $pesanan->tgl_pesanan }}</td>
                        <td>{{ $pesanan->tgl_perkiraan }}</td>
                        <td>{{ $pesanan->deskripsi }}</td>
                        <td>{{ $pesanan->status_pesanan }}</td>
                        <td>{{ number_format($pesanan->sub_total) }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</x-export.pdf>