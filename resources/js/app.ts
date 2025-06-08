document.addEventListener('DOMContentLoaded', () => {
    // Dark mode persistence
    const html = document.documentElement;
    const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    const storedTheme = localStorage.getItem('theme');

    function applyTheme(theme) {
        if (theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
    }

    if (storedTheme) {
        applyTheme(storedTheme);
    } else if (darkModeMediaQuery.matches) {
        applyTheme('dark');
    } else {
        applyTheme('light');
    }

    // Listen for changes in system preference
    darkModeMediaQuery.addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });

    // Example toggle button (if exists) to switch theme manually
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    }

    // Task checkbox AJAX update
    const checkboxes = document.querySelectorAll('.task-checkbox');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', async (event) => {
            const target = event.target;
            if (!(target instanceof HTMLInputElement)) return;

            const taskDiv = target.closest('div[data-task-id]');
            if (!taskDiv) return;

            const taskId = taskDiv.getAttribute('data-task-id');
            const listId = taskDiv.getAttribute('data-list-id');
            const title = taskDiv.getAttribute('data-title');
            const description = taskDiv.getAttribute('data-description');
            const deadline = taskDiv.getAttribute('data-deadline');

            if (!taskId || !listId || !title) return;

            const completed = target.checked;

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

            try {
                const response = await fetch(`/lists/${listId}/tasks/${taskId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        title: title,
                        description: description,
                        deadline: deadline,
                        completed: completed,
                    }),
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Fetch error response:', response.status, errorText);
                    throw new Error('Network response was not ok');
                }

                const titleLink = taskDiv.querySelector('.task-title');
                if (titleLink) {
                    if (completed) {
                        titleLink.classList.add('line-through', 'text-gray-400');
                    } else {
                        titleLink.classList.remove('line-through', 'text-gray-400');
                    }
                }
            } catch (error) {
                console.error('Error updating task:', error);
                target.checked = !completed;
                alert('Failed to update task status. Please try again.');
            }
        });
    });
});
