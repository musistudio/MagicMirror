axios({
	method: 'get',
	url: 'libs/news.php'
}).then(function(resp) {}).catch(resp => {
	console.log('请求失败：' + resp.status + ',' + resp.statusText);
});
axios({
	method: 'get',
	url: 'libs/regard.php'
}).then(function(resp) {}).catch(resp => {
	console.log('请求失败：' + resp.status + ',' + resp.statusText);
});