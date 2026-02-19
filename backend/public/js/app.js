document.addEventListener('DOMContentLoaded', function () {
    // Handles all toggle button groups
    const toggleGroups = document.querySelectorAll('.toggle-group');

    toggleGroups.forEach(group => {
        const buttons = group.querySelectorAll('.toggle-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons in the same group
                buttons.forEach(btn => btn.classList.remove('active'));
                // Add active class to the clicked button
                this.classList.add('active');
            });
        });
    });
});