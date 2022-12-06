  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">KT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- Cdn DataTables -->

<script>
// function checkAll() {
//     $('input[class="item"]').each(function () {

//         if ($('input[class="ckeck-all"]:checked').length == 0) {
//             $(this).prop('checked', false);
//         } else {
//             $(this).prop('checked', true);
//         }
//     });
// }

// // perm delete
// $(document).on('click' , '.subdel' , function (){
//     $('#form').submit();
// });
</script>


<!-- Jquery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

{{-- <script src="{{URL::asset('js/dataTables.buttons.min.js')}}"></script> --}}
{{-- 
<script src="{{URL::asset('vendor/datatables/buttons.server-side.js')}}"></script> --}}
<!-- AdminLTE -->
<script src="{{URL::asset('dist/js/adminlte.js')}}"></script>


@stack('script')
@yield('script')
</body>
</html>
