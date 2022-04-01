const imageInput = document.getElementById('image');
const preview = document.getElementById('preview');
const placeholder = 'https://www.geometrian.it/wp-content/uploads/2016/12/image-placeholder-500x500.jpg';

imageInput.addEventListener('change', () => {
    if (imageInput.files && imageInput.files[0]) { //non fare il .value perché addesso l'input è di tipo file 
        let reader = new FileReader();
        reader.readAsDataURL(imageInput.files[0]); //Crea un Data-Url, è asincrona
        reader.onload = e => { //Quando finisce di leggere esegue l'arrow function
            preview.setAttribute('src', e.target.result);
        };
    }
});