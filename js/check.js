function checkStatus() {
	axios({
		method: 'get',
		url: 'config/config.json'
	}).then(function(resp) {
		// 检测新闻模块是否启用
		if (resp.data.news.enable) {
			news.enable = "";
			if (timerID5 == null) {
				console.log("创建timerID5");
				timerID5 = setInterval(updateNews, 300000); // 5分钟更新一次新闻
			}
		} else {
			news.enable = "none";
			timerID5 = window.clearInterval(timerID5);
		}
		// 检测问候语模块是否启用
		if (resp.data.regard.enable) {
			regard.enable = "";
			if (timerID3 == null) {
				console.log("创建timerID3");
				timerID3 = setInterval(updateRegard, 300000); // ５分钟更新一次问候语
			}

		} else {
			regard.enable = "none";
			timerID3 = window.clearInterval(timerID3);
		}
		// 检测天气模块是否启用
		if (resp.data.weather.enable) {
			weather.weather.enable = "";
			quality.display = '';
			weather.city = resp.data.weather.location;
			if (timerID7 == null) {
				console.log("创建timerID7");
				timerID7 = setInterval(updateWeather, 15000); //1５秒更新一次天气
				timerID12 = setInterval(updateQuality, 15000);
			}
		} else {
			weather.weather.enable = "none";
			quality.display = 'none';
			timerID7 = window.clearInterval(timerID7);
			timerID12 = window.clearInterval(timerID11);
		}
		// 检测时间日期模块是否启用
		if (resp.data.datetime.enable) {
			clock.enable = "";
			if (timerID1 == null) {
				console.log("创建timerID1");
				timerID1 = setInterval(updateTime, 1000); //１秒更新一次时间
			}
		} else {
			clock.enable = "none";
			timerID1 = window.clearInterval(timerID1);
		}
		// 检测温湿度模块是否可用
		if (resp.data.indoor_temp.enable) {
			indoor.display = "";
			if (timerID8 == null) {
				console.log("创建timerID8");
				timerID8 = setInterval(updateTemp, 10000); //１0秒更新一次
			}
		} else {
			indoor.display = "none";
			window.clearInterval(timerID8);
		}
	}).catch(resp => {
		console.log('请求失败：' + resp.status + ',' + resp.statusText);
	});
	// if (photo.display != 'none') {
	// 	if (timerID9 == null) {
	// 		timerID9 = setInterval(updatePhoto, 5000);
	// 	}
	// } else {
	// 	window.clearInterval(timerID9);
	// }
	var timerID4 = setTimeout(checkStatus, 1000);
}
checkStatus();