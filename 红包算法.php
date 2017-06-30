<?php
// $bonus_total 红包总金额
// $bonus_count 红包个数
// $bonus_type 红包类型 1=拼手气红包 0=普通红包

function randBonus($bonus_total=0, $bonus_count=3, $bonus_type=1){
  $bonus_items  = array(); // 将要瓜分的结果
  $bonus_balance = $bonus_total; // 每次分完之后的余额
  $bonus_avg   = number_format($bonus_total/$bonus_count, 2); // 平均每个红包多少钱
  $i       = 0;
  while($i<$bonus_count){
    if($i<$bonus_count-1){
      $rand      = $bonus_type?(rand(1, $bonus_balance*100-1)/100):$bonus_avg; // 根据红包类型计算当前红包的金额
      $bonus_items[] = $rand;
      $bonus_balance -= $rand;
    }else{
      $bonus_items[] = $bonus_balance; // 最后一个红包直接承包最后所有的金额，保证发出的总金额正确
    }
    $i++;
  }
  return $bonus_items;
}

// 发3个拼手气红包，总金额是100元
$bonus_items  = randBonus(100, 3, 1);
// 查看生成的红包
var_dump($bonus_items);
// 校验总金额是不是正确，看看微信有没有坑我们的钱
var_dump(array_sum($bonus_items));
?>
