var indoor = new Vue({
	el: '#indoor',
	data: {
		temp: '24',
		humidity: '66',
		display: 'none'
	},
	created: function() {
		var that = this;
		axios({
			method: 'get',
			url: 'config/temp.json'
		}).then(function(resp) {
			if (resp.data != '') {
				that.temp = resp.data.temperature;
				that.humidity = resp.data.humidity;
				that.display = '';
			} else {
				that.display = 'none';
			}
		}).catch(resp => {
			console.log('请求失败：' + resp.status + ',' + resp.statusText);
		});
	}
});

function updateTemp() {
	axios({
		method: 'get',
		url: 'config/temp.json'
	}).then(function(resp) {
		if (resp.data != '') {
			indoor.temp = resp.data.temperature;
			indoor.humidity = resp.data.humidity;
			indoor.display = '';
		} else {
			indoor.display = 'none';
		}
	}).catch(resp => {
		console.log('请求失败：' + resp.status + ',' + resp.statusText);
	});
}