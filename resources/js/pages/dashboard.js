/**
 * Dashboard Page JavaScript
 * Handles dashboard interactions, charts, and real-time updates
 */

window.DashboardManager = {
    // Chart instances
    charts: {},

    // Initialize dashboard
    init: function() {
        this.initCharts();
        this.initRealTimeUpdates();
        this.initQuickActions();
    },

    // Initialize charts (placeholder for Chart.js integration)
    initCharts: function() {
        // Example chart initialization
        const chartElements = document.querySelectorAll('.chart');
        chartElements.forEach((element, index) => {
            // Chart initialization would go here
            console.log(`Chart ${index + 1} initialized on element:`, element);
        });
    },

    // Initialize real-time updates
    initRealTimeUpdates: function() {
        // Placeholder for real-time functionality
        setInterval(() => {
            this.updateStats();
        }, 30000); // Update every 30 seconds
    },

    // Update dashboard stats
    updateStats: function() {
        // This would typically make an AJAX call to get updated stats
        console.log('Updating dashboard stats...');
    },

    // Initialize quick actions
    initQuickActions: function() {
        const quickActions = document.querySelectorAll('.quick-action');
        quickActions.forEach(action => {
            action.addEventListener('click', function(e) {
                // Add loading state
                this.style.opacity = '0.7';
                setTimeout(() => {
                    this.style.opacity = '1';
                }, 200);
            });
        });
    },

    // Activity feed management
    addActivity: function(activity) {
        const activityFeed = document.querySelector('.activity-feed');
        if (activityFeed) {
            const activityItem = this.createActivityItem(activity);
            activityFeed.insertBefore(activityItem, activityFeed.firstChild);

            // Remove old items if more than 10
            const items = activityFeed.querySelectorAll('.activity-item');
            if (items.length > 10) {
                items[items.length - 1].remove();
            }
        }
    },

    // Create activity item element
    createActivityItem: function(activity) {
        const item = document.createElement('div');
        item.className = 'activity-item';
        item.innerHTML = `
            <div class="activity-icon bg-${activity.type}">
                <i class="fas fa-${activity.icon}"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title">${activity.title}</div>
                <div class="activity-description">${activity.description}</div>
                <div class="activity-time">${activity.time}</div>
            </div>
        `;
        return item;
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    DashboardManager.init();
});
