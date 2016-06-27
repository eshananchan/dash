//var str1="9999";
var str2="";
var str3="";
var str4="";

$('#range').daterangepicker({
        autoApply: true,
        linkedCalendars: false,
        ranges: {
           //'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Default View':[moment().subtract(30, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'This Quarter':[moment().startOf('quarter'),moment().endOf('quarter')],
           'Over All':[moment("2015-11-10"),moment()]
           
        }
    },cb);
    
    function cb(start,end) {
       $('#range span').html(start.format('MM-DD-YY') + ' - ' + end.format('MM-DD-YY'));
      // console.log("Start: "+start.format('YYYY-MM-DD'));
      // console.log("End: "+end.format('YYYY-MM-DD'));
       str1="&start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');
       str=str1+"&channel="+str2+"&queues="+str3+"&site="+str4;
       //console.log("STR: "+str);
    }
/*
$("#s1").change(function(){
       str1= $(this).find(":selected").val();
       str="&date_range="+str1+"&channel="+str2+"&queues="+str3+"&site="+str4;
       console.log("STR: "+str);
});*/

$("#s2").change(function(){
       str2= $(this).find(":selected").val();
       str=str1+"&channel="+str2+"&queues="+str3+"&site="+str4;
      // console.log("STR: "+str);
});

$("#s3").change(function(){
       str3= $(this).find(":selected").val();
       str=str1+"&channel="+str2+"&queues="+str3+"&site="+str4;
      // console.log("STR: "+str);
});

$("#s4").change(function(){
       str4= $(this).find(":selected").val();
       str=str1+"&channel="+str2+"&queues="+str3+"&site="+str4;
     //  console.log("STR: "+str);
});

$("#pas").click(function(){
        $("#widget-grid2").hide();
        $("#widget-grid3").hide();
        runmain(str);
        runtrend(str);
});

