const backgroundImages = ['./IMG/fondo1.jpg', './IMG/fondo2.jpg', './IMG/fondo3.jpg', './IMG/fondo4.jpg'];

function setRandomBackground() {
    const randomIndex = Math.floor(Math.random() * backgroundImages.length);
    const selectedImage = backgroundImages[randomIndex];
    document.querySelector('.background').style.backgroundImage = `url(${selectedImage})`;
}

setRandomBackground(); // Establece un fondo aleatorio al cargar la página