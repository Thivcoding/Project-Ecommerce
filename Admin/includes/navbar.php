<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="d-flex p-0 justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0" />
                </svg>
                <h4 class="p-0 mt-2 ms-2"><?= $_SESSION['auth-user']['name'] ?></h4>
            </div>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <div class="clock-container d-flex gap-3">
                        <div id="date">Loading date...</div>
                        <div id="time">Loading time...</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>
<script>
    function updateDateTime() {
        const now = new Date();

        // Format date as dd/mm/yyyy
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
        const year = now.getFullYear();
        const dateString = `${day}/${month}/${year}`;

        // Format time as hh:mm:ss
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;

        // Update the HTML elements
        document.getElementById('date').innerHTML = dateString;
        document.getElementById('time').innerHTML = timeString;
    }

    // Update the time immediately
    updateDateTime();

    // Update the time every second
    setInterval(updateDateTime, 1000);
</script>
<style>
    .clock-container {
        text-align: center;
    }

    #date {
        font-size: 1.8rem;
    }

    #time {
        font-size: 1.8rem;
        font-weight: bold;
    }
</style>