window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.classList.add('bg-opacity-90');
    } else {
        header.classList.remove('bg-opacity-90');
    }
});