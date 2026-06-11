<?php

declare(strict_types=1);

namespace EChest;

use pocketmine\block\EnderChest;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

    protected function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if(!$sender instanceof Player){
            $sender->sendMessage("Run this command in-game.");
            return true;
        }

        $sender->setCurrentWindow($sender->getEnderInventory());

        return true;
    }

    public function onInteract(PlayerInteractEvent $event) : void{
        $block = $event->getBlock();

        if($block instanceof EnderChest){
            $event->cancel();

            $player = $event->getPlayer();
            $player->setCurrentWindow($player->getEnderInventory());
        }
    }
}
