<?php

class LotteryController extends BaseController {

    public function all(){
        $resp = $this->_result(0,null,Lotterys::all());
        return Response::json($resp);
    }

    public function add(){
        $lottery = Lotterys::create(Input::all());
        $resp = array();
        if(empty($lottery)){

        } else {
            $resp = $this->_result(0,'新增轮次抽奖成功',$lottery);
        }

        return Response::json($resp);
    }


    public function start($id){
        $resp = array();
        $lotterys = Lotterys::find($id);
        $lotterys['isOpened'] = 1;

        $res = $lotterys->save();
        if($res){
            $resp =  $this->_result(0,null,$res);
        } else {

        }
        return Response::json($resp);
    }

    public function nowrunning(){
        $lottery = Lotterys::where('isOpened','=',1)->first();
        $resp = $this->_result(0,null,$lottery);
        return Response::json($resp);
    }

    public function rndEmps($id){
        $lottery = Lotterys::find($id);

        $allemps = array('刘德华','张曼玉','林青霞','黎明','张学友','郭富城','黄日华','陈奕迅','李宗盛','吴镇宇','张耀扬','李连杰');


        $winners = LotterysWinners::all();

        $win = array();
        if(sizeof($winners) > 0){ // 如果有人中奖过,过滤掉已经中奖的用户信息
            foreach($winners as $winner){
                $win = array_merge($win,explode(',',$winner['lottery_winners']));
            }

            $res = array_diff($allemps,$win);
            unset($allemps);
            $allemps = $res;
        }

        $rand_list = array_rand($allemps,$lottery['roundwinners']);

        $winner_array = array();
        if(is_array($rand_list)){
            foreach ($rand_list as $key) {
                $winner_array[] = $allemps[$key];
            }
        } else {
            $winner_array[] =  $allemps[$rand_list];
        }

        $resp = $this->_result(0,null,$winner_array);


        return Response::json($resp);


    }


    public function updateWinner(){
        $resp = array();

        $input = Input::all();
        $lotteryWinners = new LotterysWinners();
        $lotteryWinners->lottery_id = $input['lotteryId'];
        $lotteryWinners->lottery_round = $input['runround'];
        $lotteryWinners->lottery_winners = $input['winners'];
        $res = $lotteryWinners->save();
        if($res){
            $resp = $this->_result(0, null, $res);
        } else {

        }

        return Response::json($resp);
    }

    public function closeRound($id){
        $resp = array();
        $lotterys = Lotterys::find($id);
        $lotterys['isOpened'] = 2;

        $res = $lotterys->save();
        if($res){
            $resp = $this->_result(0, null, $res);
        } else {

        }

        return Response::json($resp);

    }




}