<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>11.11抽奖</title>
    <link rel="stylesheet" type="text/css" href="/bower_resources/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/double11.css">
</head>
<body ng-app="lottery" id="top" ng-controller="NowRunningLotteryCtrl" >
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 title" ng-if="nowlottery" >

        <h1><img src="/img/double11_logo.png" alt="double11 logo" />
            {{nowlottery.name}} 抽奖</h1>
        <h4 ng-hide="roundend">当前为本轮第{{nowlottery.runround}}次,
            本轮共{{nowlottery.maxrounds}}次</h4>
        <h4 ng-show="roundend">本轮抽奖已经全部结束</h4>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 title" ng-if="!nowlottery" >

        <h1><img src="/img/double11_logo.png" alt="double11 logo" />
        </h1>
        <h4>抽奖尚未开始</h4>
    </div>
</div>
<div class="container" >

    <div class="row"   ng-repeat="emp in rndemps">
        <div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-1 person">
            {{emp}}
        </div>
    </div>
</div>
<div class="footer">
    <div class="row">
        <div class="col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 logo">
            <img src="/img/logo.png" alt="logo" />
        </div>
    </div>
</div>
<div class="buttons" ng-if="nowlottery">
    <button class="btn btn-block btn-default" ng-click="startround()" ng-show="!started"><span class="glyphicon glyphicon-play"></span>开始</button>
    <!--    <button class="btn btn-block btn-default" ng-show="started" ng-click="stopround()"><span class="glyphicon glyphicon-stop"></span>停止</button>-->
</div>
<style type="text/css">
    .buttons{
        position: fixed;
        width: 150px;
        right: 5%;
        bottom: 10px;
    }
</style>


<script type="text/javascript" src="/bower_resources/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/bower_resources/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular/angular.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular-bootstrap/ui-bootstrap.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular-ui-utils/validate.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>



<script type="text/javascript" src="/js/lottery.js"></script>
</body>
</html>