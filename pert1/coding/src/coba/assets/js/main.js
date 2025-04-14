const canvas = document.querySelector("canvas");
const ctx = canvas.getContext("2d");
const pointer = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
const cursor = document.getElementById("cursor");

const params = {
    pointsNumber: 40,
    widthFactor: 0.6,
    spring: 0.4,
    friction: 0.5
};

const trail = new Array(params.pointsNumber).fill().map(() => ({ x: pointer.x, y: pointer.y, dx: 0, dy: 0 }));

function updateMousePosition(x, y) {
    pointer.x = x;
    pointer.y = y;
}

window.addEventListener("mousemove", (e) => updateMousePosition(e.pageX, e.pageY));
window.addEventListener("touchmove", (e) => updateMousePosition(e.touches[0].pageX, e.touches[0].pageY));

document.addEventListener("mousemove", (e) => {
    cursor.style.left = `${e.pageX}px`;
    cursor.style.top = `${e.pageY}px`;
});

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    trail.forEach((p, i) => {
        const prev = i === 0 ? pointer : trail[i - 1];
        p.dx += (prev.x - p.x) * params.spring;
        p.dy += (prev.y - p.y) * params.spring;
        p.dx *= params.friction;
        p.dy *= params.friction;
        p.x += p.dx;
        p.y += p.dy;
    });

    ctx.lineCap = "round";
    ctx.strokeStyle = "red";
    ctx.lineWidth = 8;
    ctx.beginPath();
    ctx.moveTo(trail[0].x, trail[0].y);

    for (let i = 1; i < trail.length - 1; i++) {
        const xc = (trail[i].x + trail[i + 1].x) / 2;
        const yc = (trail[i].y + trail[i + 1].y) / 2;
        ctx.quadraticCurveTo(trail[i].x, trail[i].y, xc, yc);
        ctx.lineWidth = params.widthFactor * (params.pointsNumber - i);
    }
    ctx.stroke();
    requestAnimationFrame(animate);
}

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

window.addEventListener("resize", resizeCanvas);
resizeCanvas();
animate();