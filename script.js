document.addEventListener("DOMContentLoaded", () => {
    const textElement = document.querySelector(".bounce-text");

    // Set initial position and velocity
    let position = 0;
    let velocity = -1;
    const gravity = 0.01;
    const bounceFactor = -0.6;
    const height = window.innerHeight;
    const heightText = textElement.clientHeight;
    function animate() {
        // Stop the text when it reaches the bottom
        if (position > (height - heightText + 4)) {
            return;
        }

        // Apply gravity to velocity
        velocity += gravity;

        // Apply velocity to position
        position += velocity;

        // Bounce when hitting the bottom
        if (position > height - heightText && velocity > 0) {
            velocity *= bounceFactor;
        }

        // Set position
        textElement.style.top = position + "px";

        // Repeat animation
        requestAnimationFrame(animate);
    }

    // Start animation
    requestAnimationFrame(animate);
});
