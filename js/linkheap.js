
var app = angular.module('linkheap', ['ngSanitize']);

app.controller('appController', function($scope, $http) {
	getItems(0,'siimorasmae');

	$scope.refreshItems = function(type,user) {
		getItems(type,user);
	}

	$scope.readArticle = function(url) {
		$http.jsonp('parser.php?url='+url+'&callback=JSON_CALLBACK').success(function(data) {
			$scope.article = data;
			$scope.displayLightbox = true;
		});
	}

	function getItems(type,user) {
		$scope.doneLoading = false;
		$scope.items = [];

		if (type == 0) {
			url = 'https://www.readability.com/'+user+'/latest/feed';
		}
		else {
			url = 'https://www.readability.com/'+user+'/favorites/feed';
		}

		$http.jsonp('http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20xml%20where%20url="'+url+'"&format=json&callback=JSON_CALLBACK').success(function(data) {
			$scope.items = data.query.results.rss.channel.item;
			$scope.doneLoading = true;
		});
	};
});