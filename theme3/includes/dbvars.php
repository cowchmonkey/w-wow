<?php
    /**
     * THE FOLLOWIN IS SELF EXPLANITORY
     * CHANGE AS NEEDED - VWOW LEAVE AS IS (OPTIONAL)
     * */
    define ('HOST'          ,'localhost');
    define ('SQL_USERNAME'  ,'root');
    define ('SQL_PASSWORD'  ,'4179');
    define ('MANGOS_WORLD'  ,'mangos');
    define ('MANGOS_CHAR'   ,'characters');
    define ('MANGOS_REALMD' ,'realmd');
    define ('MANGOS_VWOW'   ,'vwow');
    define ('LANG'          ,'en');                 //CORISPONDS TO NAME OF FILE EG EN.PHP(ENGLISH);
    
    
    
    
    //TODO: MOVE THE FOLLOWING TO SQL TABLES
    
    /**
     *     THESE ARE NOT THE DROIDS YOU ARE LOOKING FOR
     *     MOVE ALONG....
     *     IN OTHERWORDS! DONT MESS WITH THE BELOW ---
     * */
   
    
    $binding = array (
        '0'                 =>'Non-Binding',
        '1'                 =>'Binds when picked up',
        '2'                 =>'Binds when equipped',
        '3'                 =>'Binds when used',
        '4'                 =>'Quest Item',
        '5'                 =>'Quest Item 1'
    );
    
    $inv_type = array (
        '0'                 =>'Non-Equip',
        '1'                 =>'Head',
        '2'                 =>'Neck',
        '3'                 =>'Shoulder',
        '4'                 =>'Shirt',
        '5'                 =>'Chest',
        '6'                 =>'Waist(belt)',
        '7'                 =>'Legs(pants)',
        '8'                 =>'Feet(boots)',
        '9'                 =>'Wrist(bracers)',
        '10'                =>'Hands(gloves)',
        '11'                =>'Finger(ring)',
        '12'                =>'Trinket',
        '13'                =>'One Hand',
        '14'                =>'Off Hand',
        '15'                =>'Ranged',
        '16'                =>'Cloak(back)',
        '17'                =>'Two-Hand',
        '18'                =>'Bag(inc.quivers)',
        '19'                =>'Tabbard',
        '20'                =>'Robe',
        '21'                =>'Main Hand',
        '22'                =>'Off Hand(misc)',
        '23'                =>'Holdable(tome)',
        '24'                =>'Ammunition',
        '25'                =>'Thrown',
        '26'                =>'Ranged Right(gun)',
        '27'                =>'Quiver',
        '28'                =>'Relic'
    );
    
    // STAT TYPE
    $stat_type[0]   =   'Power';
    $stat_type[1]   =   'Health';
    $stat_type[2]   =   'Unused';         //program errors out w/o this
    $stat_type[3]   =   'Agility';
    $stat_type[4]   =   'Strenght';
    $stat_type[5]   =   'Intellect';
    $stat_type[6]   =   'Spirit';
    $stat_type[7]   =   'Stamina';
    
    // COLORS FOR QUALITY OF ITEMS
    $qualityColor[0]    =   '#COCOCO';    //GREY POOR
    $qualityColor[1]    =   '#FFFFFF';    //WHITE COMMON
    $qualityColor[2]    =   '#00FF00';    //GREEN UNCOMMON
    $qualityColor[3]    =   '#0000FF';    //BLUE RARE
    $qualityColor[4]    =   '#800080';    //PURPLE EPIC
    $qualityColor[5]    =   '#FF9610';    //ORANGE LEGENDARY
    $qualityColor[6]    =   '#FF0000';    //RED ARTIFACT
    $qualityColor[7]    =   '#EBC79E';    //TAN HEIRLOOM - ADDED BY REQUEST FOR 3.3.5
    
    
    $class = array();
    // CONSUMABLE CLASS
    $class[0][0]    =   'Consumable';
    $class[0][1]    =   'Cheese/Bread'; //OBSOLETE
    $class[0][2]    =   'Liquid';       //OBSOLETE
    
    // CONTAINER CLASS
    $class[1][0]    =   'Bag';
    $class[1][1]    =   'Soul Bag';
    $class[1][2]    =   'Herb Bag';
    $class[1][3]    =   'Enchant Bag';
    $class[1][4]    =   'Engineering Bag';
    
    // WEAPON CLASS
    $class[2][0]    =   'Axe';
    $class[2][1]    =   'Axe';
    $class[2][2]    =   'Bow';
    $class[2][3]    =   'Gun';
    $class[2][4]    =   'Mace';
    $class[2][5]    =   'Mace';
    $class[2][6]    =   'Polearm';
    $class[2][7]    =   'Sword';
    $class[2][8]    =   'Sword';
    $class[2][9]    =   'Obsolete';
    $class[2][10]   =   'Staff';
    $class[2][11]   =   'Exotic';
    $class[2][12]   =   'Exotic';
    $class[2][13]   =   'First Weapon';
    $class[2][14]   =   'Miscellaneous';
    $class[2][15]   =   'Dagger';
    $class[2][16]   =   'Thrown';
    $class[2][17]   =   'Spear';
    $class[2][18]   =   'Crossbow';
    $class[2][19]   =   'Wand';    
    $class[2][20]   =   'Fishing Pole';
    
    // JEWELERY CLASS (OBSOLETE) HERE FOR REFERENCE ONLY
    $class[3][0]    =   'Jewelery';
    
    // ARMOR CLASS
    $class[4][0]   =    'Miscellaneous';
    $class[4][1]   =    'Cloth';
    $class[4][2]   =    'Leather';
    $class[4][3]   =    'Mail';
    $class[4][4]   =    'Plate';
    $class[4][5]   =    'Buckler';
    $class[4][6]   =    'Shield';
    $class[4][7]   =    'Libram';
    $class[4][8]   =    'Idol';
    $class[4][9]   =    'Totem';
    
    // REGENT CLASS
    $class[5][0]   =    'Regent';
    
    // PROJECTILE CLASS
    $class[6][0]   =    'Wand';     //obsolete
    $class[6][1]   =    'Bolt';     //obsolete
    $class[6][2]   =    'Arrow';
    $class[6][3]   =    'Bullet';
    $class[6][4]   =    'Thrown';   //obsolete
    
    // TRADE GOODS CLASS
    $class[7][0]   =    'Trade Goods';
    $class[7][1]   =    'Parts';
    $class[7][2]   =    'Explosives';
    $class[7][3]   =    'Devices';
    
    // GENERIC CLASS
    $class[8][0]   =   'Generic';
    
    // RECIPE CLASS
    $class[9][0]   =    'Book';
    $class[9][1]   =    'Leatherworking';
    $class[9][2]   =    'Tailoring';
    $class[9][3]   =    'Engineering';
    $class[9][4]   =    'Blacksmithing';
    $class[9][5]   =    'Cooking';
    $class[9][6]   =    'Alchemy';
    $class[9][7]   =    'First Aid';
    $class[9][8]   =    'Enchanting';
    $class[9][9]   =    'Fishing';
    
    // MONEY CLASS
    $class[10][0]  =    'Money';
    
    // QUICER CLASS
    $class[11][0]  =     'Quiver';       //obsolete
    $class[11][1]  =     'Quiver';       //obsoete
    $class[11][2]  =     'Quiver';
    $class[11][3]  =     'Ammo Pouch';
    
    // QUEST CLASS
    $class[12][0]  =     'Quest';
    
    // KEY CLASS
    $class[13][3]  =    'Key';
    $class[13][3]  =    'Lockpick';
    
    // PERMANENT CLASS
    $class[14][0]  =     'Permanent';   //obsolete
    
    // MISCELANEOUS
    $class[15][0]  =     'Junk';
    
?>