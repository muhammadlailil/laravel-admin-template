@push('js')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        setTimeout(() => {
            document.querySelectorAll(".tom-select").forEach((e) => {
                window[`select_${e.getAttribute("name")}`] = new TomSelect(e);
            });
        }, 500)
    </script>
@endpush
