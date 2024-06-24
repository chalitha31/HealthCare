document.addEventListener('DOMContentLoaded', function() {
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        document.getElementById('liveTime').textContent = timeString;
    }
    
    updateTime(); // Initial call to set the time immediately
    setInterval(updateTime, 1000); // Update time every second
});
