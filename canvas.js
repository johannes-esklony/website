const canvas = document.querySelector('canvas')
const c = canvas.getContext('2d')

canvas.width = window.innerWidth
canvas.height = window.innerHeight
const mouse = {
    x: undefined,
    y: undefined
}
// Event Listeners
addEventListener('mousemove', event => {
    mouse.x = event.clientX
    mouse.y = event.clientY
})
addEventListener('resize', () => {
    canvas.width = innerWidth
    canvas.height = innerHeight
    init()
})
// Objects
function Circle(x, y, radius, color, alpha) {
    this.x = x
    this.y = y
    this.radius = radius
    this.bigRadius = radius * 10
    this.color = color
    this.mouseNear = false
    this.alpha = alpha
    this.velocity = {
        x: Math.random() - 0.5, // Random x value from -0.5 to 0.5
        y: Math.random() - 0.5 // Random y value from -0.5 to 0.5
    }
}
Circle.prototype.draw = function () {
    c.beginPath()
    if(this.mouseNear){
        c.arc(this.x, this.y, this.bigRadius, 0, Math.PI * 2, false)

    }
    else{
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false)
    }

    c.fillStyle = this.color

    c.save();
    if(this.mouseNear){
        c.globalAlpha = 0.4;
    }
    c.fill()
    c.restore();
    
    c.closePath()
}
Object.prototype.update = function () {
    if(inMouseRange(this)){
        this.mouseNear = true
    }
    else{
        this.mouseNear = false
    }
    this.draw()
    this.x += this.velocity.x // Move x coordinate
    this.y += this.velocity.y // Move y coordinate
}

//functions

function inMouseRange(circle){
    if(1000 >= (mouse.x - circle.x)*(mouse.x - circle.x) + (mouse.y-circle.y) * (mouse.y-circle.y)){
        return true 
    }else{
        return false
    }
}

// Implementation
let circles = []
function init() {
    circles = []
    circlesAmount = canvas.width * canvas.height * 0.005

    for (let i = 0; i < circlesAmount; i++) {
        const x = Math.random() * canvas.width
        const y = Math.random() * canvas.height
        const radius = Math.random() * 5
        const alpha = Math.random()
        let colorRange = 50
        let rgb = {
            r: 198 + Math.random() * colorRange - (colorRange/2),
            g: 20 + Math.random() * colorRange - (colorRange/2), 
            b: 20 + Math.random() * colorRange - (colorRange/2)
        }
        const color = `rgb(${rgb.r},${rgb.g},${rgb.b}`
        circles.push(new Circle(x, y, radius, color, alpha))
    }
}
// Animation Loop
function animate() {
    requestAnimationFrame(animate) // Create an animation loop
    c.clearRect(0, 0, canvas.width, canvas.height) // Erase whole canvas
    circles.forEach(circle => {
        circle.update()
    })
}
init()
animate()