<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Realtime Data Ultrasonik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 40px;
    }
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    h2 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center text-primary">📡 Realtime Data Sensor Ultrasonik</h2>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card p-3">
          <h5 class="text-center">📈 Grafik Jarak</h5>
          <canvas id="distanceChart" height="250"></canvas>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card p-3">
          <h5 class="text-center">📋 Tabel Data Terakhir</h5>
          <div id="data-container"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('distanceChart').getContext('2d');
    let chart;

    function createChart(labels, data) {
      chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Jarak (cm)',
            data: data,
            borderColor: '#007bff',
            backgroundColor: 'rgba(0,123,255,0.1)',
            tension: 0.3,
            fill: true
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Jarak (cm)'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Waktu'
              }
            }
          }
        }
      });
    }

    function fetchTable() {
      fetch('load_data.php')
        .then(res => res.text())
        .then(html => {
          document.getElementById('data-container').innerHTML = html;
        });
    }

    function fetchChart() {
      fetch('chart_data.php')
        .then(res => res.json())
        .then(json => {
          const labels = json.map(row => row.waktu);
          const data = json.map(row => parseFloat(row.distance));

          if (chart) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
          } else {
            createChart(labels, data);
          }
        });
    }

    setInterval(() => {
      fetchTable();
      fetchChart();
    }, 2000);

    window.onload = () => {
      fetchTable();
      fetchChart();
    };
  </script>
</body>
</html>
