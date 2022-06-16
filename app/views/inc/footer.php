	</div>
	<!-- END #app -->

	<!-- ================== BEGIN core-js ================== -->
	<script src="<?php echo URLROOT; ?>/public/assets/js/vendor.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->

	<!-- <script src="<?php echo URLROOT; ?>/public/assets/js/demo/dashboard.js"></script> -->
	<!-- ================== END page-js ================== -->

	<!-- ================== BEGIN page-js ================== -->
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/moment/min/moment.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/select-picker/dist/picker.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/js/demo/form-plugins.demo.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/assets/js/demo/render.highlight.js"></script>
	<!-- ================== END page-js ================== -->
	<script>
		var elem = document.body;

		/* When the openFullscreen() function is executed, open the video in fullscreen.
		Note that we must include prefixes for different browsers, as they don't support the requestFullscreen method yet */
		function openFullscreen() {
			if (elem.requestFullscreen) {
				elem.requestFullscreen();
			} else if (elem.webkitRequestFullscreen) {
				/* Safari */
				elem.webkitRequestFullscreen();
			} else if (elem.msRequestFullscreen) {
				/* IE11 */
				elem.msRequestFullscreen();
			}
		}
		elem.querySelector('#fullScreen').addEventListener('click', () => {
			console.log("clicked");
			openFullscreen();
		});

	</script>

<script>
    document.querySelector('.img_input').addEventListener('change', function(e) {
        console.log('file changed');
        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('.img_preview').setAttribute('src', e.target.result);
        }; 
        reader.readAsDataURL(e.target.files[0]);
    }); // change
</script>

	</body>

	</html>