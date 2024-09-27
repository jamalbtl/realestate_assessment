<!DOCTYPE html>
<html lang="en">
    @include('includes.head')
  <body>
    <div class="container-scroller">
        @include('includes.header')
        <div class="container-fluid page-body-wrapper">
            @include('includes.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
                @include('includes.footer')
            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/template.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('assets/js/file-upload.js')}}"></script>
    <script src="{{asset('assets/js/typeahead.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>
    <!-- End custom js for this page-->
    @yield('footer-scripts')
  </body>
</html>