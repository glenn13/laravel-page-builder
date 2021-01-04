<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    window.customConfig = {
        assetManager: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    };
</script>