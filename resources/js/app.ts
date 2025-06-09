declare global {
  interface Window {
    Alpine: any;
  }
}

import Alpine from 'alpinejs';
window.Alpine = Alpine;

function useDarkMode() {
    return {
        html: document.documentElement,
        darkModeMediaQuery: window.matchMedia('(prefers-color-scheme: dark)'),
        storedTheme: localStorage.getItem('theme'),
        currentTheme: '',

        applyTheme(theme: string) {
            this.currentTheme = theme;
            if (theme === 'dark') {
                this.html.classList.add('dark');
            } else {
                this.html.classList.remove('dark');
            }
        },

        init() {
            if (this.storedTheme) {
                this.applyTheme(this.storedTheme);
            } else if (this.darkModeMediaQuery.matches) {
                this.applyTheme('dark');
            } else {
                this.applyTheme('light');
            }

            this.darkModeMediaQuery.addEventListener('change', (e) => {
                if (!localStorage.getItem('theme')) {
                    this.applyTheme(e.matches ? 'dark' : 'light');
                }
            });
        },

        toggleTheme() {
            if (this.currentTheme === 'dark') {
                this.applyTheme('light');
                localStorage.setItem('theme', 'light');
            } else {
                this.applyTheme('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    };
}

function useTaskCheckbox() {
    return {
        async updateTaskStatus(event: Event) {
            console.log('updateTaskStatus triggered');
            const target = event.target;
            if (!(target instanceof HTMLInputElement)) return;

            const taskDiv = target.closest('div[data-task-id]');
            if (!taskDiv) {
                console.log('No task div found for checkbox');
                return;
            }

            const taskId = taskDiv.getAttribute('data-task-id');
            const listId = taskDiv.getAttribute('data-list-id');

            // Always use task-only update route for all-task page (where data-list-id is task id)
            console.log('Using task-only update route');
            try {
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                const token = tokenMeta ? tokenMeta.getAttribute('content') : '';
                const response = await fetch(`/tasks/${taskId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        completed: target.checked,
                    }),
                });
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Fetch error response:', response.status, errorText);
                    throw new Error('Network response was not ok');
                }
                const taskDivForTitle = target.closest('div[data-task-id]');
                const titleLink = taskDivForTitle ? taskDivForTitle.querySelector('.task-title') : null;
                if (titleLink) {
                    if (target.checked) {
                        titleLink.classList.add('line-through', 'text-gray-400');
                    } else {
                        titleLink.classList.remove('line-through', 'text-gray-400');
                    }
                }
            } catch (error) {
                console.error('Error updating task:', error);
                target.checked = !target.checked;
                alert('Failed to update task status. Please try again.');
            }

            const title = taskDiv.getAttribute('data-title');
            const description = taskDiv.getAttribute('data-description');
            const deadline = taskDiv.getAttribute('data-deadline');

            const completed = target.checked;

            console.log('Updating task status:', { taskId, listId, completed });

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

            console.log('Sending PATCH request to:', `/lists/${listId}/tasks/${taskId}`);

            try {
                const response = await fetch(`/lists/${listId}/tasks/${taskId}`, {
                    method: 'PATCH',
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
        }
    };
}

document.addEventListener('alpine:init', () => {
    Alpine.data('darkMode', useDarkMode);
    Alpine.data('taskCheckbox', useTaskCheckbox);
});

Alpine.start();
