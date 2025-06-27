/**
 * VSTOCK Dark Mode Manager
 * Mengelola dark mode secara global untuk seluruh aplikasi
 */

class DarkModeManager {
    constructor() {
        this.storageKey = 'vstock-dark';
        this.init();
    }

    init() {
        // Apply saved theme on page load
        this.applySavedTheme();
        
        // Listen for dark mode changes
        document.addEventListener('darkModeChanged', (event) => {
            this.handleThemeChange(event.detail.isDarkMode);
        });
    }

    applySavedTheme() {
        const savedTheme = localStorage.getItem(this.storageKey);
        if (savedTheme === 'true') {
            this.enableDarkMode();
        } else {
            this.disableDarkMode();
        }
    }

    toggleDarkMode() {
        const isDarkMode = document.body.classList.contains('dark-mode');
        
        if (isDarkMode) {
            this.disableDarkMode();
        } else {
            this.enableDarkMode();
        }

        // Save to localStorage
        localStorage.setItem(this.storageKey, (!isDarkMode).toString());
        
        // Trigger custom event
        const event = new CustomEvent('darkModeChanged', { 
            detail: { isDarkMode: !isDarkMode } 
        });
        document.dispatchEvent(event);
    }

    enableDarkMode() {
        document.documentElement.classList.add('dark-mode');
        document.body.classList.add('dark-mode');
    }

    disableDarkMode() {
        document.documentElement.classList.remove('dark-mode');
        document.body.classList.remove('dark-mode');
    }

    handleThemeChange(isDarkMode) {
        // Force immediate visual update
        document.body.offsetHeight;
        
        // Update charts if they exist
        this.updateCharts();
        
        console.log('Dark mode changed:', isDarkMode);
    }

    updateCharts() {
        if (typeof Chart !== 'undefined') {
            const charts = Chart.instances;
            Object.values(charts).forEach(chart => {
                // Update chart colors based on theme
                if (chart.options.scales) {
                    ['x', 'y'].forEach(axis => {
                        if (chart.options.scales[axis]?.ticks) {
                            chart.options.scales[axis].ticks.color = this.isDarkMode() ? '#ffffff' : '#666666';
                        }
                        if (chart.options.scales[axis]?.grid) {
                            chart.options.scales[axis].grid.color = this.isDarkMode() ? '#444444' : '#f0f2f7';
                        }
                    });
                }

                if (chart.options.plugins?.legend?.labels) {
                    chart.options.plugins.legend.labels.color = this.isDarkMode() ? '#ffffff' : '#666666';
                }

                chart.update();
            });
        }
    }

    isDarkMode() {
        return document.body.classList.contains('dark-mode');
    }
}

// Initialize dark mode manager
const darkModeManager = new DarkModeManager();

// Export for global use
window.DarkModeManager = DarkModeManager;
window.darkModeManager = darkModeManager; 