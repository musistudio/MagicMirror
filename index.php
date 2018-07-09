<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>魔镜页面</title>
	<script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
	<script src="http://static.runoob.com/assets/vue/1.0.11/vue.min.js"></script>
	<script src="js/config.js"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="container" id="container">

		<!-- 日期和时间模块 -->
		<div class="time module" id="time" style="display: {{ enable }}">
			<p class="date">{{ date }}</p>
			<div class="timer"><p style="float: left;">{{ time }}</p><span style="font-size: 28px;display: block;padding-top: 8px;color: gray;">{{ seconds }}</span></div>
		</div>

		<!-- 设置二维码模块 -->
		<img src="libs/qrcode.php" id="qrcode" style="position: absolute;width: 200px;height: 200px;left: {{ left }};display: {{ display }}">

		<!-- 空气质量模块 -->
		<div class="quality module" id="quality" style="display: {{ display }}">
			<p><img src="img/quality.png" />{{ quality }} ({{ aqi }})</p>
			<p style="float: right;font-size: 15px">{{ city }}</p>
		</div>
		<!-- 天气模块 -->
		<div class="weather module" id="weather" style="display: {{ weather.enable }}">
			<div class="weather-main">
				<div style="width: 184px;font-size: 28px;color: #bdbdbd;float: right;">
					<span style="font-size: 15px;display: inline-block;float: left;margin-top: 4px;">{{ weather.winddirect }} </span> 
					<img src="img/sunset.png" style="width: 40px;height: 40px;margin-left: 12px;" /> 
				    {{ weather.sunset }}
				</div>
				<div style="width: 210px;font-size: 36px;text-align: right;">
					<img src="{{ weather.today.icon }}" style="width: 50px;height: 50px;margin-bottom: -12px;" />   {{weather.today.temp}}°
				</div>
				<div class="forecast" style="">
					<p>{{ weather.forecast[0].week }}&nbsp;&nbsp;&nbsp;  <img src="{{ weather.forecast[0].icon }}" />&nbsp;&nbsp;&nbsp;  {{ weather.forecast[0].hightemp }}&nbsp;&nbsp;  {{ weather.forecast[0].lowtemp }}</p>
					<p>{{ weather.forecast[1].week }}&nbsp;&nbsp;&nbsp;  <img src="{{ weather.forecast[1].icon }}" />&nbsp;&nbsp;&nbsp;  {{ weather.forecast[1].hightemp }}&nbsp;&nbsp;  {{ weather.forecast[1].lowtemp }}</p>
					<p>{{ weather.forecast[2].week }}&nbsp;&nbsp;&nbsp;  <img src="{{ weather.forecast[2].icon }}" />&nbsp;&nbsp;&nbsp;  {{ weather.forecast[2].hightemp }}&nbsp;&nbsp;  {{ weather.forecast[2].lowtemp }}</p>
					<p>{{ weather.forecast[3].week }}&nbsp;&nbsp;&nbsp;  <img src="{{ weather.forecast[3].icon }}" />&nbsp;&nbsp;&nbsp;  {{ weather.forecast[3].hightemp }}&nbsp;&nbsp;  {{ weather.forecast[3].lowtemp }}</p>
					<p>{{ weather.forecast[4].week }}&nbsp;&nbsp;&nbsp;  <img src="{{ weather.forecast[4].icon }}" />&nbsp;&nbsp;&nbsp;  {{ weather.forecast[4].hightemp }}&nbsp;&nbsp;  {{ weather.forecast[4].lowtemp }}</p>
				</div>
			</div>
		</div>
		<div class="setting" id="setting" style="display: {{ display }};left: {{ left }};top:{{ top }};position: absolute;font-size: 40px;" onclick="showQrcode()">
			设 置
		</div>
		<!-- 问候语模块 -->
		<div class="regard module" id="regard" style="display: {{ enable }};">{{ regards }}</div>

		<!-- 新闻模块 -->
		<div class="news module" id="news" style="display: {{ enable }}">
			<p>{{ news }}</p>
	    </div>

		<!-- 室内温湿度模块 -->
		<div class="indoor module" id="indoor" style="display: {{ display }}font-family: "MFYueHeiNoncommercial-Light", sans-serif;">
			<ul>
				<li>
					<div class="in-common">
						<img src="img/sun.png" width="75%" height="75%" style="margin-top: 14%;">
					</div>
					太阳
				</li>
				<li>
					<div class="in-common">
						{{ temp }}
					    <div style="width: 30px;height: 16px;margin-top: -13px;background-color: red;color: #fff;line-height: 16px;font-size: 15px;margin-left: 11px;border-radius: 40%;">℃</div>
					</div>
					温度
				</li>
				<li>
					<div class="in-common">
						{{ humidity }}
						<div style="width: 30px;height: 16px;margin-top: -13px;background-color: red;color: #fff;line-height: 16px;font-size: 15px;margin-left: 11px;border-radius: 40%;">%</div>
					</div>
					湿度
				</li>
				<li>
					<div class="in-common">
						<img src="img/sport.png" width="75%" height="75%" style="margin-top: 14%;">
					</div>
					人体传<br />感器
				</li>
			</ul>
			<p style="margin-top: 130px;margin-bottom: 30px;font-size: 28px">Light</p>
			<span style="margin-left: 70px" id="light1"><img src="{{ status_img }}" style="margin-right: 20px;width: 50px;height: 45px;font-size: 22px;" onclick="updateLight1()">网关灯</span><br />
			<span id="light" style="margin-left: 70px"><img src="{{ status_img }}" style="margin-right: 20px;width: 50px;height: 45px;font-size: 22px;" onclick="updateLight()">状态：{{ status }}</span>
			<p style="margin-top: 130px;margin-bottom: 30px;font-size: 28px">Air conditioner</p>
			<span style="margin-left: 70px" id="light1"><img src="{{ status_img }}" style="margin-right: 20px;width: 50px;height: 45px;font-size: 22px;" onclick="updateLight1()">卧室空调</span><br />
			<span id="light" style="margin-left: 70px"><img src="{{ status_img }}" style="margin-right: 20px;width: 50px;height: 45px;font-size: 22px;" onclick="updateLight()">客厅空调</span>

		</div>

	<script>
		var cWidth = document.body.clientWidth;
		var qrcode = new Vue({
			el: '#qrcode',
			data: {
				display: 'none',
				left: ''
			},
			created: function(){
				this.left = ((cWidth / 2) - 100) + 'px';
			}
		});
		var light = new Vue({
			el: '#light',
			data: {
				status_img: 'img/light_off.png',
				status: 'off'
			}
		});
		var light1 = new Vue({
			el: '#light1',
			data: {
				status_img: 'img/light_off.png'
			}
		});
		var setting = new Vue({
			el: '#setting',
			data: {
				display: 'none',
				left: '',
				top: ''
			}
		});
		function updateSetting(x, y){
			if(setting.display == 'none'){
				setting.top = y + 'px';
				setting.left = x + 'px';
				setting.display = '';
			}else{
				setting.display = 'none';
			}
		}
		function updateLight1(){
			if(light1.status_img == 'img/light.png'){
				light1.status_img = 'img/light_off.png';
			}else{
				light1.status_img = 'img/light.png';
			}
		}
		function updateLight(){
			if(light.status == 'off'){
				light.status = 'on';
				light.status_img = 'img/light.png';
			}else{
				light.status = 'off';
				light.status_img = 'img/light_off.png';
			}
		}
		function showQrcode(){
			if(qrcode.display == 'none'){
				qrcode.display = '';
			}else{
				qrcode.display = 'none';
			}
		}
	</script>
	<script>
		var starttime;
		var endtime;
		var startx;
		var starty;
		var isstart;
		var oContainer = document.getElementById("container");
		oContainer.onmousedown = function(event) {
			isstart = true;
			starttime = Date.parse(new Date()) / 1000;
			startx = event.x;
			starty = event.y;
		}
		oContainer.onmouseup = function() {
			isstart = false;
			endtime = Date.parse(new Date()) / 1000;
			if(endtime - starttime > 1){
				if(startx = event.x){
					updateSetting(event.x, event.y);
				}
			}else{
				if(event.x - startx > 200){
					window.location.href = 'media.html';
				}
			}
		}
	</script>
	<script src="js/time.js"></script>
	<script src="js/weather.js"></script>
	<script src="js/quality.js"></script>
	<script src="js/regard.js"></script>
	<script src="js/news.js"></script>
	<script src="js/indoor.js"></script>
	<script src="js/main.js"></script>
	<script src="js/check.js"></script>
</body>
</html>



