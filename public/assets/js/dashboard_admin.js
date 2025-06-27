/**
 * DASHBOARD ADMIN JAVASCRIPT
 * File: public/assets/js/dashboard_admin.js
 * Deskripsi: JavaScript khusus untuk halaman dashboard admin
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeDashboardCharts();
});

function initializeDashboardCharts() {
    // Grafik Barang Masuk/Keluar
    const ctxMasukKeluar = document.getElementById('chartMasukKeluar');
    if (ctxMasukKeluar) {
        new Chart(ctxMasukKeluar.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: [12, 19, 15, 17, 22, 18, 25, 20, 23, 19, 21, 24],
                        borderColor: '#4e9af1',
                        backgroundColor: 'rgba(78,154,241,0.12)',
                        tension: 0.35,
                        pointRadius: 3,
                        pointBackgroundColor: '#4e9af1',
                        fill: true
                    },
                    {
                        label: 'Barang Keluar',
                        data: [8, 14, 10, 13, 16, 12, 18, 15, 17, 13, 15, 18],
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40,167,69,0.10)',
                        tension: 0.35,
                        pointRadius: 3,
                        pointBackgroundColor: '#28a745',
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { 
                        grid: { display: false },
                        ticks: { color: '#333' }
                    },
                    y: { 
                        beginAtZero: true, 
                        grid: { color: '#f0f2f7' },
                        ticks: { color: '#333' }
                    }
                }
            }
        });
    }
    
    // Grafik Stok Barang per Kategori
    const ctxKategori = document.getElementById('chartKategori');
    if (ctxKategori) {
        function getLegendColor() {
            // Warna abu gelap untuk legend text
            return '#333';
        }
        
        let chartKategori = new Chart(ctxKategori.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Elektronik', 'Aksesoris', 'ATK', 'Lainnya'],
                datasets: [{
                    data: [40, 25, 20, 15],
                    backgroundColor: [
                        '#4e9af1', // biru
                        '#28a745', // hijau
                        '#ffc107', // kuning
                        '#ff6a8d'  // pink
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: getLegendColor(),
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: { 
                        enabled: true,
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#fff',
                        borderWidth: 1
                    }
                }
            }
        });
    }
}

// Helper functions untuk chart colors
function getChartTextColor() {
    return document.documentElement.classList.contains('dark-mode') || 
           document.body.classList.contains('dark-mode') ? '#ffffff' : '#333333';
}

function getChartGridColor() {
    return document.documentElement.classList.contains('dark-mode') || 
           document.body.classList.contains('dark-mode') ? '#444444' : '#f0f2f7';
}

// Export untuk global use
window.DashboardCharts = {
    initialize: initializeDashboardCharts,
    getChartTextColor: getChartTextColor,
    getChartGridColor: getChartGridColor
}; 