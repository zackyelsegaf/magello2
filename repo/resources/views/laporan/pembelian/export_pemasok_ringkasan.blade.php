<x-export.pdf :title="$title" :tanggal-awal="$tanggal['from']" :tanggal-akhir="$tanggal['to']">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemasok</th>
                <th>Jumlah Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($data as $i => $pemasok)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $pemasok->nama }}</td>
                    <td>{{ $pemasok->jumlah }}</td>
                </tr>
                @php $total += $pemasok->jumlah; @endphp
            @endforeach
            <tr class="group-header">
                <td colspan="2">Total</td>
                <td>{{ $total }}</td>
            </tr>
        </tbody>
    </table>
</x-export.pdf>