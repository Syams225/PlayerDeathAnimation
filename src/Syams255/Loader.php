<?php

namespace Syams255;

use pocketmine\plugin\PluginBase;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\nbt\tag\CompoundTag;

use Syams255\entity\PlayerCorpse;

class Loader extends PluginBase implements Listener
{
  public function OnEnable(){
    Entity::registerEntity(PlayerCorpse::class, true);
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  public function onDeath(PlayerDeathEvent $event)
  {
    $player = $event->getPlayer();
    Entity::createEntity("PlayerCorpse", $player->getLevel(), new CompoundTag(), $player)->spawnToAll();
  }
}
