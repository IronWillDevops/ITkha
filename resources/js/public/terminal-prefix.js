document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('#post-content pre').forEach(pre => {
    const lines = pre.innerText.split('\n').filter(line => line.trim() !== '');
    pre.innerHTML = lines.map(line => `<span>${line}</span>`).join('\n');
  });
  
});