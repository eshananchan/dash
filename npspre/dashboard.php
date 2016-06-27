<?php require_once("inc/init.php"); ?>


        

       <section id="widget-grid">
        <!-- row -->
        <div class="row">
            <!-- SINGLE GRID -->
            <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-0">
					<header>
						<h2><span class="glyphicon glyphicon-dashboard"></span> OVERALL NPS</h2>
					</header><!-- widget div-->
					<div id="overall">
					</div>
				</div>
            </article><!-- END GRID -->
			
			<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-1">
					<header>
						<h2> Weekly Trend</h2>
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
						<h2><span class="glyphicon glyphicon-dashboard"></span> Level 1</h2>
					</header><!-- widget div-->
					<div id="level2">
					</div>
				</div>
            </article><!-- END GRID -->
			
			<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-4">
					<header>
						<h2> Weekly Trend</h2>
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
            <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="jarviswidget" id="wid-id-5">
					<header>
						<h2><span class="glyphicon glyphicon-dashboard"></span> LEVEL 2</h2>
					</header><!-- widget div-->
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
	
	loadScript("js/highcharts/highcharts.js", function(){
			loadScript("js/main/theme.js", function(){
				$("#widget-grid2").hide();
				runmain();
				runtrend();
				});
	});
	
	 var overall={
              chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: 0,
                     plotShadow: false,
					 backgroundColor:null,
                     renderTo:"overall"
              },
              series:[{
                     type:'pie',
                     name: 'NPS',
                     innerSize: '30%',
                     data:[]
              }],
              title:{
                     text: "<b>OVERALL NPS</b>",
                     fontWeight:"bold"                        
                     },
              subtitle: {
              //text: "NPS<br><b>"+score+"</b>",
                     align: 'center',
                     verticalAlign: 'middle',
                     y:70,
                     style:{
                            fontWeight:"bold",
                            fontSize:"15px"
                     }
              },
              tooltip: {
                     pointFormat: '<b>{point.percentage:.1f}%</b>'
              },
              legend:{
                     enabled:true
              },
              plotOptions: {
                  pie: {
                     dataLabels: {
                            enabled: true,
                            distance: -50,
                            style: {
                                   fontSize: '15px',
                                   fontWeight: 'bold',
                                   color: 'white',
                                   textShadow: '0px 1px 2px black'
                                   }
                     },
                     allowPointSelect: true,
                     cursor: 'pointer',
                     startAngle: -90,
                     endAngle: 90,
                     center: ['50%', '75%'],
                     point: {
                                     events: {
                                          click: function(event) {
                                                 // store point options, `this` reffers the clicked point
                                                 var options = this.options;

                                                 if (options.name=="Promoters") {
                                                        ngraph("npsdatal2.php?type=L1Pro",options.name);
                                                        wdata("npsdatal2.php?type=L1TimePro",options.name);
														$("#widget-grid2").show();
                                                        $("#widget-grid3").hide("slow");
                                                 }
                                                 else if (options.name=="Passives") {
                                                        ngraph("npsdatal2.php?type=L1Pas",options.name);
                                                        wdata("npsdatal2.php?type=L1TimePas",options.name);
														$("#widget-grid2").show();
                                                        $("#widget-grid3").hide("slow");
                                                 }
                                                 else if (options.name=="Detractors"){
                                                        ngraph("npsdatal2.php?type=L1Det",options.name);
                                                        wdata("npsdatal2.php?type=L1TimeDet",options.name);
														$("#widget-grid2").show();
                                                        $("#widget-grid3").hide("slow");
                                                 }
                                          }
                                   }       
                            }
                     }
              },
              credits: {
              enabled: false
              }
        }
		
		function runmain() {
			$.getJSON("npsdata.php?type=s1", function(json) {
			//$.getJSON("s1.php", function(json) {
				   var str= json[0].toString();
				  // console.log(str);
				   score = str.replace(","," <br>");
				   overall.subtitle.text = score;
				   overall.series[0].data[0] = json[1];
				   overall.series[0].data[1] = json[2];
				   overall.series[0].data[2] = json[3];
				   chart = new Highcharts.Chart(overall);
			});
	    }
		
		var weekly = {
              chart: {
                     type: 'line',
                     renderTo: 'weekly',
					 backgroundColor:null
              },
              title: {
                     text: 'TREND CHART',
                     x: 20 //center
              },
              xAxis: {
                     categories: []
              },
              tooltip: {
                     valueSuffix:"%"
              },
              yAxis: {
					title: {
						text: 'Percentages'
					}
              },
              credits:{
                     enabled:false
              },
              legend: {
                     layout: 'horizontal',
                     align: 'center',
                     verticalAlign: 'bottom',
                     borderWidth: 0
              },
              series: []
		}
	
		function runtrend() {
           // $.getJSON("s2.php", function(json) {     
			$.getJSON("npsdata.php?type=s2", function(json) {
				  weekly.xAxis.categories = json[0]['data'];
				  weekly.series[0] = json[1];
				  weekly.series[1] = json[2];
				  weekly.series[2] = json[3];
				  weekly.series[3] = json[4];
				  chart = new Highcharts.Chart(weekly);
		   });
        }

		function ngraph(json1,name){ 
              $.getJSON(json1, function(json) {
                     level1.series[0].data = json;
                     level1.title.text="<b>Level 1: "+name+"</b>";
                     
                     Highcharts.setOptions({
                            colors: ['#80ff80','#9966ff', '#0099ff', '#FFF263', '#6AF9C4']
                     });
                     lev2 = new Highcharts.Chart(level1);
              });
              var level1 = {
                     chart: {
                            renderTo: 'level2',
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
							backgroundColor:null
                     },
                     title: {
                            fontWeight:"bold"
                            },
                     tooltip: {
                            formatter: function() {
                                   pc=this.percentage;
                                   pc=pc.toFixed(2);
                                   return '<b>'+ this.point.name +'</b>: '+ pc +' %';
                            }
                     },
                     plotOptions: {
                            pie: {
                                   allowPointSelect: true,
                                   cursor: 'pointer',
                                   dataLabels: {
                                          enabled: true,
                                          distance: -80,
                                       //color: '#000000',
                                          connectorColor: '#000000',
                                          formatter: function() {
                                                 pc=this.percentage;
                                                 pc=pc.toFixed(2);
                                                 return '<b>'+ this.point.name +'</b>';
                                          },
                                          style: {
                                                 fontSize: '15px',
                                                 fontWeight: 'bold',
                                                 color: 'white',
                                                 textShadow: '0px 1px 2px black'
                                          }
                                   },
                                   point: {
                                          events: {
                                                 click: function(event) {
                                                        // store point options, `this` reffers the clicked point
                                                        var options = this.options;
                                                        //console.log(options.name);
                                                        if (name=="Promoters" && options.name=="People") {
                                                               level2("npsdata.php?level=top10&ppd=promoters&L1=people",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Promoters" && options.name=="Product") {
                                                               level2("npsdata.php?level=top10&ppd=promoters&L1=product",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Promoters" && options.name=="ProcessPolicy") {
                                                               level2("npsdata.php?level=top10&ppd=promoters&L1=processpolicy",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Passives" && options.name=="People") {
                                                               level2("npsdata.php?level=top10&ppd=passives&L1=people",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Passives" && options.name=="Product") {
                                                               level2("npsdata.php?level=top10&ppd=passives&L1=product",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Passives" && options.name=="ProcessPolicy") {
                                                               level2("npsdata.php?level=top10&ppd=passives&L1=processpolicy",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Detractors" && options.name=="People") {
                                                               level2("npsdata.php?level=top10&ppd=detractors&L1=people",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Detractors" && options.name=="Product") {
                                                               level2("npsdata.php?level=top10&ppd=detractors&L1=product",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        }
                                                        else if (name=="Detractors" && options.name=="ProcessPolicy") {
                                                               level2("npsdata.php?level=top10&ppd=detractors&L1=processpolicy",options.name,name);
                                                               $("#widget-grid3").show("slow");
                                                        } 
                                                 }
                                          }
                                   }
                            }
                     },
                     credits:{
                            enabled:false,
                     },
                     series: [{
                            type: 'pie',
                            name: 'Level 2 Data',
                            data: []
                     }]
              }
       }
        
       function wdata(json2,name) {
              $.getJSON(json2, function(json) {
                     wdata2.xAxis.categories = json[0]['data'];
                     wdata2.series[0] = json[1];
                     wdata2.series[1] = json[2];
                     wdata2.series[2] = json[3];
                     
                     wdata2.title.text="<b>Level 1 Percentages for "+name+"</b>";
                     
                     Highcharts.setOptions({
                            colors: ['#80ff80', '#0099ff', '#9966ff', '#FFF263', '#6AF9C4']
                     });
                     wdat2 = new Highcharts.Chart(wdata2);
              });
              var wdata2= {
                     chart: {
                            type: 'line',
                            renderTo: 'weekly2',
							backgroundColor:null
                     },
                     title: {
                            x: 20 //center
                     },
                     tooltip: {
                            valueSuffix:"%"
                     },
                     xAxis: {
                            categories: []
                     },
                     yAxis: {
                            title: {
                                   text: 'Percentages'
                            },
                            plotLines: [{
                                   width: 2,
                                   color: '#808080'
                            }]
                     },
                     credits:{
                            enabled:false
                     },
                     legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom',
                            borderWidth: 0
                     },
                     series: []
              }
       }
       
       function level2(json3,l1,l2) {
              $.getJSON(json3, function(json) {
                     Highcharts.setOptions({
                            colors: ['#64E572','#FFF263', '#ff4d4d', '#0033cc']
                     });
                     level2.xAxis.categories = json[0]['data'];
                     level2.series[0] = json[1];
                     level2.series[1] = json[2];
                     level2.series[2] = json[3];
                     level2.title.text="TOP 10 "+l2+" for "+l1;
                     
                     levl2 = new Highcharts.Chart(level2);
              });
              
              var level2 = {
                     chart: {
                            renderTo: 'lev3',
                            type: 'column',
                            marginRight: 100,
                            marginBottom: 120,
							backgroundColor:null
                     },
                     title: {
                            x: 0 //center
                     },
                     subtitle: {
                            text: '',
                            x: -20
                     },
                     xAxis: {
                            title:{
                                   text: 'Customer Comments'
                            },
                            categories: []
                     },
                     yAxis: {
                            title: {
                                   text: 'Samples'
                            },
                            plotLines: [{
                                   value: 0,
                                   width: 1,
                                   color: '#808080'
                            }]
                     },
                     tooltip: {
                            formatter: function() {
                                   return '<b>'+ this.series.name +'</b><br/>'+
                                   this.x +': '+ this.y;
                            }
                     },
                     legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'right',
                            x: 10,
                            y: 100,
                            borderWidth: 0
                     },
                     credits:{
                            enabled:false,
                     },
                     series: []
              }              
       }

	
	var pagefunction = function() {
		// clears the variable if left blank
	};
	
	// end pagefunction
	
	// run pagefunction
	pagefunction();
	
</script>
