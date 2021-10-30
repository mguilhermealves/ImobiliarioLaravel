<div id="Barschart" style="width:100%; height:400px;"></div>
<script>
  $(document).ready(function(){
    google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChartB);
      function drawChartB() {
        var dataBars = google.visualization.arrayToDataTable([
        ['', ''],
        @forelse($subs as $sub)
          ['{!! $sub->nome !!}',     {{$sub->visitas}}],
        @empty
        @endforelse
        ]);
        
        var options = {
          title: 'Subcategoria',                                      
          fontSize:12,                                                                                   
        };
        
        var chartBars = new google.visualization.BarChart(document.getElementById('Barschart'));
        chartBars.draw(dataBars, options);
      }
    });
</script>