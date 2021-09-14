<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="{{asset('/')}}vendor/global/global.min.js"></script>
<script src="{{asset('/')}}vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
@yield('js')
<script src="{{asset('/')}}js/custom.min.js"></script>
<script src="{{asset('/')}}js/dlabnav-init.js"></script>
<!-- <script>
jQuery(document).ready(function() {
    setTimeout(function() {
        dezSettingsOptions.version = 'dark';
        new dezSettings(dezSettingsOptions);
    }, 500)
});
</script> -->