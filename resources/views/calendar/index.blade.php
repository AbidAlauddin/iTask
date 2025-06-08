<x-layout-dashboard :title="$title ?? 'Calendar'">
    <div class="max-w-7xl mx-auto">
        <header class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Calendar</h1>
            <div class="flex items-center space-x-2">
                <button id="prevMonth" aria-label="Previous Month" class="p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <h2 id="monthYear" class="text-xl font-semibold text-gray-900 dark:text-white"></h2>
                <button id="nextMonth" aria-label="Next Month" class="p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-7 gap-1 text-center text-gray-600 dark:text-gray-400 font-semibold select-none">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>

        <div id="calendarGrid" class="grid grid-cols-7 gap-1 mt-2"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const monthYear = document.getElementById('monthYear');
            const calendarGrid = document.getElementById('calendarGrid');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');

            let currentDate = new Date();

            function renderCalendar(date) {
                calendarGrid.innerHTML = '';
                const year = date.getFullYear();
                const month = date.getMonth();

                // Set month and year header
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                monthYear.textContent = `${monthNames[month]} ${year}`;

                // First day of the month
                const firstDay = new Date(year, month, 1);
                // Last day of the month
                const lastDay = new Date(year, month + 1, 0);
                // Day of week for first day (0=Sun, 6=Sat)
                const startDay = firstDay.getDay();
                // Number of days in month
                const daysInMonth = lastDay.getDate();

                // Fill in blank days before first day
                for (let i = 0; i < startDay; i++) {
                    const emptyCell = document.createElement('div');
                    calendarGrid.appendChild(emptyCell);
                }

                // Fill in days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.textContent = day;
                    dayCell.className = 'py-2 rounded cursor-pointer hover:bg-blue-200 dark:hover:bg-blue-700 transition-colors';

                    // Highlight today
                    const today = new Date();
                    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                        dayCell.classList.add('bg-blue-500', 'text-white', 'font-bold');
                    }

                    calendarGrid.appendChild(dayCell);
                }
            }

            prevMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate);
            });

            nextMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate);
            });

            renderCalendar(currentDate);
        });
    </script>
</x-layout-dashboard>
