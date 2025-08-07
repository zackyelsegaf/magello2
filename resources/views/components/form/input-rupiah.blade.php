@props(['name', 'value' => '', 'class' => '', 'style' => '', 'placeholder' => ''])

<input type="text" name="{{ $name }}" value="{{ $value }}"
    class="form-control input-rupiah {{ $class }}" style="{{ $style }}" placeholder="{{ $placeholder }}"
    autocomplete="off" />

@once
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const formatRupiah = (angka) => {
                    let number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        let separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                    return rupiah;
                };

                document.querySelectorAll('.input-rupiah').forEach(function(input) {
                    input.addEventListener('input', function() {
                        let cursorPos = input.selectionStart;
                        input.value = formatRupiah(input.value);
                        input.setSelectionRange(cursorPos, cursorPos);
                    });
                });
            });
        </script>
@endonce