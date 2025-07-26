document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('avatar');
    const container = document.getElementById('avatarContainer');

    // Захист: не запускаємо нічого, якщо інпут або контейнер не знайдені
    if (!input || !container) {
        return;
    }

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file || !file.type.startsWith('image/')) return;

        const reader = new FileReader();

        reader.onload = function (e) {
            // Видаляємо блок із ініціалами, якщо існує
            const initials = document.getElementById('avatarInitials');
            if (initials) initials.remove();

            // Видаляємо попередній прев'ю, якщо існує
            const oldImg = document.getElementById('avatarPreview');
            if (oldImg) oldImg.remove();

            // Створюємо новий прев'ю
            const img = document.createElement('img');
            img.id = 'avatarPreview';
            img.src = e.target.result;
            img.className = 'w-full h-full object-cover rounded-full';
            img.alt = 'preview';

            container.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
});
