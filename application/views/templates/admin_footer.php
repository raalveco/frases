<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">Ã</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://usman.it" target="_blank">Muhammad Usman</a> 2012</p>
			<p class="pull-right">Powered by: <a href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
		</footer>
		
	</div><!--/.fluid-container-->
	<?php
		$this->config->load('config'); 
		$base_url = $this->config->item('base_url');
	?>
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="<?= $base_url ?>js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?= $base_url ?>js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?= $base_url ?>js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?= $base_url ?>js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?= $base_url ?>js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?= $base_url ?>js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?= $base_url ?>js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?= $base_url ?>js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?= $base_url ?>js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?= $base_url ?>js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?= $base_url ?>js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?= $base_url ?>js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?= $base_url ?>js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?= $base_url ?>js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?= $base_url ?>js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?= $base_url ?>js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?= $base_url ?>js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?= $base_url ?>js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="<?= $base_url ?>js/excanvas.js"></script>
	<script src="<?= $base_url ?>js/jquery.flot.min.js"></script>
	<script src="<?= $base_url ?>js/jquery.flot.pie.min.js"></script>
	<script src="<?= $base_url ?>js/jquery.flot.stack.js"></script>
	<script src="<?= $base_url ?>js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="<?= $base_url ?>js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?= $base_url ?>js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?= $base_url ?>js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?= $base_url ?>js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?= $base_url ?>js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?= $base_url ?>js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?= $base_url ?>js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?= $base_url ?>js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?= $base_url ?>js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?= $base_url ?>js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?= $base_url ?>js/jquery.history.js"></script>
</body>
</html>
