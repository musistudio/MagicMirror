//时间日期模块js代码
var clock = new Vue({
	el: '#time',
	data: {
		time: '',
		date: '',
		seconds: '',
		enable: ''
	},
	created: function() {
		var that = this;
		if (!config.datetime.enable) {
			that.enable = 'none';
		}
	}
});

var week = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];

function updateTime() {
	var cd = new Date();
	clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2);
	clock.date = week[cd.getDay()] + ',' + zeroPadding(cd.getFullYear(), 4) + '年' + zeroPadding(cd.getMonth() + 1, 2) + '月' + zeroPadding(cd.getDate(), 2) + '日';
	clock.seconds = zeroPadding(cd.getSeconds(), 2);
};

function zeroPadding(num, digit) {
	var zero = '';
	for (var i = 0; i < digit; i++) {
		zero += '0';
	}
	return (zero + num).slice(-digit);
}