function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

var Stylechooser = function() {
	var obj = this;

    this.allowedStyles = ['#3498db','#fdb145','#87D37C','#b46acf','#F5D76E'];
	this.loadColor = function() {
		var cookieBackground = getCookie("background");
		if(cookieBackground.length > 3) {
			document.body.style.backgroundColor = cookieBackground;
		} else {
			document.body.style.backgroundColor = "rgb(52, 152, 219)"; // DEFAULT
		}
	};

	this.changeBackground = function(color) {
		var background = color.substr(1, color.length);
		var currentBG = document.body.style.backgroundColor.toString();
		currentBG = currentBG.substring(4, currentBG.length-1).replace(/ /g, '').split(',');
		currentBG = this.rgb2hex(currentBG[0], currentBG[1], currentBG[2]);
		currentBG = currentBG.substr(0, currentBG.length);
		var bgRGB = this.hex2rgb(background);


		if(this.allowedStyles.indexOf(color) >= 0) {
			if(currentBG.toUpperCase() != background.toUpperCase()) {
				this.fadeColor("background",currentBG,background);
				setCookie("background", 'rgb(' + bgRGB[0] + ',' + bgRGB[1] + ',' + bgRGB[2] + ')', 30);
			}
		}
	};

	this.fadeColor = function(element,start,end,steps,speed) {
		  var startrgb,endrgb,er,eg,eb,step,rint,gint,bint,step;
		  var target = document.body;
		  steps = steps || 20;
		  speed = speed || 20;
		  clearInterval(target.timer);
		  endrgb = this.hex2rgb(end);
		  er = endrgb[0];
		  eg = endrgb[1];
		  eb = endrgb[2];
		  if(!target.r) {
			startrgb = this.hex2rgb(start);
			r = startrgb[0];
			g = startrgb[1];
			b = startrgb[2];
			target.r = r;
			target.g = g;
			target.b = b;
		  }
		  rint = Math.round(Math.abs(target.r-er)/steps);
		  gint = Math.round(Math.abs(target.g-eg)/steps);
		  bint = Math.round(Math.abs(target.b-eb)/steps);
		  if(rint == 0) { rint = 1 }
		  if(gint == 0) { gint = 1 }
		  if(bint == 0) { bint = 1 }
		  target.step = 1;

		  var object = this;
		  target.timer = setInterval( function() { object.animateColor(element,steps,er,eg,eb,rint,gint,bint) }, speed);
	};

	this.hex2rgb = function(color) {
	 	var rgb = [parseInt(color.substring(0,2),16),
		parseInt(color.substring(2,4),16),
		parseInt(color.substring(4,6),16)];
	 	return rgb;
	};

	this.rgb2hex = function(r, g, b) {
    	var bin = r << 16 | g << 8 | b;
		return (function(h){
			return new Array(7-h.length).join("0")+h
		})(bin.toString(16).toUpperCase());
	};

	this.animateColor = function(element, steps, er, eg, eb, rint, gint, bint) {
		var target = document.body;
		var color;

		if(target.step <= steps) {
			var r = target.r;
			var g = target.g;
			var b = target.b;

			if(r >= er) {
				r = r - rint;
			} else {
				r = parseInt(r) + parseInt(rint);
			}

			if(g >= eg) {
				g = g - gint;
			} else {
				g = parseInt(g) + parseInt(gint);
			}

			if(b >= eb) {
				b = b - bint;
			} else {
				b = parseInt(b) + parseInt(bint);
			}

			color = 'rgb(' + r + ',' + g + ',' + b + ')';

			if(element === 'background') {
				target.style.backgroundColor = color;
			}

			target.r = r;
			target.g = g;
			target.b = b;
			target.step = target.step + 1;
		  } else {
			clearInterval(target.timer);
			color = 'rgb(' + er + ',' + eg + ',' + eb + ')';

			if(element === 'background') {
				target.style.backgroundColor = color;
			}
		  }
	};
};
