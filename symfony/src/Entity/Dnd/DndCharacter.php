<?php

namespace App\Entity\Dnd;

class DndCharacter {
    public function __construct(
        public int $id, // TODO UUID
        public string $name,
        public string $class,
        public int $level,
        public string $history,
        public string $playerName,
        public string $race,
        public string $alignment,
        public int $xp,
    )
    {
    }
}
