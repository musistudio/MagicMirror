var quality = new Vue({
	el: '#quality',
	data: {
		quality: '',
		aqi: '',
		city: '',
		display: ''
	},
	created: function() {
		var that = this;
		axios({
			method: 'get',
			url: 'libs/quality.php?city=' + weather.city
		}).then(function(resp) {
			that.quality = resp.data.result[0].quality;
			that.aqi = resp.data.result[0].aqi;
			that.city = resp.data.result[0].city;
		}).catch(resp => {
			console.log('请求失败：' + resp.status + ',' + resp.statusText);
		});
	}
});

function updateQuality() {
	axios({
		method: 'get',
		url: 'libs/quality.php?city=' + weather.city
	}).then(function(resp) {
		quality.quality = resp.data.result[0].quality;
		quality.aqi = resp.data.result[0].aqi;
		quality.city = resp.data.result[0].city;
	}).catch(resp => {
		console.log('请求失败：' + resp.status + ',' + resp.statusText);
	});
}