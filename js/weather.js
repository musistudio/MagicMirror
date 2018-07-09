var weather = new Vue({
	el: '#weather',
	data: {
		weather: {
			"enable": "",
			"city": "",
			"winddirect": "",
			"sunset": "",
			"today": {
				"icon": "",
				"temp": ""
			},
			"forecast": [{
				"week": "",
				"icon": "",
				"hightemp": "",
				"lowtemp": "",
			}, {
				"week": "",
				"icon": "",
				"hightemp": "",
				"lowtemp": "",
			}, {
				"week": "",
				"icon": "",
				"hightemp": "",
				"lowtemp": "",
			}, {
				"week": "",
				"icon": "",
				"hightemp": "",
				"lowtemp": "",
			}, {
				"week": "",
				"icon": "",
				"hightemp": "",
				"lowtemp": "",
			}]
		}
	},
	created: function() {
		var that = this;
		that.city = config.weather.location;
		if (!config.weather.enable) {
			that.weather.enable = 'none';
		}
		axios({
			method: 'get',
			url: 'libs/weather.php?city=' + that.city
		}).then(function(resp) {
			var result = resp.data.result;
			that.weather.winddirect = result.winddirect;
			that.weather.sunset = result.daily[0].sunset;
			for (var i = 0; i < that.weather.forecast.length; i++) {
				that.weather.today.icon = "img/" + result.weather + ".png";
				that.weather.today.temp = result.temp;
				that.weather.forecast[i].week = result.daily[i].week;
				that.weather.forecast[i].icon = "img/" + result.daily[i].day.weather + ".png";
				that.weather.forecast[i].hightemp = result.daily[i].day.temphigh;
				that.weather.forecast[i].lowtemp = result.daily[i].night.templow;
			}
		}).catch(resp => {
			console.log('请求失败：' + resp.status + ',' + resp.statusText);
		});
	}
});


function updateWeather() {
	axios({
		method: 'get',
		url: 'libs/weather.php?city=' + weather.city
	}).then(function(resp) {
		var result = resp.data.result;
		weather.weather.winddirect = result.winddirect;
		weather.weather.sunset = result.daily[0].sunset;
		for (var i = 0; i < that.weather.forecast.length; i++) {
			weather.weather.forecast[i].week = result.daily[i].week;
			weather.weather.forecast[i].icon = "img/" + result.daily[i].day.weather + ".png";
			weather.weather.forecast[i].hightemp = result.daily[i].day.temphigh;
			weather.weather.forecast[i].lowtemp = result.daily[i].night.templow;
		}
	}).catch(resp => {
		console.log('请求失败：' + resp.status + ',' + resp.statusText);
	});
}