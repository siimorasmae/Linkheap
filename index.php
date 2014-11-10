<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, minimum-scale=1">
	<meta name="author" content="Siim Orasmäe">
	<title>Linkheap - Where Links Aggregate</title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/linkheap.css">
</head>

<body ng-app="linkheap" ng-controller="appController" ng-init="itemType = 0; userName = 'siimorasmae'">
	<header>
		<div id="wrap">
			<h1>
				<a href="http://pixeltouch.ee/projects/linkheap/">Linkheap</a>
				<span class="user"> / <input type="text" name="user" placeholder="user?" ng-model="userName" ng-change="userChanged = true">
				<div class="refresh" ng-click="refreshItems(itemType,userName); userChanged = false" ng-show="userChanged">&raquo;</div></span>
			</h1>
			<nav>
				<ul>
					<li ng-click="itemType = 0; refreshItems(0,userName); noItems = false" ng-class="itemType == 0 ? 'active' : ''">Latest</li><!--
					--><li ng-click="itemType = 1; refreshItems(1,userName); noItems = false" ng-class="itemType == 1 ? 'active' : ''">Favorites</li>
				</ul>
			</nav>
		</div>
	</header>

	<section id="reader" ng-show="displayLightbox">
		<article>
			<div id="reader-close" ng-click="displayLightbox = false">x</div>
			<h1 class="title">{{article.title}}</h1>
			<div class="content" ng-bind-html="article.content"></div>
			<div class="meta">Source: <a href="{{article.url}}">{{article.domain}}</a></div>
		</article>
	</section>

	<section id="content">
		<div class="loading-spinner" ng-hide="doneLoading"></div>
		<div ng-show="noItems">This feed is empty... (ಠ_ಠ)</div>
		<div id="columns">

			<article ng-repeat="item in items" ng-click="readArticle(item.link)">
				<header>
					<h2 class="reader-item">{{item.title}}</h2>
				</header>
				<p ng-bind-html="item.description"></p>
				<p class="meta">
					<time datetime="{{item.pubDate}}">{{item.pubDate | limitTo: 26}}</time>
					<a class="source" href="{{item.link}}">source</a>
				</p>
			</article>

		</div>
	</section>
	
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
	<script src="js/linkheap.js"></script>
</body>
</html>