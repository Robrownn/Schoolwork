var c = document.getElementById("myCanvas");
var image = document.getElementById("troll");
var ctx = c.getContext("2d");
ctx.drawImage(image,0,0);

var interval = 0;
var angle = 0;

interval = setInterval("rotateYAxis()", 1000/60);

function rotateYAxis() {
  angle = angle + 1;
  c.style.transform = "rotate3d(0,1,0,"+ angle + "deg)";
  if (angle == 360) {
    angle = 0;
  }
}
