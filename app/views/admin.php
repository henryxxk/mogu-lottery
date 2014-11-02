<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>11.11抽奖管理</title>
    <link rel="stylesheet" type="text/css" href="/bower_resources/bootstrap/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #F8F8F8;
        }

        .container {
            margin-top: 50px;
        }

        .row {
            margin: 10px 0;
        }
    </style>
</head>
<body ng-app="lottery" id="top">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <a class="navbar-brand" href="#">蘑菇街抽奖管理</a>
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="#">抽奖</a>
        </li>
        <li>
            <a href="#" data-toggle="modal" data-target="#Creat">新建抽奖</a>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="row col-md-12" ng-controller="ListLotterysCtrl">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>抽奖名称</th>
                <th>奖品</th>
                <th>开奖次数</th>
                <th>每轮中奖配额</th>
                <th>当前状态</th>
                <th>可选操作</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="lottery in lotterys">

                <td>{{lottery.name}}</td>
                <td>{{lottery.gift}}</td>
                <td>{{lottery.maxrounds}}</td>
                <td>{{lottery.roundwinners}}</td>
                <td ng-if="lottery.isOpened == 0"><span class="label label-default">未开放</span> </td>
                <td ng-if="lottery.isOpened == 1"><span class="label label-info">进行中</span></td>
                <td ng-if="lottery.isOpened == 2"><span class="label label-success">已结束</span></td>
                <td ng-if="lottery.isOpened == 0"><button class="btn btn-info btn-xs" ng-click="startLottery(lottery.id)">启动</button></td>
                <td ng-if="lottery.isOpened != 0"></td>

            </tr>

            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Creat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">增加新一轮抽奖</h4>
            </div>
            <form role="form" ng-controller="AddLotteryCtrl" name="lotteryForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>抽奖名称</label>
                        <input type="text" class="form-control" ng-model="lottery.name" name="name" placeholder="抽奖名称，如GMV3000W" required/>
                    </div>
                    <div class="form-group">
                        <label>抽奖礼品</label>
                        <input type="text" class="form-control" ng-model="lottery.gift" placeholder="抽奖礼品" name="gift" required/>
                    </div>
                    <div class="form-group">
                        <label>抽奖次数</label>
                        <input type="number" class="form-control" ng-model="lottery.maxrounds" placeholder="抽奖次数" name="runround" ui-validate=" '$value >= 1' " required/>
                    </div>
                    <div class="form-group">
                        <label>每次中奖人数</label>
                        <input type="number" class="form-control" ng-model="lottery.roundwinners" placeholder="每次中奖人数" name="roundwinners" ui-validate=" '$value >= 1' " required/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" ng-click="addLotteryInfo()" ng-disabled="lotteryForm.$invalid"
                        >保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/bower_resources/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/bower_resources/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular/angular.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular-bootstrap/ui-bootstrap.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular-ui-utils/validate.min.js"></script>
<script type="text/javascript" src="/bower_resources/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>



<script type="text/javascript" src="/js/lottery.js"></script>


</body>
</html>