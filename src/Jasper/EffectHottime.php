<?php

namespace Jasper;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Utils;
use onebone\economyapi\EconomyAPI;
use ifteam\RankManager\rank\RankProvider;

class EffectHottime extends PluginBase implements Listener {
public function onEnable() {
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
if(!Utils::getURL("https://raw.githubusercontent.com/yonggyu/EffectHottime/master/VersionCheck.yml") == "2.0") {
    	$this->getLogger()->alert("최신버전의 플러그인을 사용하십시오! 이 버젼은 오류가 날 수 있습니다. 플러그인을 비활성화합니다..");    	$this->getServer()->disablePlugin($this);
    }
    $this->getLogger()->notice("최신버전의 플러그인을 사용중입니다.");
      $this->getLogger()->info("버프핫타임 플러그인이 실행되었습니다!");
    }

   public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
      $cmd = $command->getName();
      $tag = "§f[ §b버프핫타임 ] §f";
          if ($cmd === "버프핫타임") {
 
 
   if(!is_numeric($args[0]) or !is_numeric($args[1]) or !is_numeric($args[2]) or !isset($args[3])){
$sender->sendMessage("§f[ §b버프핫타임 ] /버프핫타임 <이펙트코드> <초> <강도> <이펙트이름>");
return;
}else{
foreach( $this->getServer()->getOnlinePlayers() as $player ) {
$player->addEffect (Effect::getEffect ( $args[0] )->setDuration ( $args[1]*20 )->setAmplifier($args[2]));
            $this->getServer()->broadcastMessage($tag.$sender->getName()."님이 핫타임으로 ".$args[3]." 버프를 ".$args[1]."초로 강도 ".$args[2]."을(를) 주었습니다.");

}
return true;
         }
     }

if ($cmd === "머니핫타임") {
if(!is_numeric($args[0])){
$sender->sendMessage("§f[ §b버프핫타임§f ] /머니핫타임 <돈>");
return;
    } else {
foreach( $this->getServer()->getOnlinePlayers() as $player ) {
$this->getServer()->broadcastMessage($tag.$sender->getName()."님이 핫타임으로 ".$args[0]."원을 주었습니다.");
EconomyAPI::getInstance()->addMoney($player, $args[0]);

    }
return true;
  }
}

if($cmd === "칭호핫타임"){
	if(!isset($args[0])){
		$sender->sendMessage($tag."§f/칭호핫타임 <칭호명>");
		return;
	}
	else {
		foreach($this->getServer()->getOnlinePlayers() as $player){
			$player->sendMessage($tag.$sender->getName()."님이 핫타임으로 §6[ ".$args[0]." §6]§f 칭호를 주었습니다. 칭호를 확인하세요!");
$prefix = $args[0];
$rank = RankProvider::getInstance()->getRank($player);
		$rank->addPrefixs([$prefix]);
				$rank->setPrefix($prefix);
		}
		return true;
	}
}
}
}
