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

const links = document.querySelectorAll('a')
highlight = false
links.forEach(function(element) {
    element.addEventListener("mouseover", setHighlight);
});

function setHighlight(){
    highlight = true
}
links.forEach(function(element) {
    element.addEventListener("mouseleave", unsetHighlight);
});
function unsetHighlight(){
    highlight = false
}
// links.onmouseover = function(){
//     highlight = true;
// }
// links.onmouseout = function(){
//     highlight = false;
// }

// Objects
function Circle(x, y, radius, color, color2, color3, alpha) {
    this.x = x
    this.y = y
    this.radius = radius
    this.bigRadius = radius * 5
    this.color = color
    this.color2 = color2
    this.color3 = color3
    this.mouseNear = false
    this.recentlyhovered = false
    this.alpha = alpha
    this.velocityMax = 0.01 //px per s
    this.velocity = {
        x: Math.random() * this.velocityMax - (this.velocityMax / 2), // Random x value from -0.25 to 0.25
        y: Math.random() * this.velocityMax - (this.velocityMax / 2) // Random y value from -0.25 to 0.25
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

    c.save();
    c.globalAlpha = 0//this.alpha;

    if(!this.recentlyhovered || highlight){
        c.fillStyle = this.color

    }
    else{
        c.fillStyle = this.color2
        c.globalAlpha = this.alpha;

    }
    
    if(this.mouseNear){
        c.globalAlpha = 0.4;
        if(highlight){
            c.fillStyle = this.color3
            c.globalAlpha = 0.9;
        }
        this.recentlyhovered = true
        var _this = this
        setTimeout(function(){_this.recentlyhovered = false}, 1000)
    }
    c.fill()
    c.restore();
    
    c.closePath()
}
Object.prototype.update = function (deltatime) {
    if(inMouseRange(this)){
        this.mouseNear = true
    }
    else{
        this.mouseNear = false
    }
    this.draw()

    this.x += (this.velocity.x * deltatime) // Move x coordinate
    this.y += (this.velocity.y * deltatime) // Move y coordinate

    this.x = this.x % canvas.width
    this.y = this.y % canvas.height
}

//functions

function inMouseRange(circle){
    range = 1000
    if(range >= (mouse.x - circle.x)*(mouse.x - circle.x) + (mouse.y-circle.y) * (mouse.y-circle.y)){
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

        let rgb2 = {
            r: 200 + Math.random() * colorRange - (colorRange/2),
            g: 50 + Math.random() * colorRange - (colorRange/2), 
            b: 200 + Math.random() * colorRange - (colorRange/2)
        }
        const color2 = `rgb(${rgb2.r},${rgb2.g},${rgb2.b}`

        let rgb3 = {
            r: 200 + Math.random() * colorRange - (colorRange/2),
            g: 200 + Math.random() * colorRange - (colorRange/2), 
            b: 200 + Math.random() * colorRange - (colorRange/2)
        }
        const color3 = `rgb(${rgb3.r},${rgb3.g},${rgb3.b}`

        circles.push(new Circle(x, y, radius, color, color2, color3, alpha))
    }
}
// Animation Loop
let timestamp
function animate() {
    requestAnimationFrame(animate) // Create an animation loop
    c.clearRect(0, 0, canvas.width, canvas.height) // Erase whole canvas
    let dn = Date.now()
    if(timestamp === undefined){
        deltatime = 0
    }else {
        deltatime = dn - timestamp
    }
    timestamp = dn;
    circles.forEach(circle => {
        circle.update(deltatime)
    })
}
init()
animate()