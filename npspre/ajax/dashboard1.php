<?php require_once("inc/init.php"); ?>       

       <section id="widget-grid1">
        <!-- row -->
        <div class="row">
            <!-- SINGLE GRID -->
            <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-0">
					<header>
						<h2><span class="glyphicon glyphicon-dashboard"></span> OVERALL NPS</h2>
					</header><!-- widget div-->
					<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
						</div><!-- end widget edit box -->
					<div id="overall">
					</div>
				</div>
            </article><!-- END GRID -->
			
			<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-1">
					<header>
						<h2><span class="glyphicon glyphicon-stats"></span> Weekly Trend</h2>
					</header><!-- widget div-->
					<div>
						<!-- widget edit box -->
						<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
						</div><!-- end widget edit box -->
						<!-- widget content -->
						<div id="weekly" class="widget-body" style="height: 400px">
						</div><!-- end widget content -->
					</div>
				</div><!-- end widget div -->
			<!-- end widget -->
			</article>
            <!-- SINGLE GRID -->
        </div><!-- end row -->
    </section><!-- end widget grid -->

	<section id="widget-grid2">
        <!-- row -->
        <div class="row">
            <!-- SINGLE GRID -->
            <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-3">
					<header>
						<h2><span class="glyphicon glyphicon-stats"></span> Level 1</h2>
					</header><!-- widget div-->
					<div id="level2">
					</div>
				</div>
            </article><!-- END GRID -->
			
			<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-4">
					<header>
						<h2><span class="glyphicon glyphicon-stats"></span> Weekly Trend for Level 1</h2>
					</header><!-- widget div-->
					<div>
						<!-- widget edit box -->
						<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
						</div><!-- end widget edit box -->
						<!-- widget content -->
						<div id="weekly2" class="widget-body" style="height: 400px">
						</div><!-- end widget content -->
					</div>
				</div><!-- end widget div -->
			<!-- end widget -->
			</article>
            <!-- SINGLE GRID -->
        </div><!-- end row -->
    </section><!-- end widget grid -->
	
	
	<section id="widget-grid3">
        <!-- row -->
        <div class="row">
            <!-- SINGLE GRID -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-5">
					<header>
						<h2><span class="glyphicon glyphicon-stats"></span> Level 2</h2>
					</header><!-- widget div-->
					<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
						</div><!-- end widget edit box -->
					<div id="lev3">
					</div>
				</div>
            </article><!-- END GRID -->
			
		</div><!-- end row -->
    </section><!-- end widget grid -->
<!-- end widget grid -->

  

<script type="text/javascript">
	
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){ 
	 *  loadScript(".../plugin.js", run_after_loaded);	
	 * }
	 * 
	 * OR you can load chain scripts by doing
	 * 
	 * loadScript(".../plugin.js", function(){
	 * 	 loadScript("../plugin.js", function(){
	 * 	   ...
	 *   })
	 * });
	 */
	
	// pagefunction
	
	var str="&date_range=9999&channel=&queues=&site=";
	loadScript("/js/main/theme.js", function(){
		$("#widget-grid2").hide();
		$("#widget-grid3").hide();
		runmain(str);
		runtrend(str);
	});
	
	var pagefunction = function() {
		
		
	
	};
	
	// end pagefunction
	
	// run pagefunction
	pagefunction();
</script>
