document.addEventListener("mousemove", (event) => {
    let layers = document.querySelectorAll(".layer");
     // finding a value between -1 and 1 using curser location
    let x = (event.clientX / window.innerWidth * 2) - 1;
    let y = (event.clientY / window.innerHeight * 2) - 1; 

    layers.forEach((layer) => {
        const depth = parseFloat(layer.dataset.depth);
        const moveX = x * depth * 400;
        const moveY = y * depth * 400;

        // allows us to use the css "transform", embedding javascript variables with the template literal `...`
        layer.style.transform = `translate(${moveX}px, ${moveY}px)`; 
    });
});

const audio = new Audio("resources/audio/while_you_were_sleeping_piano.mp3")
    audio.loop = true; 
    let isPlay = false;

    document.getElementById("musicBtn").addEventListener("click", () => {
        if (!isPlay) {
            audio.play();
            isPlay = true;
        } else {
            audio.pause();
            isPlay = false;
        }
    })