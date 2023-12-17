<?php

namespace App\RolePlay\Enum;

enum SavingType: string {
    case FORCE = 'force';
    case DEXTERITY = 'dexterity';
    case CONSTITUTION = 'constitution';
    case INTELLIGENCE = 'intelligence';
    case WISDOM = 'wisdom';
    case CHARISMA = 'charisma';
}