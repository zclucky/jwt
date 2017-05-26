<?php

namespace App\Api\Transformers;


use App\Weather;
use League\Fractal\TransformerAbstract;

class WeathersTransformer extends TransformerAbstract
{
    public function transform(Weather $weather){
        return [
          '城市名称' => $weather['city'],
          '城市编码' => $weather['city_id'],
          '最低温度' => $weather['temp1'],
          '最高温度' => $weather['temp2'],
          '天气情况' => $weather['weather'],
        ];
    }
}