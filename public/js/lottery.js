
var LotteryLocalService = function(){
    var localLotterys = [];

    var getLotterys = function(){
        return localLotterys;
    };

    var setLotterys = function(lotterys){
        localLotterys = lotterys;
    };

    var add = function(lottery){
        localLotterys.push(lottery);
    };

    var updateLotteryStatus = function(lotteryId,status){
        localLotterys.forEach(function(r, i) {
            if(r.id == lotteryId){ // 已经有正在进行的抽奖则不可启动
                localLotterys[i].isOpened = status;
            }
        });
    };

    var start = function(lotteryId){
        updateLotteryStatus(lotteryId,1);
    };

    var stop = function(lotteryId){
        updateLotteryStatus(lotteryId,2);
    };




    var alreadyRunning = function(){
        var haveRunning = false;
        localLotterys.forEach(function(r, i) {
            if(r.isOpened == 1){ // 已经有正在进行的抽奖则不可启动
                haveRunning = true;
                return false;
            }
        });

        return haveRunning;
    };


    return {

        getLotterys: getLotterys,
        setLotterys: setLotterys,
        add: add,
        start: start,
        stop: stop,
        alreadyRunning: alreadyRunning

    }


};



var AddLotteryCtrl = function ($scope, $http, $modal,LotteryLocalService) {
    $scope.lottery = {};

    $scope.addLotteryInfo = function(){
        $http({
            method: "POST",
            url: "/api/lottery/add",
            data: $scope.lottery,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            transformRequest: function(obj) {
                var str = [];
                for(var p in obj){
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
                return str.join("&");
            }

        }).success(function(resp){
            if(resp.state == 0){
                LotteryLocalService.add(resp.data);
                alert('抽奖信息已经添加!请关闭本窗口');
            }
        });
    };
};


var ListLotterysCtrl = function($scope,$http,LotteryLocalService){
    $scope.lotterys = [];


    $http({
        url:'/api/lottery/all',
        method:'get'
    }).success(function(response){
        if(response.state == 0){
            $scope.lotterys = response.data;
            LotteryLocalService.setLotterys($scope.lotterys);
        }
    });


    $scope.startLottery = function(lotteryId){
        var haveRunning = LotteryLocalService.alreadyRunning();

        if(!haveRunning){
            $http({
                url:'/api/lottery/start/'+lotteryId,
                method:'get'
            }).success(function(response){
                if(response.state == 0){ //启动成功
                    LotteryLocalService.start(lotteryId);
                }
            });
        }
    }

};

var NowRunningLotteryCtrl = function($scope, $http,$interval,$timeout){
    $http({
        url:'/api/lottery/nowrunning',
        method:'get'
    }).success(function(res){
        if(res.state == 0){
            if(res.data){
                $scope.nowlottery = res.data;
            }
        }
    });


    function loadInfo(){
        $http({
            url:'/api/lottery/randomemps/'+ $scope.nowlottery.id,
            method:'get'
        }).success(function(resp){
            if(resp.state == 0){
                $scope.rndemps = resp.data;
            } else{
                $scope.rndemps = [];
            }

        });
    }

    function stopTask(){
        $interval.cancel(refreshTask);
        $scope.started = false;
        if($scope.nowlottery.runround == $scope.nowlottery.maxrounds) {
            $scope.started  = true;
            $scope.roundend = true;

           $http({
               url:'/api/lottery/close/' + $scope.nowlottery.id,
               method:'post'
           }).success(function(resp){
               if(resp.state == 0){
               }

           });
        }

        var data = {};
        data.lotteryId = $scope.nowlottery.id;
        data.winners = $scope.rndemps;
        data.runround = $scope.nowlottery.runround;

        $http({
            url:'/api/lottery/updatewinner',
            method:'post',
            data:data,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            transformRequest: function(obj) {
                var str = [];
                for(var p in obj){
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
                return str.join("&");
            }
        }).success(function(resp){


        });

    }


    var refreshTask ;
    $scope.started = false;

    $scope.startround = function(){
        refreshTask = $interval(loadInfo, 100);
        $scope.started = true;
        //$timeout( stopTask,10000);
        $scope.nowlottery.runround++;
    };

    $scope.stopRound = function(){
        stopTask();
    }
};

var lotteryServices = angular.module('lottery.services',[]);
lotteryServices.factory('LotteryLocalService',[LotteryLocalService]);

var lotteryControllers = angular.module('lottery.controllers', []);

lotteryControllers.controller('AddLotteryCtrl', ['$scope', '$http', '$modal', 'LotteryLocalService', AddLotteryCtrl]);
lotteryControllers.controller('ListLotterysCtrl', ['$scope', '$http', 'LotteryLocalService', ListLotterysCtrl]);
lotteryControllers.controller('NowRunningLotteryCtrl', ['$scope', '$http', '$interval','$timeout', NowRunningLotteryCtrl]);

var app = angular.module('lottery', [ 'ui.bootstrap','ui.validate','lottery.services', 'lottery.controllers']);




