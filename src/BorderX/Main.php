<?php

namespace BorderX;

use pocketmine\Server;
use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\Config;

class Main extends Plugin implements Listener {

 public function onEnable() {
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
  $this->saveDefaultConfig();
 }
 
 public function onMove(PlayerMoveEvent $event) {
  $player = $event->getPlayer();
  $levelname = $this->getConfig()->get("LevelName");
  $level = $this->getServer()->getLevelByName($levelname);
  $distance = $level->getSpawnLocation()->distance($player);
   if($distance >= $this->getConfig()->get("Size")) {
    $event->setCancelled(true);
    $player->sendMessage($this->getConfig()->get("BorderMSG"));
   }
  }
}
