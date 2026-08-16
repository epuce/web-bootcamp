// Vanilla fetch replaces the old jQuery $.ajax version.
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#form');
    const submitBtn = document.querySelector('#submit');
    const deleteButtons = document.querySelectorAll('.delete');

    // Add / update through the JSON API in src/
    submitBtn?.addEventListener('click', async () => {
        const data = new FormData(form);
        const action = data.get('id') ? 'put' : 'post';

        const res = await fetch(`src/${action}.php`, { method: 'POST', body: data });
        console.log(await res.json());
        window.location = 'index.php';
    });

    // Delete through the JSON API
    deleteButtons.forEach((btn) => {
        btn.addEventListener('click', async () => {
            const res = await fetch(`src/delete.php?id=${encodeURIComponent(btn.dataset.id)}`);
            console.log(await res.json());
            window.location = 'index.php';
        });
    });
});
