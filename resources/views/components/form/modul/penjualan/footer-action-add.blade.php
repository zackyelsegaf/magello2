@isset($action)
    @php
        $renderedAttributes = trim($action);
    @endphp
@else
    @php
        $renderedAttributes = 'type="submit"';
    @endphp
@endisset

<div id="footerActionAddBar"
    style="
        position: fixed;
        bottom: 0;
        z-index: 1030;
        background: #fff;
        width: 100%;
        padding: 12px 24px;
        box-shadow: 0 -2px 6px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 8px;
        transition: all 0.3s ease;
    ">

    <div class="deskripsi d-flex justify-content-between align-items-center w-100"
        style="font-size: 14px; font-weight: bold;">

        <!-- Kiri -->
        <div class="form-group">
            <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1') }}</textarea>
        </div>

        <div style="max-width: 400px; font-size: 13px;">
            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                <label style="width: 90px; font-weight: bold;">Sub Total</label>
                <input type="text" name="subtotal" value="0" readonly
                    style="flex: 1; height: 26px; font-size: 12px;" class="form-control form-control-sm">
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                <label style="width: 90px; font-weight: bold;">Diskon</label>
                <div style="display: flex; align-items: center; flex: 1;">
                    <input type="text" name="cashdiscpc" value="0" maxlength="3"
                        style="width: 50px; height: 26px; font-size: 12px;" class="form-control form-control-sm">
                    <span class="mx-1">%</span>
                    <input type="text" name="cashdiscount" value="0"
                        style="flex: 1; height: 26px; font-size: 12px; margin-left: 4px;"
                        class="form-control form-control-sm">
                </div>
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                <label style="width: 90px; font-weight: bold;">PPN 11%</label>
                <input type="text" name="ppn" value="0" readonly
                    style="flex: 1; height: 26px; font-size: 12px;" class="form-control form-control-sm">
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                <label style="width: 90px; font-weight: bold;">Pajak 2</label>
                <input type="text" name="pajak2" value="0" readonly
                    style="flex: 1; height: 26px; font-size: 12px;" class="form-control form-control-sm">
            </div>

            <div style="display: flex; align-items: center;">
                <label style="width: 90px; font-weight: bold;">Jumlah</label>
                <input type="text" name="total" value="0" readonly
                    style="flex: 1; height: 26px; font-size: 12px; font-weight: bold;"
                    class="form-control form-control-sm">
            </div>
        </div>

    </div>

    <div class="action d-flex flex-wrap justify-content-start align-items-center">
        <button class="btn btn-secondary mr-2 mb-2">
            <i class="fas fa-arrow-left mr-1"></i>
            <span>Sebelumnya</span>
        </button>
        <button class="btn btn-secondary mr-2 mb-2">
            <i class="fas fa-arrow-right mr-1"></i>
            <span>Selanjutnya</span>
        </button>
        <div class="action d-flex flex-wrap justify-content-start align-items-center">
            <button {!! $renderedAttributes !!} class="btn btn-success mr-2 mb-2">
                <i class="fas fa-save mr-1"></i>
                <span>Simpan</span>
            </button>
        </div>
        <button class="btn btn-info mr-2 mb-2">
            <i class="fas fa-eye mr-1"></i>
            <span>Pratinjau</span>
        </button>
        <button class="btn btn-warning mr-2 mb-2">
            <i class="fas fa-shopping-cart mr-1"></i>
            <span>Pesanan Penjualan</span>
        </button>
        <button class="btn btn-danger mr-2 mb-2">
            <i class="fas fa-times mr-1"></i>
            <span>Batal</span>
        </button>
        <button class="btn btn-dark mr-2 mb-2">
            <i class="fas fa-clipboard-check mr-1"></i>
            <span>Audit</span>
        </button>
    </div>
</div>
