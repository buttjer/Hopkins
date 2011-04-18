var canvas = document.getElementById('c'),
    c = canvas.getContext('2d'),
    xs = 60,
    w = 160,
    h = 165,
    x = 0,
    y = 0,
    hsl = [];

color();
setInterval(color, 10000);

function color() {
  var date = new Date(),
      min = date.getMinutes(),
      sec = date.getSeconds() + min * 60,
      bawm = (sec - 60) / 10 | 0;

  hsl = [bawm/360, .85, .45];
  document.getElementsByTagName('html')[0].style.backgroundColor = "hsl(" + bawm + ",85%, 45%)";
}

function hue2rgb(p, q, t){
  if (t < 0) t += 1;
  if (t > 1) t -= 1;
  if (t < 1/6) return p + (q - p) * 6 * t;
  if (t < 1/2) return q;
  if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
  return p;
}

function hsl_to_rgb(h, s, l){
  var r, g, b;

  if (s == 0){
    r = g = b = l;
  }
  else {
    var q = l < 0.5 ? l * (1 + s) : l + s - l * s,
        p = 2 * l - q;

    r = hue2rgb(p, q, h + 1/3);
    g = hue2rgb(p, q, h);
    b = hue2rgb(p, q, h - 1/3);
  }
  return [r * 255 | 0, g * 255 | 0, b * 255 | 0];
}

function map(val, inMin, inMax, outMin, outMax) {
  return outMin + (outMax - outMin) * ((val - inMin) / (inMax - inMin));
}

function sfc(a) {
  c.fillStyle = 'rgb('+ a[0] + ',' + a[1] + ',' + a[2] + ')';
}

function radians(degree) {
  return degree * Math.PI/180;
}

function draw() {
  var dd = new Date(),
      ms = dd.getSeconds(),
      s = dd.getMinutes(),
      m = dd.getHours(),
      st = dd.getDay();

  x = map(ms, 0, 59, 20, xs-10);
  y = map(s, 0, 59, -xs/8, xs/4);
  x2 = map(m, 0, 23, 0, xs/4);
  y2 = map(st, 0, 31, -xs/4, xs/4);
  
  c.save();
  draw_thing();
  c.restore();
}

function r(ra) {
  c.rotate(radians(ra));
}

function l(x,y) {
  c.lineTo(x,y);
}

function t(x,y) {
  c.translate(x,y);
}

function draw_thing() {
  c.clearRect(0, 0, w, h);
  t(w/2, h/2-20);
  
  // shadow
  c.beginPath();
  c.save();
  t(0, xs/3);
  c.moveTo(0, 0);

  r(-60);
  l(0, xs);

  r(-30);
  l(-xs, 0);

  r(-30);
  l(0, -xs);

  c.closePath();
  c.restore();

  sfc(hsl_to_rgb(hsl[0], hsl[1], hsl[2]-.1));
  c.fill();

  // front
  c.beginPath();
  c.save();
  c.moveTo(0, 0);

  r(30);
  l(-x, y);

  l(-xs, 0);

  r(30);
  c.save();
  t(0, xs);

  r(-60);
  l(-x2, -xs/2-y2);
  r(60);

  l(0, 0);

  r(-30);
  l(xs-x, y);
  c.restore();

  r(30);
  l(xs, 0);

  r(-90);
  l(-x2, xs/2-y2);

  c.closePath();
  c.restore();
  sfc(hsl_to_rgb(hsl[0], hsl[1], hsl[2]));
  c.fill();

  // right
  c.beginPath();
  c.save();
  c.moveTo(0, 0);

  r(-30);
  l(xs, 0);

  r(-30);

  c.save();
  t(0, xs);
  r(60);
  l(-x2, -xs/2-y2);
  c.restore();

  l(0, xs);

  r(-30);
  l(-xs, 0);

  r(90);
  l(-x2, xs/2-y2);

  c.closePath();
  c.restore();
  sfc(hsl_to_rgb(hsl[0], hsl[1], hsl[2]+.15));
  c.fill();

  // top right
  c.beginPath();
  c.save();
  c.moveTo(0, 0);

  r(30);
  t(-x, y);
  l(0, 0);

  r(30);
  t(0, -xs);
  l(0, 0);

  r(-30);
  t(x, -y);
  l(0, 0);

  c.closePath();
  c.restore();

  sfc([255, 255, 255]);
  c.fill();

  // top left
  c.beginPath();
  c.save();
  r(30);
  c.moveTo(-xs, 0);

  t(-x, y);
  l(0, 0);

  r(30);
  t(0, -xs);
  l(0, 0);

  r(-30);
  l(-xs+x, -y);

  c.restore();
  c.closePath();
  sfc(hsl_to_rgb(hsl[0], hsl[1], hsl[2]+.35));
  c.fill();
}

(function loop() {
  draw();
  setTimeout(loop, 1000/33);
})();