<script type="text/javascript" src="{{ asset('frontend/assets/js/all.min.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.all.min.js"></script>

@if(Session::has('message'))
    <script>
        $(document).ready(function(){
            Swal.fire("{{Session::get('message')}}");
        });
    </script>
@endif
@if(Session::has('success'))
    <script>
        $(document).ready(function(){
            Swal.fire(
          "{{Session::get('success')}}",
          '',
          'success'
          )
        });
    </script>
@endif
@if(Session::has('error'))
    <script>
        $(document).ready(function(){
            Swal.fire(
          "{{ Session::get('error') }}",
          '',
          'error'
          )
        });

    </script>
@endif
