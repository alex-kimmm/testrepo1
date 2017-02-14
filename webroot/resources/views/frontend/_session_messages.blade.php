@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        $(document).ready(function(){
            showNotification("{{ \Illuminate\Support\Facades\Session::get('error') }}", "body", "danger", "top", "right", "auto", null, true);
        });
    </script>
@endif

@if(\Illuminate\Support\Facades\Session::has('success'))
    <script>
        $(document).ready(function(){
            showNotification("{{ \Illuminate\Support\Facades\Session::get('success') }}", "body", "success", "top", "right", "auto", null, true);
        });
    </script>
@endif