<!DOCTYPE html>
<html>
<head>
	<title>Evaluation Form</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<style type="text/css">
		.red {
			color: red;
		}
		.no-padding {
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
		.table-listing tr td {
			padding-left: 5px;
			padding-right: 5px;
			min-width: 80px;
		}
		.header-content {
			background: #fff;
		}
		.en-form {
		    background: #fff;
		    padding-top: 35px;
		    padding-bottom: 25px;
		}
		.user-form {
		    padding: 15px 0;
		    border-bottom: 1px solid #ccc;
		    margin-bottom: 15px;
		    border-top: 1px solid #ccc;
		}
		.alert-popup {
		    position: fixed;
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 100vh;
		    background: #1d1c1c96;
		    display: none;
		}
		.message-popup {
		    max-width: 700px;
		    background: #fff;
		    position: absolute;
		    left: 50%;
		    top: 25px;
		    transform: translateX(-50%);
		    padding: 25px 20px;
		    border-radius: 10px;
		}
		.banner {
			position: relative;
		}
		.banner img {
			width: 100%;
		}
		.banner-title {
		    position: absolute;
		    top: 50%;
		    font-weight: bold;
		    color: #fff;
		    transform: translateY(-50%);
		    margin: 0;
		    text-align: center;
		    width: 100%;
		    padding: 0px 15px;
		}
		.header-desc {
		    padding: 0px 30px;
		    padding-top: 25px;
		}
		.table-listing tr td.td-no {
		    min-width: 50px;
		    width: 50px;
		}
		td.td-audio {
		    width: 330px;
		}
	</style>
</head>
<body style="background: #f1f1f1;">
	<div class="header-content container no-padding">
		<div class="banner">
			<img src="images/banner.jpg">
			<h3 class="banner-title">Speech Synthesiser Evaluation Poll</h3>
		</div>
		<div class="header-desc">
			<p class="text-center">Hello! And thanks for agreeing to participate in the evaluation of the text-to-speech models for our student project.</p>
			<p>Please fill in your data, listen to the track and select the best corresponding value in the chart to the right. We estimate the survey would take you no longer than 15 minutes.</p>
			<p>Explain each metric, in particular the exptremeties. Text to be updated.</p>
		</div>
	</div>
	<div class="container en-form" ng-app="homeApp" ng-controller="formCtrl" ng-init="init()">
		<!-- <h3 class="text-center" style="padding: 15px 0">Form</h3> -->
		<div class="user-form">
			<div class="col-md-6">
				<div class="form-group">
					<label>First Name <b class="red">*</b></label>
					<input type="text" class="form-control" ng-model="evaluation.f_name">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Last Name <b class="red">*</b></label>
					<input type="text" class="form-control" ng-model="evaluation.l_name">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label> Level </label>
					<select class="form-control" ng-model="evaluation.level">
						<option value="" disabled>Select your level</option>
						<option value="Student">Student</option>
						<option value="Expert">Expert</option>
						<option value="NLP">NLP</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label> Choose your language </label>
					<select class="form-control" ng-model="evaluation.language" ng-change="selectLanguage()">
						<option value="" disabled>Language</option>
						<option value="en">English</option>
						<option value="fr">France</option>
					</select>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="list-data">
			<div class="table-list">
				<table class="table-listing">
					<thead>
						<tr>
							<th>No</th>
							<th>Audio</th>
							<th>Speaker</th>
							<th>Emotion</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="audio in data track by $index">
							<td class="td-no">{{$index + 1}}</td>
							<td class="td-audio">
								<b>{{audio.name}}</b><br>
								<audio controls="">
									<source ng-src="{{audio.url}}">
								</audio>
							</td>
							<td>
								<label>Speaker </label> 
								<label><input type="range" ng-model="audio.speaker" min="0" max="5"></label>
								<label>{{audio.speaker}}</label>
							</td>
							<td>
								<label>Emotion </label> 
								<label><input type="range" ng-model="audio.emotion" min="0" max="5"></label>
								<label>{{audio.emotion}}</label>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="" style="padding-top: 15px;">
					<button class="btn btn-success" ng-click="addFeedback($event)" ng-if="data.length > 0">Submit</button>
					<!-- <button class="btn btn-success" ng-click="alertPopup()">Alert</button> -->
					<button class="btn btn-success" disabled ng-if="data.length <= 0">Submit</button>
				</div>
			</div>
	 	</div>
	 	<!-- ./list-data -->
		<?php include("modal/index/more-language.php"); ?>
	 	
	</div>
</body>
</html>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://static.filestackapi.com/v3/filestack.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
	var app = angular.module('homeApp', []);
	app.controller('formCtrl', function($scope, $http, $timeout) {
		$scope.data = [];
		$scope.paginationDisplay = [];
		$scope.dataEntry = 50;
		$scope.dataPagination = 0;
		$scope.currentPage = 1;
		$scope.evaluation = {};

		$scope.feedLanguage = [];
		$scope.filter = {
			"language": "en"
		};

		$scope.init = function() {
			$scope.evaluation = $scope.simpleEvaluation();
			// $scope.getData(1);
			// $scope.countData();
		}

		$scope.getData = function(page) {
			$scope.data = [];
			var url = "ajax/audio.php?entry="+$scope.dataEntry+"&page="+page;
			angular.forEach($scope.filter, function(value, key) {
				if (value.trim() != "") {
					url += "&"+key+"="+value;
				}
			});

			$http({
				method: 'GET',
				url: url
			}).then(function successCallback(response) {
				var data = response.data;
				for (var i = 0; i < data.length; i++) {
					data[i].speaker = 0;
					data[i].emotion = 0;
					$scope.data.push(data[i]);
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		}

		$scope.selectLanguage = function() {
			var lang = $scope.evaluation.language;
			$scope.filter.language = lang;
			$scope.getData(1);
		}

		$scope.simpleEvaluation = function() {
			var data = {
				"f_name": "",
				"l_name": "",
				"language": "",
				"level": "",
				"evaluation": []
			}

			return data;
		}

/* ---- FEEDBACK BLOG -------------------------------------- */
		$scope.addFeedback = function(event) {
			var me = event.target;
			if ($scope.evaluation.f_name.trim() == "") {
				alert("First name request.");
				return 0;
			} else if ($scope.evaluation.l_name.trim() == "") {
				alert("Last name request");
				return 0;
			} else if ($scope.evaluation.language == "") {
				alert("Please select language.");
				return 0;
			}
			$(me).prop("disabled", true);
			$(me).html("Submitting");
			var audio = angular.copy($scope.data);
			for (var i = 0; i < audio.length; i++) {
				audio[i].speaker =  audio[i].speaker.toString();
				audio[i].emotion =  audio[i].emotion.toString();
			}
			$scope.evaluation.evaluation = angular.copy(audio);
			var data = angular.copy($scope.evaluation);
			data.type = "2";

			var url = "ajax/audio_feedback.php";
			$http({
				method: 'POST',
				url: url,
				data: JSON.stringify(data),
				headers: {
				   'Content-Type': 'application/json'
				}
			}).then(function successCallback(response) {
				$(me).prop("disabled", false);
				$(me).html("Submit");
				$scope.checkLanguage(data.language);
				$scope.alertPopup();
			}, function errorCallback(response) {
				console.log(response);
				$(me).prop("disabled", false);
				$(me).html("Submit");
			});
		}

		$scope.moreFeedback = function() {
			$scope.closePopup();
			var lg = $scope.filter.language;
			var lang = {
				"en": "fr",
				"fr": "en"
			};
			$scope.evaluation.language = lang[lg];
			$scope.selectLanguage()
			$scope.evaluation.evaluation = [];
		}

		$scope.checkLanguage = function(lang) {
			if ($scope.feedLanguage.indexOf(lang) < 0) {
				$scope.feedLanguage.push(lang);
			}
		}

		$scope.alertPopup = function() {
			if ($scope.feedLanguage.length >= 2) {
				alert("Thank you for your evaluation.");
				return 0;
			}
			$(".alert-popup").css('display', 'block');
		}

		$scope.closePopup = function() {
			$(".alert-popup").css('display', 'none');
			setTimeout(function() {
				if ($scope.feedLanguage.length >= 2) {
					alert("Thank you for your evaluation.");
					return 0;
				}
			}, 500);
		}
/* ---- END FEEDBACK BLOG ---------------------------------- */
	});
</script>