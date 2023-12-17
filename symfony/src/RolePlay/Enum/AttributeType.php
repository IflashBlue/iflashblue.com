<?php

namespace App\RolePlay\Enum;

enum AttributeType: string {
    case FORCE = 'force';
    case DEXTERITY = 'dexterity';
    case CONSTITUTION = 'constitution';
    case INTELLIGENCE = 'intelligence';
    case WISDOM = 'wisdom';
    case CHARISMA = 'charisma';
    case FORCE_MODIFIER = 'force_modifier';
    case DEXTERITY_MODIFIER = 'dexterity_modifier';
    case CONSTITUTION_MODIFIER = 'constitution_modifier';
    case INTELLIGENCE_MODIFIER = 'intelligence_modifier';
    case WISDOM_MODIFIER = 'wisdom_modifier';
    case CHARISMA_MODIFIER = 'charisma_modifier';
    case BONUS_MASTERY = 'bonus_mastery';
    case SAVING_THROWS = 'saving_throws';
    case SKILLS = 'skills';
    case ARMOR_CLASS = 'armor_class';
    case INITIATIVE=  'initiative';
    case LIFE_POINTS = 'life_points';
    case LIFE_POINTS_REMAINING = 'life_points_remaining';
    case LIFE_DICES_NUMBER = 'life_dices_number';
    case ATTACKS = 'attacks';
    case SPELLS = 'spells';
    case OTHER_MASTERY = 'other_mastery';
    case OTHER_LANGUAGES = 'other_language';
    case CAPACITIES_AND_FEATURES = 'capacities_and_features';
    case EQUIPMENT = 'equipment';
    case COPPER_COINS = 'copper_coins';
    case SILVER_COINS = 'silver_coins';
    case ELECTRUM_COINS = 'electrum_coins';
    case GOLD_COINS = 'gold_coins';
    case PLATINUM_COINS = 'platinum_coins';
    case ADDITIONAL_CAPABILITIES_AND_FEATURES = 'additional_capabilities_and_features';
    case MINOR_SPELLS = 'minor_spells';
    case SPELLS_LEVEL_1 = 'spells_level_1';
    case SPELLS_LEVEL_2 = 'spells_level_2';
    case SPELLS_LEVEL_3 = 'spells_level_3';
    case SPELLS_LEVEL_4 = 'spells_level_4';
    case SPELLS_LEVEL_5 = 'spells_level_5';
    case SPELLS_LEVEL_6 = 'spells_level_6';
    case SPELLS_LEVEL_7 = 'spells_level_7';
    case SPELLS_LEVEL_8 = 'spells_level_8';
    case SPELLS_LEVEL_9 = 'spells_level_9';

}