var timerID1;
var timerID5;
var timerID3;
var timerID7;
var timerID9;
var images = [];


function getTimeStamp() {
	return Date.parse(new Date()) / 1000;
}
//拖动模块js代码
var oModules = document.getElementsByClassName('module');
for (var i = 0; i < oModules.length; i++) {
	oModules[i].draggable = 'true';
	(function(i) {
		oModules[i].addEventListener("dragstart", function(e) {
			offsetX = e.offsetX;
			offsetY = e.offsetY;
			oModules[i].style.border = "1px solid #fff";
		}, true)
		oModules[i].addEventListener("drag", function(e) {
			var x = e.pageX;
			var y = e.pageY;
			if (x == 0 && y == 0) {
				return;
			}
			x -= offsetX;
			y -= offsetY;
			oModules[i].style.left = x + 'px';
			oModules[i].style.top = y + 'px';
			oModules[i].style.border = "0";
		}, true);
		return false;
	})(i);
}