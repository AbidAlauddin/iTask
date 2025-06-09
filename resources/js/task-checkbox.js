document.addEventListener('alpine:init', () => {
    Alpine.data('taskCheckbox', () => ({
        async updateTaskStatus(event) {
            const cb = event.target;
            const taskElement = cb.closest('[data-task-id]');
            if (!taskElement) return;

            const taskId = taskElement.getAttribute('data-task-id');
            const listId = taskElement.getAttribute('data-list-id');
            const completed = cb.checked;

            // If unchecked, do nothing here to keep existing functionality
            if (!completed) {
                return;
            }

            try {
                const response = await fetch(`/lists/${listId}/tasks/${taskId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ completed }),
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                // Remove the task element from the current list to reflect completion
                taskElement.remove();

                // Optionally, reload the page to update completed tasks list
                // location.reload();

            } catch (error) {
                console.error('Error updating task:', error);
                // Revert checkbox state on error
                cb.checked = !completed;
                alert('Failed to update task status. Please try again.');
            }
        }
    }));
});
