{{-- resources/views/components/toast-reminder.blade.php --}}
<div class="toast">
    <div class="toast-body">
        @foreach($tasksDueSoon as $task)
            <p>{{ $task->name }} - Jatuh Tempo: {{ $task->deadline->format('d M Y') }}</p>
        @endforeach
    </div>
</div>

<script>
    // Menentukan waktu notifikasi harus muncul (misalnya jam 9 pagi)
    const targetTime = new Date();
    targetTime.setHours(9, 0, 0, 0);  // Jam 9:00:00 pagi

    // Menghitung waktu selisih hingga jam target
    const now = new Date();
    const timeDifference = targetTime - now;

    // Menampilkan notifikasi pada waktu yang ditentukan
    if (timeDifference <= 0) {
        document.querySelector('.toast').style.display = 'block'; // Menampilkan notifikasi
    } else {
        // Menunggu sampai jam target untuk menampilkan notifikasi
        setTimeout(() => {
            document.querySelector('.toast').style.display = 'block';
        }, timeDifference);
    }
</script>
