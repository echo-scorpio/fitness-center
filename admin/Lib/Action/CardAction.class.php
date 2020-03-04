<?php
class CardAction extends Action{
    function index(){
        $Card=M(Card);
        $cardList=$Card->field(array('cardID','cardName','validTimes','cardPrice','cardDiscount','startTime','endTime'))->order('cardID asc')->select();
        $this->assign('cardList',$cardList);
        $this->display();
    }
    function del(){
        $id=$_GET["id"];
        $Card=M(Card);
        $member=M(Member);
        $whetherDel=$member->where("vipCardId='$id'")->select();
        if($whetherDel){
            $this->error('该卡已经售出，不能删除',__ROOT__."/admin.php/Card/index",0);
        }
        else{
            $done=$Card->where("cardID='$id'")->delete();
            if ($done){
                $this->redirect('Card/index',302);
            }
            else{
                $this->error("删除失败",__ROOT__."/admin.php/Card/index",0);
            }
        }
       
       
    }

    function edit(){
        $id=$_POST['id'];
        $Card=M(Card);
        $data['cardName']=$_POST['name'];
        $data['validTimes']=$_POST['validTimes'];
        $data['cardPrice']=$_POST['price'];
        $data['cardDiscount']=$_POST['discount'];
        $data['startTime']=$_POST['startTime'];
        $data['endTime']=$_POST['endTime'];
        $done=$Card->where("cardID='$id'")->save($data);

        if($done){
            $this->redirect('Card/index',302);
            //echo $Card->getLastSql();
        }
        else{
            $this->error('修改失败');
        }
    }

    function add(){
        $Card=M('Card');
        $Card->cardName=$_POST["name"];
        $Card->validTimes=$_POST['time'];
        $Card->cardPrice=$_POST["price"];
        $Card->cardDiscount=$_POST["discount"];
        $Card->startTime=$_POST["startTime"];
        $Card->endTime=$_POST["endTime"];
        $done=$Card->add();
        //echo $Card->getLastSql();
        if($done){
            $this->redirect('Card/index',302);
        }
        else{
            $this->error("添加失败");
        }
    }
}
?>