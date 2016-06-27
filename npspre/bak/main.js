$("document").ready(function(){
         
       var overall={
              chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: 0,
                     plotShadow: false,
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
                            fontSize:"15px",
                            color:"#0033cc"
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
                                                        $("#lev3").hide("slow");
                                                 }
                                                 else if (options.name=="Passives") {
                                                        ngraph("npsdatal2.php?type=L1Pas",options.name);
                                                        wdata("npsdatal2.php?type=L1TimePas",options.name);
                                                        $("#lev3").hide("slow");
                                                 }
                                                 else if (options.name=="Detractors"){
                                                        ngraph("npsdatal2.php?type=L1Det",options.name);
                                                        wdata("npsdatal2.php?type=L1TimeDet",options.name);
                                                        $("#lev3").hide("slow");
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
       $.getJSON("npsdata.php?type=s1", function(json) {
              var str= json[0].toString();
             // console.log(str);
              score= str.replace(","," <br>");
              overall.subtitle.text = score;
              overall.series[0].data[0] = json[1];
              overall.series[0].data[1] = json[2];
              overall.series[0].data[2] = json[3];
              chart = new Highcharts.Chart(overall);
       });
       
       var weekly= {
              chart: {
                     type: 'line',
                     renderTo: 'weekly'
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
       $.getJSON("npsdata.php?type=s2", function(json) {
              weekly.xAxis.categories = json[0]['data'];
              weekly.series[0] = json[1];
              weekly.series[1] = json[2];
              weekly.series[2] = json[3];
              weekly.series[3] = json[4];
              chart = new Highcharts.Chart(weekly);
       });
     /*   
       var stacked= {
              chart: {
                     type: 'bar',
                     renderTo: 'topdata'
              },
              title: {
                     text: 'TOP 10 TOPICS',
                     x: 10,
                     y:20//center
              },
              xAxis: {
                     categories: [],
              },
              yAxis: {
                     min: 0,
                     max:100,
                     reversedStacks:false,
                     title: {
                            text: 'Percentages',
                            x:-10
                     } 
              },
              tooltip: {
                     formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y +'%';
                     },       
              },
              plotOptions: {
                     series: {
                            stacking: 'normal',
                            y:10,
                            dataLabels: {
                                   enabled: true,
                                   style: {
                                          fontSize: '10px',
                                          fontColor: 'white',
                                          textShadow: '0 0 0 0 black'
                                   }
                            }
                     }
              },
              series:[],
              credits:{
                     enabled:false,
              }
       }             
       $.getJSON("npsdata.php?type=s3", function(json) {
              stacked.xAxis.categories = json[0]['data'];
              stacked.series[0] = json[1];
              stacked.series[1] = json[2];
              stacked.series[2] = json[3];
              stak = new Highcharts.Chart(stacked);
       });
       */
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
                            plotShadow: false
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
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Promoters" && options.name=="Product") {
                                                               level2("npsdata.php?level=top10&ppd=promoters&L1=product",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Promoters" && options.name=="ProcessPolicy") {
                                                               level2("npsdata.php?level=top10&ppd=promoters&L1=processpolicy",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Passives" && options.name=="People") {
                                                               level2("npsdata.php?level=top10&ppd=passives&L1=people",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Passives" && options.name=="Product") {
                                                               level2("npsdata.php?level=top10&ppd=passives&L1=product",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Passives" && options.name=="ProcessPolicy") {
                                                               level2("npsdata.php?level=top10&ppd=passives&L1=processpolicy",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Detractors" && options.name=="People") {
                                                               level2("npsdata.php?level=top10&ppd=detractors&L1=people",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Detractors" && options.name=="Product") {
                                                               level2("npsdata.php?level=top10&ppd=detractors&L1=product",options.name,name);
                                                               $("#lev3").show("slow");
                                                        }
                                                        else if (name=="Detractors" && options.name=="ProcessPolicy") {
                                                               level2("npsdata.php?level=top10&ppd=detractors&L1=processpolicy",options.name,name);
                                                               $("#lev3").show("slow");
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
                            renderTo: 'weekly2'
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
                            marginBottom: 120
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
});