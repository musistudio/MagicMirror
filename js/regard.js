//问候语模块
var regard = new Vue({
	el: '#regard',
	data: {
		regards: config.regard.online.regards[0],
		enable: '',
		left: ''
	},
	created: function() {
		var that = this;
		if (!config.regard.enable) {
			that.enable = 'none';
			return 0;
		}
	}
});
var ind_regard = 0;

function updateRegard() {
	var regards_arr = config.regard.online.regards;
	if (ind_regard < regards_arr.length - 1) {
		regard.regards = regards_arr[ind_regard];
		ind_regard += 1;
	} else {
		regard.regards = regards_arr[ind_regard];
		ind_regard = 0;
	}
}