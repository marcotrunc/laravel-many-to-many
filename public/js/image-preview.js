const imageInput = document.getElementById('image');
const preview = document.getElementById('preview');
const placeholder = 'https://www.geometrian.it/wp-content/uploads/2016/12/image-placeholder-500x500.jpg';

imageInput.addEventListener('change', (e) => {
    const url = imageInput.value;
    if (url) preview.setAttribute("src", e.target.value);
    else preview.setAttribute("src", placeholder);
});