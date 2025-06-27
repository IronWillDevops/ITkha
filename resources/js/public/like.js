
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form.like-form').forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const url = form.action;
                const token = form.querySelector('input[name="_token"]').value;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                        },
                        body: null,
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    const button = form.querySelector('button.like-button');
                    const countSpan = button.querySelector('.like-count');
                    const icon = button.querySelector('i');
                    icon.classList.add('animate-like');
                    button.classList.remove('post-like', 'post-like-hover');
                    if (data.liked) {
                        button.classList.add('post-like');
                    } else {
                        button.classList.add('post-like-hover');
                    }
                    setTimeout(() => {
                        icon.classList.remove('animate-like');
                    }, 300);
                    countSpan.textContent = data.likes_count;

                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });
});
