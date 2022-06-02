<!-- Footer -->
<footer class="site-footer">
  <div class="row">
    <div class="col-md-6">
      <p class="text-center text-md-left">Copyright © 2019 <a href="#">Urban Enigma</a>. All rights reserved.</p>
    </div>

    <div class="col-md-6">
    </div>
  </div>

</footer>
<!-- END Footer -->

</main>
<!-- END Main container -->



<!-- Global quickview -->
<div id="qv-global" class="quickview" data-url="../assets/data/quickview-global.html">
  <div class="spinner-linear">
    <div class="line"></div>
  </div>
</div>
<!-- END Global quickview -->



<!-- Scripts -->
<script src="{{ asset('js/core.min.js') }}" data-provide="sweetalert"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@if(in_array( \Request::route()->getName() ,[ 'admin.product.edit','admin.product.add' ]))
   <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script> 
  <script>
		CKEDITOR.replace('product_description');
  </script>
@endif
@yield('script')
</body>
</html>
