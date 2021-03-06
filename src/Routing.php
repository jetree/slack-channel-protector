<?php

namespace YowayowaEnginners\SlackChannelProtector;

class Routing
{
  public static function detect(array $data)
  {
    if(isset($data["type"]) && $data["type"] === 'url_verification'){
      return UrlVerification::class;
    };

    if(isset($data["event"]["bot_id"])){
      exit; // 自分自身(bot)のメッセージは処理しない
    }

    if(isset($data["event"]["channel"])){
      return WhetherToProtect::class;
    }
  }

  public static function exec($data)
  {
    self::detect($data)::run($data);
  }
}
