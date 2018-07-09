//新闻模块
var news = new Vue({
	el: '#news',
	data: {
		news: config.news.news_data[0],
		enable: '',
		created: function() {
			var that = this;
			if (!config.news.enable) {
				that.enable = 'none';
				return 0;
			}
		}
	}
});
var ind_news = 0;

function updateNews() {
	var news_arr = config.news.news_data;
	if (ind_news < news_arr - 1) {
		news.news = news_arr[ind_news];
		ind_news += 1;
	} else {
		ind_news = 0;
		news_arr = news_arr[ind_news];
	}
}