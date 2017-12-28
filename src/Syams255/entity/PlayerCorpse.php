<?php

namespace Syams255\entity;

use pocketmine\nbt\tag\{ListTag, FloatTag, DoubleTag, CompoundTag, StringTag};
use pocketmine\entity\Human;
use pocketmine\Player;
use pocketmine\level\Level;

class PlayerCorpse extends Human
{
  public function __construct(Level $level, CompoundTag $nbt, Player $player = null)
  {
    $nbt = new CompoundTag("", [
                "Pos" => new ListTag("Pos", [
                    new DoubleTag("", $player->x),
                    new DoubleTag("", $player->y - 0.5),
                    new DoubleTag("", $player->z)
                ]),
                "Motion" => new ListTag("Motion", [
                    new DoubleTag("", 0),
                    new DoubleTag("", 0),
                    new DoubleTag("", 0)
                ]),
                "Rotation" => new ListTag("Rotation", [
                    new FloatTag("", $player->yaw),
                    new FloatTag("", $player->pitch)
                ]),
            ]);
            $player->saveNBT();
            $nbt->Skin = new CompoundTag("Skin", ["Data" => new StringTag("Data", $player->getSkinData()), "Name" => new StringTag("Name", $player->getSkinId())]);
            parent::__construct($level, $nbt);
            $this->setDataProperty(Human::DATA_PLAYER_BED_POSITION, Human::DATA_TYPE_POS, [(int)$player->x, (int)$player->y, (int)$player->z]);
            $this->setDataFlag(Human::DATA_PLAYER_FLAGS, Human::DATA_PLAYER_FLAG_SLEEP, true, Human::DATA_TYPE_BYTE);
  }
}
