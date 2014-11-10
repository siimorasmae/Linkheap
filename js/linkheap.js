
var app = angular.module('linkheap', ['ngSanitize','ngCookies']);

app.controller('appController', function($scope, $http, $cookies) {
	// init
	getItems(0,$cookies.userName ? $cookies.userName : 'siimorasmae');

	$scope.refreshItems = function(type,user) {
		getItems(type,user);
	}

	$scope.readArticle = function(url) {
		$http.jsonp('parser.php?url='+url+'&callback=JSON_CALLBACK').success(function(data) {
			$scope.article = data;
			$scope.displayLightbox = true;
		});
	}

	$scope.getCookieUser = function() {
		return $cookies.userName ? $cookies.userName : 'siimorasmae';
	}
	$scope.setCookieUser = function(user) {
		$cookies.userName = user;
	}

	function getItems(type,user) {
		$scope.doneLoading = false;
		$scope.items = [];

		if (type == 0)
			url = 'https://www.readability.com/'+user+'/latest/feed';
		else
			url = 'https://www.readability.com/'+user+'/favorites/feed';

		$http.jsonp('http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20xml%20where%20url="'+url+'"&format=json&callback=JSON_CALLBACK').success(function(data) {
			if (!data.query.results.rss.channel.item)
				$scope.noItems = true;
			else if (data.query.results.rss.channel.item.length > 0)
				$scope.items = data.query.results.rss.channel.item;
			else
				$scope.items = [data.query.results.rss.channel.item]; // if returns 1 item

			$scope.doneLoading = true;
		});
	};
});