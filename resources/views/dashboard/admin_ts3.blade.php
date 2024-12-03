<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('vehicle') }}">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-motorcycle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kendaraan</span>
                    <span class="info-box-number">{{ $vehicle }}</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('spk-list-service') }}">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-list-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">List Service</span>
                    <span class="info-box-number">0</span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ asset('spk-status') }}">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-map-signs"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">SPK</span>
                    <span class="info-box-number">0</span>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div id="mvm-rating-chart"></div>
    </div>
    <div class="col-sm-6">
        <div id="mvm-count-client-chart"></div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    $(function() {
        Highcharts.chart('mvm-count-client-chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'column'
            },
            title: {
                text: 'Jumlah Vehicle MVM Client '
            },
            subtitle: {
                  text: ''
              },
              xAxis: {
                  categories:[
              <?php foreach ($dataPointsmotor as $item) { ?>
                  '<?= $item['name'] ?>',
              <?php } ?>
          ]
          
              },
              yAxis: {
                  title: {
                      text: 'Count Vehicle'
                  }
              },
              plotOptions: {
                  line: {
                      dataLabels: {
                          enabled: true
                      },
                      enableMouseTracking: false
                  }
              },
              series: [{
                name: 'Client',
                colorByPoint: true,
                data: <?= json_encode($dataPointsmotor) ?>
              }]
        });
    });
  
  
  </script>
  
  <script>
    $(function() {
        Highcharts.chart('mvm-rating-chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Rating Motor Vehicle Maintenance '
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Rating',
                colorByPoint: true,
                data: <?= $dataPointsrating ?>
            }]
        });
    });  
  </script>