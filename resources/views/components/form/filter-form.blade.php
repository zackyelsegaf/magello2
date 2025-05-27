<div id="filterBox" class="col-md-3">
    <div class="card rounded-default p-3 bg-dark text-white">
        <form method="GET" action="{{ route('pembelian/permintaan/list/page') }}">
            <input type="hidden" name="filter" value="1">

            <div class="form-group">
                <label>Pencarian</label>
                <input type="text" name="no_barang" class="form-control" onchange="this.form.submit()"
                    placeholder="Cari berdasarkan ID" value="{{ request('no_barang') }}">
            </div>

            <div class="form-group">
                <input type="text" name="nama_barang" class="form-control" onchange="this.form.submit()"
                    placeholder="Nama Barang" value="{{ request('nama_barang') }}">
            </div>

            <div class="form-group">
                <label>Dihentikan</label><br>
                @foreach ([null => 'Semua', '1' => 'Ya', '0' => 'Tidak'] as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" onchange="this.form.submit()"
                            name="dihentikan" value="{{ $value }}"
                            {{ request('dihentikan') === (string) $value ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $label }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label>Tipe Barang</label>
                <select class="form-control" name="tipe_barang" onchange="this.form.submit()">
                    <option value="" selected></option>
                    @foreach ($tipe_barang as $items)
                        <option value="{{ $items->nama }}" {{ request('tipe_barang') == $items->nama ? 'selected' : '' }}>
                            {{ $items->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kategori Barang</label>
                <select class="form-control" name="kategori_barang" onchange="this.form.submit()">
                    <option value="" selected> Tipe Pelanggan </option>
                    @foreach ($kategori_barang as $items)
                        <option value="{{ $items->nama }}" {{ request('kategori_barang') == $items->nama ? 'selected' : '' }}>
                            {{ $items->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tipe Persediaan</label>
                <select class="form-control" name="tipe_persediaan" onchange="this.form.submit()">
                    <option value="" selected> Tipe Pelanggan </option>
                    @foreach ($tipe_persediaan as $items)
                        <option value="{{ $items->nama }}" {{ request('tipe_persediaan') == $items->nama ? 'selected' : '' }}>
                            {{ $items->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>