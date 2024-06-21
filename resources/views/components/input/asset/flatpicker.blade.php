@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.querySelectorAll('input[type=time]')?.forEach((input) => {
            flatpickr(input, {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
        })
        document.querySelectorAll('input[type=date]')?.forEach((input) => {
            var config = {
                dateFormat: "Y-m-d",
            };
            const range = input.getAttribute('range')
            if(range){
                config.mode = "range"
            }
            flatpickr(input, config);
        })

        document.querySelectorAll('.date-range input')?.forEach((input) => {
            flatpickr(input, {
                dateFormat: "Y-m-d",
                mode : "range"
            });
        })
    </script>
@endpush
