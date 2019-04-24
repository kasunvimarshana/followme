/* legen item click */
function(e, legendItem) {
  var index = legendItem.datasetIndex;
  var ci = this.chart;
  var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci.getDatasetMeta(index).hidden;

  ci.data.datasets.forEach(function(e, i) {
    var meta = ci.getDatasetMeta(i);

    if (i !== index) {
      if (!alreadyHidden) {
        meta.hidden = meta.hidden === null ? !meta.hidden : null;
      } else if (meta.hidden === null) {
        meta.hidden = true;
      }
    } else if (i === index) {
      meta.hidden = null;
    }
  });

  ci.update();
};
/* legend item click */
/* legend item click */
onClick:function(e, legendItem){
    var index = legendItem.index;
    var ci = this.chart;
    var meta = ci.getDatasetMeta(0);
    var CurrentalreadyHidden = (meta.data[index].hidden==null) ? false : (meta.data[index].hidden);
    var allShown=true;
    $.each(meta.data,function(ind0,val0){
        if(meta.data[ind0].hidden){
            allShown=false;
            return false; 
        }else{
            allShown=true;
        }
    });
    if(allShown){
        $.each(meta.data,function(ind,val){
            if(meta.data[ind]._index===index){
                meta.data[ind].hidden=false;
            }else{
                meta.data[ind].hidden=true;
            }
        });
    }else{
        if(CurrentalreadyHidden){
            $.each(meta.data,function(ind,val){
                if(meta.data[ind]._index===index){
                    meta.data[ind].hidden=false;
                }else{
                    meta.data[ind].hidden=true;
                }
            });
        }else{
            $.each(meta.data,function(ind,val){
                meta.data[ind].hidden=false;
            }); 
         }
     }
    ci.update();

}
/* legend item click */
/* legend item click */
var weightChartOptions = {
        responsive: true,
        legendCallback: function(chart) {
            console.log(chart);
            var legendHtml = [];
            legendHtml.push('<table>');
            legendHtml.push('<tr>');
            for (var i=0; i<chart.data.datasets.length; i++) {
                legendHtml.push('<td><div class="chart-legend" style="background-color:' + chart.data.datasets[i].backgroundColor + '"></div></td>');                    
                if (chart.data.datasets[i].label) {
                    legendHtml.push('<td class="chart-legend-label-text" onclick="updateDataset(event, ' + '\'' + chart.legend.legendItems[i].datasetIndex + '\'' + ')">' + chart.data.datasets[i].label + '</td>');
                }                                                                              
            }                                                                                  
            legendHtml.push('</tr>');                                                          
            legendHtml.push('</table>');                                                       
            return legendHtml.join("");                                                        
        },                                                                                     
        legend: {                                                                              
            display: false                                                                     
        }                                                                                      
    };                                                                                         

    // Show/hide chart by click legend
    updateDataset = function(e, datasetIndex) {
        var index = datasetIndex;
        var ci = e.view.weightChart;
        var meta = ci.getDatasetMeta(index);

        // See controller.isDatasetVisible comment
        meta.hidden = meta.hidden === null? !ci.data.datasets[index].hidden : null;

        // We hid a dataset ... rerender the chart
        ci.update();
    };

    var ctx = document.getElementById("weightChart").getContext("2d");
    window.weightChart = new Chart(ctx, {
        type: 'line',
        data: weightChartData, 
        options: weightChartOptions
    });
    document.getElementById("weightChartLegend").innerHTML = weightChart.generateLegend();
};
/* legend item click */
/* legend item click */
//Hide
chart.getDatasetMeta(1).hidden=true;
chart.update();

//Show
chart.getDatasetMeta(1).hidden=null;
chart.update();
/* legend item click */
