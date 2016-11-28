var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");

/* Normal EQ
ctx.beginPath();
ctx.moveTo(0,250);
ctx.lineTo(1000,250);
ctx.stroke();
*/

/* Low Pass
ctx.beginPath();
ctx.moveTo(0,250);
ctx.lineTo(800,250);
ctx.stroke();
ctx.bezierCurveTo(801,240, 850,250, 900,500);
ctx.stroke();
*/

/* High Pass */
ctx.beginPath();
ctx.moveTo(200,500);
ctx.bezierCurveTo(250,125, 300,240, 350,250);
ctx.stroke();
ctx.lineTo(1000,250);
ctx.stroke();
