const deleteForm = document.querySelectorAll('.delete-form');
deleteForm.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        const accept = confirm("Sei sicura di voler eliminare l'elemento");
        if (accept) e.target.submit();
    });
});