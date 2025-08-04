function updateSegmentedPasswordStrength(password, fieldId) {
    const segments = [
        document.getElementById(`${fieldId}-seg-1`),
        document.getElementById(`${fieldId}-seg-2`),
        document.getElementById(`${fieldId}-seg-3`),
        document.getElementById(`${fieldId}-seg-4`)
    ];

    let score = 0;

    if (password.length >= 8) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/\d/.test(password)) score++;
    if (/[!@#$%^&*]/.test(password)) score++;

    // Визначаємо колір в залежності від кількості балів
    let color = 'bg-text-primary'; // За замовчуванням сірий
    if (score === 1) color = 'bg-red-500';
    else if (score === 2) color = 'bg-orange-400';
    else if (score === 3) color = 'bg-yellow-400';
    else if (score === 4) color = 'bg-green-500';

    // Оновлюємо сегменти: заповнюємо score штук одним кольором, решту сірими
    segments.forEach((seg, i) => {
        seg.className = 'w-full h-full rounded transition-all duration-300 ' +
            (i < score ? color : 'bg-text-primary');
    });

}
window.updateSegmentedPasswordStrength = updateSegmentedPasswordStrength;