var overall={
              chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: 0,
                     plotShadow: false,
                     backgroundColor:null,
                     renderTo:"overall",
                     options3d: {
                         enabled: true,
                         alpha: 30,
                         beta:0
                     }
			},
              series:[{
                     type:'pie',
                     name: 'NPS',
                     innerSize: '30%',
                     data:[]
              }],
              title:{
                      text: " ",
                      fontWeight:"bold"                        
               },
              subtitle: {
              //text: "NPS<br><b>"+score+"</b>",
                     align: 'center',
                     verticalAlign: 'middle',
                     y:40,
                     style:{
                            fontWeight:"bold",
                            fontSize:"16px",
                            color:"white",
                            textShadow: '0px 1px 1px black'
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
                            color:'white',
                            style: {
                                   fontSize: '14px',
                                   fontWeight: 'bold',
                                   textShadow: '0px 1px 2px black'
                                   }
                     },
                     depth: 45,
                     allowPointSelect: true,
                     cursor: 'pointer',
                     startAngle: -90,
                     endAngle: 90,
                     center: ['50%', '60%'],
                     point: {
                                     events: {
                                          click: function(event) {
                                                 // store point options, `this` refers the clicked point
                                                 var options = this.options;
     
                                                 if (options.name=="Promoters") {
                                                        l1pie("npsdatal2_new.php?type=L1Pro"+str,options.name);
                                                        l1week("npsdatal2_new.php?type=L1TimePro"+str,options.name);
                                                        
                                                 }
                                                 else if (options.name=="Passives") {
                                                        l1pie("npsdatal2_new.php?type=L1Pas"+str,options.name);
                                                        l1week("npsdatal2_new.php?type=L1TimePas"+str,options.name);
                                                 }
                                                 else if (options.name=="Detractors"){
                                                        l1pie("npsdatal2_new.php?type=L1Det"+str,options.name);
                                                        l1week("npsdatal2_new.php?type=L1TimeDet"+str,options.name);
                                                 }
                                                 $("#widget-grid2").show();
                                                 $("#widget-grid3").hide("slow");
                                                 sc('widget-grid2');
                                                // $("#help1").hide("slow");
                                                // $("#help2").show("slow");
                                          }
                                   }       
                            }
                     }
              },
              credits: {
              enabled: false
              }
        }
	   
	function runmain(str) {
		   $.getJSON("npsdata_new.php?type=s1"+str, function(json) {
				Highcharts.setOptions({
                            colors: ['#64E572','#FFF263', '#ff4d4d', '#0033cc']
                     });
				  var str= json[0].toString();
				 
				  score = str.replace(","," <br>");
				  //overall.title.text = score;
				  overall.subtitle.text = score;
                  
                  if (json[1]) {
                            overall.series[0].data[0] = json[1];
                            overall.series[0].data[1] = json[2];
                            overall.series[0].data[2] = json[3];
                            chart = new Highcharts.Chart(overall);
                           // console.log("HI");
                  }
                  else
                  $("#overall").html("<center><h1>NO DATA FOUND</h1><center></br><center><h4>Please select a different filter!</h4></center>");
				  
		   });
	   }
	   
	var stacked= {
        chart: {
			renderTo: 'weekly',
			backgroundColor:null
			// type:"column",
			/*
			options3d: {
				enabled: true,
				alpha: 0,
				beta: 0,
				depth: 50,
				viewDistance: 0
			}*/
        },
        legend:{
              enabled:true,
              itemStyle:{
                          color:"white",
                          fontWeight:"bold"
                      }
        },
        title: {
                text: '',
                x: 10,
                y:20//center
        },
        xAxis: {
                categories: [],
                crosshair: true,
                labels:{
                        style:{
                            color:"white"
                        }	
                }
        },
        yAxis: [{
					title: {
							text: 'Percentages',
									x:-10,
									style:{
											color:"white"
									}
					},
					min: 0,
					max:100,
					reversedStacks:true,
					gridLineColor: 'rgba(153, 153, 153,0.10)',
					labels:{
							style:{
									color:"white"
							}   
					},      
                },{
					title:{
							text:"NPS",
							style:{
									color:"white"
							}
					},
					labels:{
							style:{
								color:"white",
							}
					},
					//linkedTo:1,
					gridLineColor: 'rgba(153, 153, 153, 0.05)',
					alignTicks: false,
					//min:-25,
					//max:45,
					opposite: true
		}],
		tooltip: {
				formatter: function () {
						var s = '<b>' + this.x + '</b>';
		
						$.each(this.points, function () {
								if (this.series.name== "NPS") {
										s += '<br/><span style="color:'+this.point.color+'">\u25CF</span><b> ' + this.series.name + '</b>: <b>' + this.y + '</b>';
								}
								else{
										s += '<br/><span style="color:'+this.point.color+'">\u25CF</span> ' + this.series.name + ': <b>' + this.y + '%</b>';
								}
						});
						return s;
				},
				shared: true	   
		},       
		plotOptions: {
				series: {
					stacking: 'normal',
					y:10,
					lineWidth: 5,
					marker:{
							enabled:true,
							radius:6
					},
					dataLabels: {
							enabled: true,
                            //color:'white',
                            style:{
                                   fontWeight:"bold"
                            }
							
					}
				}
		},
		series:[],
		credits:{
				enabled:false,
		}
	}    
	
	var flag;
	function runtrend(str) {
		if (flag==1) {
			//stak.series[0].setData([]);
            while(stak.series.length > 0) {
						stak.series[0].remove(true);
						//console.log("CLEARING");
						while (stacked.series.length>0) {
                            stacked.series.pop();
                        }
			}
}
			
	   $.getJSON("npsdata_new.php?type=s2"+str, function(json) {
		
              Highcharts.setOptions({
                              colors: ['#64E572','#FFF263', '#ff4d4d', '#2b11d1']
                       });
              stacked.xAxis.categories = json[0]['data']; //overall cat
               //console.log("JSON DATA: "+json[0]['data']);
               /*
                for(i=0;i<(json.length-1);i++){
                 stacked.series['i'].name = json[i+1]['name']; 
                 stacked.series['i'].type = json[i+1]['type'];
                 stacked.series['i'].data = json[i+1]['data'];
                }
                */
       
              $.each(json, function (itemNo, item) {
                     series = new Array();
                     if (itemNo == 1) {
                         series.name = item.name;
                         series.type = item.type;
                         series.data = item.data;
                         stacked.series.push(series);
                     }
                     else if (itemNo == 2) {
                         series.name = item.name;
                         series.type = item.type;
                         series.data = item.data;
                         stacked.series.push(series);
                     }
                     else if (itemNo == 3) {
                         series.name = item.name;
                         series.type = item.type;
                         series.data = item.data;
                         stacked.series.push(series);
                     }
                     else if (itemNo == 4) {
                         series.name = item.name;
                         series.type = item.type;
                         series.data = item.data;
                         series.yAxis=1;
                         stacked.series.push(series);
                     }
                });
                //console.log(stacked);
                stak = new Highcharts.Chart(stacked);
                flag=1;
               // console.log("flag:"+flag);
              });
	  }
	
	function l1pie(json1,name){ 
			 $.getJSON(json1, function(json) {
					level1.series[0].data = json;
					level1.title.text="<b>Level 1: "+name+"</b>";
					
					Highcharts.setOptions({
						   colors: ['#80ff80','#9966ff', '#0099ff', '#FFF263', '#6AF9C4']
					});
					lev1 = new Highcharts.Chart(level1);
			 });
			 var level1 = {
					chart: {
						   renderTo: 'level2',
						   plotBackgroundColor: null,
						   plotBorderWidth: null,
						   plotShadow: false,
						   backgroundColor:null,
						   options3d: {
							   enabled: true,
							   alpha: 45,
							   beta: 0
						   }
					},
					title: {
						   fontWeight:"bold",
						   style:{
							   color:"white",
							   textShadow: '0px 1px 2px black'
						   }
						   },
					tooltip: {
						   formatter: function() {
								  pc=this.percentage;
								  pc=pc.toFixed(2);
								  return '<b>'+ this.point.name +'</b>: '+ pc +' %';
						   }
					},
					legend:{
					   enabled:true,
						   itemStyle:{
							   color:"white",
							   fontWeight:"bold"
						   }
					   },
					plotOptions: {
						   pie: {
								  allowPointSelect: true,
								  cursor: 'pointer',
								  depth: 35,
								  dataLabels: {
										 enabled: true,
										 connectorWidth: 1,
										 formatter: function() {
												pc=this.percentage;
												pc=pc.toFixed(2);
												return '<b>'+ this.point.name +'</b>';
										 },
										 color:"white",
										 style: {
											   
												fontSize: '14px',
												fontWeight: 'bold',
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
															  level2("npsdata_new.php?level=top10&ppd=promoters&L1=people"+str,options.name,name);
													   }
													   else if (name=="Promoters" && options.name=="Product") {
															  level2("npsdata_new.php?level=top10&ppd=promoters&L1=product"+str,options.name,name);
													   }
													   else if (name=="Promoters" && options.name=="ProcessPolicy") {
															  level2("npsdata_new.php?level=top10&ppd=promoters&L1=processpolicy"+str,options.name,name);
													   }
													   else if (name=="Passives" && options.name=="People") {
															  level2("npsdata_new.php?level=top10&ppd=passives&L1=people"+str,options.name,name);
													   }
													   else if (name=="Passives" && options.name=="Product") {
															  level2("npsdata_new.php?level=top10&ppd=passives&L1=product"+str,options.name,name);
													   }
													   else if (name=="Passives" && options.name=="ProcessPolicy") {
															  level2("npsdata_new.php?level=top10&ppd=passives&L1=processpolicy"+str,options.name,name); 
													   }
													   else if (name=="Detractors" && options.name=="People") {
															  level2("npsdata_new.php?level=top10&ppd=detractors&L1=people"+str,options.name,name);
													   }
													   else if (name=="Detractors" && options.name=="Product") {
															  level2("npsdata_new.php?level=top10&ppd=detractors&L1=product"+str,options.name,name);
													   }
													   else if (name=="Detractors" && options.name=="ProcessPolicy") {
															  level2("npsdata_new.php?level=top10&ppd=detractors&L1=processpolicy"+str,options.name,name);
													   }
                                                       $("#widget-grid3").show("slow");
                                                        sc('widget-grid3');
                                                     //  $("#help2").hide("slow");
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
	   
	function l1week(json2,name) {
			 $.getJSON(json2, function(json) {
					wdata2.xAxis.categories = json[0]['data'];
					wdata2.series[0] = json[1];
					wdata2.series[1] = json[2];
					wdata2.series[2] = json[3];
					
					wdata2.title.text="<b>Trend for "+name+"</b>";
					
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
						   x: 20, //center
						   style:{
							   color:"white",
							   textShadow: '0px 1px 2px black'
						   }
					},
					tooltip: {
						   shared:true,
						   valueSuffix:"%"
					},
					xAxis: {
						   categories: [],
						   title:{
							   style:{
								   color:"white"
								   }
						   },
						   crosshair: true,
						   labels:{
								   style:{
								   color:"white"
								   }
								}
					},
					yAxis: {
						   title: {
								  text: 'Percentages',
								  style:{
								   color:"white"
								   }
						   },
						   gridLineColor: 'rgba(153, 153, 153,0.10)',
						   labels:{
								   style:{
								   color:"white"
								   }
								}
					},
					credits:{
						   enabled:false
					},
					
					legend: {
						   layout: 'horizontal',
						   align: 'center',
						   verticalAlign: 'bottom',
						   itemStyle:{
							   color:"white",
							   fontWeight:"bold"
						   },
						   borderWidth: 0
					},
					dataLabels:{
					   style: {
										 fontSize: '10px',
										 fontColor: 'white',
										 textShadow: '0 0 0 0 black'
								  }
					},
					plotOptions:{
                            series:{
                                   lineWidth: 4,
                                   marker:{
                                             enabled:true,
                                             radius:5,
                                             states:{
                                                    hover:{
                                                           radiusPlus: 1,
                                                    }
                                             }
                                   }
						   }
						   },
					series: []
			 }
	  }
      
	function level2(json3,l1,l2) {
              $.getJSON(json3, function(json) {
                     Highcharts.setOptions({
                            colors: ['#64E572','#FFF263', '#ff4d4d', '#0033cc']
                     });
                     
                     lev2.xAxis.categories = json[0]['data'];    
                     lev2.series[0] = json[1];
                     lev2.series[1] = json[2];
                     lev2.series[2] = json[3];
                     
                     lev2.title.text="TOP "+l2+" for "+l1;
                     levl2 = new Highcharts.Chart(lev2);
                     //levl2.series[1].hide();
                     if (l2=="Promoters") {
                            levl2.series[1].hide();
                            levl2.series[2].hide();
                     }
                     else if (l2=="Passives") {
                            levl2.series[0].hide();
                            levl2.series[2].hide();
                     }
                     else if (l2=="Detractors") {
                            levl2.series[0].hide();
                            levl2.series[1].hide();
                     }  
              });            
       }
       
       var lev2 = {
                     chart: {
                            renderTo: 'lev3',
                            type: 'column',
                            marginRight: 100,
                            marginBottom: 120,
							backgroundColor:null
                     },
                     title: {
                            x: 0, //center
							style:{
                                   fontSize:'16px',
                                   color:"white",
                                   fontWeight:"bold",
                                   textShadow: '0px 1px 2px black'
							}
                     },
                     subtitle: {
                            text: '',
                            x: -20
                     },
                     xAxis: {
                            title:{
                                   text: 'Customer Comments',
								   style:{
									color:"white"
									}
                            },
							labels:{
									style:{
									color:"white"
									}
								 },
                            categories: []
                     },
                     yAxis: {
                            title: {
                                   text: 'Samples',
								   style:{
									color:"white"
									}
                            },
							gridLineColor: 'rgba(153, 153, 153,0.25)',
							labels:{
									style:{
										color:"white"
									}
								 }
                     },
                     tooltip: {
                            formatter: function() {
                                   return '<b>'+ this.series.name +'</b><br/>'+
                                   this.x +': '+ this.y + ' Samples';
                            }
                     },
                     legend: {
                            //enabled:false,
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom',
                            borderWidth: 0,
							itemStyle:{
								color:"white",
								fontWeight:"bold"
							}
                     },
                     credits:{
                            enabled:false,
                     },
                     series: [ ]
              }     
	   
function sc(pid){
		var target = $('#' + pid);
		if( target.length ) {
			//event.preventDefault();
			$('html, body').animate({
				scrollTop: target.offset().top
			}, 2000);
		}
}

$(window).scroll(function(){
		if ($(this).scrollTop() > 500) {
			$('#scrollToTop').fadeIn();
		} else {
			$('#scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('#scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
      //  $("#help1").show();   
		return false;
	});
    


    
    
       
       