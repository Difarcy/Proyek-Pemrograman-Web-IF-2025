function initializeDashboardCharts() {
    // Get chart data from PHP variables
    const chartData = window.chartData || {
        masukKeluar: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            masuk: [12, 19, 3, 5, 2, 3],
            keluar: [8, 15, 7, 12, 9, 5]
        },
        kategori: {
            labels: ['Semen', 'Bata', 'Pasir', 'Besi', 'Kayu'],
            data: [30, 25, 20, 15, 10]
        }
    };

    // Dashboard Chart Logic
    if (window.chartData) {
        // Grafik Barang Masuk/Keluar
        const ctxMasukKeluar = document.getElementById('chartMasukKeluar');
        if (ctxMasukKeluar && window.chartData) {
            new Chart(ctxMasukKeluar.getContext('2d'), {
                type: 'line',
                data: {
                    labels: window.chartData.masukKeluar?.labels || [],
                    datasets: [
                        {
                            label: 'Barang Masuk',
                            data: window.chartData.masukKeluar?.masuk || [],
                            borderColor: '#4285F4',
                            backgroundColor: 'rgba(66,133,244,0.15)',
                            pointBackgroundColor: '#4285F4',
                            pointBorderColor: '#fff',
                            pointRadius: 5,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Barang Keluar',
                            data: window.chartData.masukKeluar?.keluar || [],
                            borderColor: '#34A853',
                            backgroundColor: 'rgba(52,168,83,0.15)',
                            pointBackgroundColor: '#34A853',
                            pointBorderColor: '#fff',
                            pointRadius: 5,
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }
        // Grafik Total Summary (Pie)
        const ctxTotal = document.getElementById('chartKategori');
        if (ctxTotal && window.chartData && window.chartData.total) {
          new Chart(ctxTotal.getContext('2d'), {
            type: 'pie',
            data: {
              labels: window.chartData.total.labels,
              datasets: [{
                data: window.chartData.total.data,
                backgroundColor: [
                  '#4285F4', // Total Barang
                  '#F4B400', // Total Customer
                  '#34A853', // Total Supplier
                  '#A142F4', // Total Petugas
                  '#FF9800', // Barang Masuk
                  '#EA4335'  // Barang Keluar
                ],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              plugins: {
                legend: {
                  display: true,
                  position: 'bottom',
                  align: 'center',
                  labels: {
                    padding: 8,
                    boxWidth: 20,
                    font: { size: 12 },
                    maxWidth: 600
                  }
                }
              },
              layout: {
                padding: {
                  bottom: 30
                }
              }
            }
          });
        }
    }
}

document.addEventListener('DOMContentLoaded', initializeDashboardCharts);
