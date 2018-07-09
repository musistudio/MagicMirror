//获取配置
function getData(url) {
	var oReq = new XMLHttpRequest();
	oReq.open("GET", url, false);
	oReq.send(null);
	return oReq.responseText;
}
getData("libs/news.php");
getData("libs/regard.php");
var config = eval('(' + getData("config/config.json") + ')');