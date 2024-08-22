@extends('./layouts/app')
@extends('./layouts/sidebar')

@section('title')
Jaya Motor | Admin
@endsection

@section('contentsidebar')
<div class="mb-10">
    <p class="font-bold text-xl">Selamat datang NAMA!</p>
    <p>Anda login dengan email <b>EMAIL</b></p>
</div>
<div id="real-time-clock"></div>

<script>
    function updateDateTime() {
            const clockElement = document.getElementById('real-time-clock');
            const currentTime = new Date();
        
            // Define arrays for days of the week and months to format the day and month names.
            const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const dayOfWeek = daysOfWeek[currentTime.getDay()];
        
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const month = months[currentTime.getMonth()];
        
            const day = currentTime.getDate();
            const year = currentTime.getFullYear();
        
            // Get hours, minutes, and seconds in 24-hour format.
            const hours = currentTime.getHours().toString().padStart(2, '0');
            const minutes = currentTime.getMinutes().toString().padStart(2, '0');
            const seconds = currentTime.getSeconds().toString().padStart(2, '0');
        
            // Construct the date and time string in the desired format with a <br> for line break.
            const dateTimeString = `<div class="font-light">${dayOfWeek}, ${day} ${month} ${year}<br><div class="text-3xl mt-2">${hours}:${minutes}:${seconds} WIB</div></div>`;
            clockElement.innerHTML = dateTimeString;
        }
        
        // Update the date and time every second (1000 milliseconds).
        setInterval(updateDateTime, 1000);
        
        // Initial update.
        updateDateTime();
</script>
@endsection