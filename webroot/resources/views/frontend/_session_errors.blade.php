@if( isset($errors) && $errors->has())
  <script>
      $(document).ready(function(){
          @foreach ($errors->all() as $error)
              showNotification("{{ $error }}", "body", "danger", "top", "right", "auto", null, true);
          @endforeach
      });
    </script>
@endif