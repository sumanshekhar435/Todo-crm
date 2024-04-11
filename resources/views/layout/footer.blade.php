 <!-- Main Footer -->
 <footer class="main-footer">
     <!-- To the right -->
     <div class="float-right d-none d-sm-inline">
         Anything you want
     </div>
     <!-- Default to the left -->
     <strong>Copyright &copy; 2014-2024 <a href="{{ route('home') }}">Mini-CRM</a>.</strong> All rights reserved.
 </footer>
 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->

 <!-- jQuery -->
 <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
 {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
 <!-- Bootstrap 4 -->
 <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
 <!-- Select2 -->
 <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

 <script>
     $('.dropdown-btn').on('click', function() {
         console.log('hello code!');
         var dropdown = $('.dropdown-menu');
         console.log(dropdown);
         if (dropdown.css('display') === 'block') {
             dropdown.css('display', 'none')
         } else {
             dropdown.css('display', 'block')
         }
     });
 </script>
