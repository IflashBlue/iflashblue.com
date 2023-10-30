document.addEventListener("DOMContentLoaded", () => {
    const textElement = document.querySelector(".bounce-text");

    // Set initial positions and velocities
    let xPos = window.innerWidth / 2 - textElement.clientWidth / 2; // center text
    let yPos = 0;
    let xVelocity = 5;  // You can adjust this for faster/slower horizontal movement
    let yVelocity = 5;
    const gravity = 0.5;
    const bounceFactor = -1;
    const heightPage= window.innerWidth;
    const heightText  = textElement.clientHeight;

    function animate() {
        console.log(yPos, xPos, heightPage)
        // Stop the text when it reaches the bottom
        if (yPos > heightPage - heightText + 4) {
            return;
        }
        // Apply gravity to yVelocity
        yVelocity += gravity;

        // Apply velocities to positions
        yPos += yVelocity;
        xPos += xVelocity;

        // Bounce when hitting the bottom
        if (yPos > window.innerHeight - textElement.clientHeight && yVelocity > 0) {
            yVelocity *= bounceFactor;
        }

        // Bounce when hitting the top
        if (yPos < 0 && yVelocity < 0) {
            yVelocity *= bounceFactor;
        }

        // Bounce when hitting the sides
        if (xPos < 0 || xPos > window.innerWidth - textElement.clientWidth) {
            xVelocity *= -1; // Reverse the horizontal velocity
        }

        // Set positions
        textElement.style.top = yPos + "px";
        textElement.style.left = xPos + "px";

        // Repeat animation
        requestAnimationFrame(animate);
    }

    // Start animation
    requestAnimationFrame(animate);
});
