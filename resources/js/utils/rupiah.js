export function parseRupiahToFloat(rupiahString) {
    if (typeof rupiahString !== 'string') return 0;

    const cleaned = rupiahString.replace(/\./g, '').replace(',', '.').replace(/[^0-9.]/g, '');
    const parsed = parseFloat(cleaned);

    return isNaN(parsed) ? 0 : parsed;
}

export function formatInputRupiah(value) {
    let number_string = value.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
}

export function formatRupiah(angka) {
    if (typeof angka !== 'number') {
        angka = parseFloat(angka);
    }
    if (isNaN(angka)) return '0,00';

    // Fixed 2 digit desimal
    let parts = angka.toFixed(2).split('.');
    let integerPart = parts[0];
    let decimalPart = parts[1];

    let sisa = integerPart.length % 3;
    let rupiah = integerPart.substr(0, sisa);
    let ribuan = integerPart.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah + ',' + decimalPart;
}

// Auto-format untuk input class .input-rupiah
export function registerRupiahFormatter() {
    document.addEventListener("input", function (e) {
        if (e.target.classList.contains('input-rupiah')) {
            let cursor = e.target.selectionStart;
            e.target.value = formatInputRupiah(e.target.value);
            e.target.setSelectionRange(cursor, cursor);
        }
    });
}