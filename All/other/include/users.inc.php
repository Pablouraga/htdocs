<?php
require_once(__DIR__.'/User.inc.php');

for ($i=1; $i<=15; $i++) {
    $names = ['Juan', 'María', 'Carlos', 'Laura', 'Pedro', 'Ana', 'José', 'Sofía', 'Miguel', 'Elena', 'David', 'Carmen', 'Pablo', 'Isabel', 'Manuel', 'Lucía', 'Javier', 'Raquel', 'Daniel', 'Paula', 'Francisco', 'Martina', 'Diego', 'Valentina', 'Luis', 'Julia', 'Alejandro', 'Valeria', 'Jorge','Emma', 'Alberto', 'Marta', 'Andrés', 'Claudia', 'Joaquín', 'Antonia', 'Adrián', 'Alba', 'Rafael', 'Eva', 'Rubén', 'Lorena', 'Fernando', 'Olivia','álvaro', 'Nerea', 'Iván', 'Mireia', 'Jesús', 'Aitana', 'Mario', 'Celia'];
    $surnames = ['Gómez', 'Fernández', 'López', 'Díaz', 'Martínez', 'Pérez', 'García', 'Sánchez', 'Romero', 'Sosa', 'Torres', 'álvarez', 'Ruiz', 'González', 'Molina', 'Castro', 'Suárez', 'Ramírez', 'Blanco', 'Vázquez', 'Alonso', 'Jiménez', 'Hernández', 'Salgado', 'Domínguez', 'Núñez', 'Iglesias', 'Ramos', 'Cabrera', 'Cruz', 'Ortega', 'Reyes', 'Ortiz', 'Nieto', 'Delgado', 'Vega', 'Giménez', 'Marín', 'Méndez', 'Gallego', 'Aguilar', 'Moya', 'Serrano', 'Herrera', 'Montero', 'Vidal', 'Guerrero', 'Fuentes', 'Lorenzo', 'Valero', 'Gallardo', 'Rey', 'Arias', 'Campos', 'Flores', 'Vila', 'Luna', 'Ojeda', 'Durán', 'Pastor', 'Vicente', 'Carmona', 'Vargas', 'Maldonado', 'Santana', 'Benítez', 'Arias', 'Osorio', 'Guerra', 'Cano', 'Barrios', 'Pino', 'Guillén', 'Casado', 'Estévez', 'Guillermo', 'Carvajal', 'Linares', 'Soria', 'Rosario', 'Bermúdez', 'Domínguez', 'Villegas', 'Solano', 'Armas', 'Medina', 'Hernández', 'Rojas', 'Olivares', 'Pacheco', 'Rocha', 'Valle', 'Ortega', 'Blanco', 'Crespo', 'Garrido', 'Silva', 'Montes', 'Collado', 'Guillén', 'Ferrer'];
    $nicks = ['super_gamer123', 'cool_cat22', 'ninja_master', 'awesome_sauce', 'tech_wizard', 'rainbow_unicorn', 'star_gazer', 'eagle_eye', 'swift_runner', 'fire_dragon', 'stealthy_ninja', 'pixel_pioneer', 'cyber_pirate', 'galactic_explorer', 'mystic_warrior', 'epic_adventurer', 'daring_diver', 'lone_wolf', 'iron_man', 'mega_mind', 'sky_walker', 'golden_falcon', 'shadow_hunter', 'magic_mender', 'whispering_wind', 'mighty_hawk', 'neon_ninja', 'silver_bullet', 'emerald_enchantress', 'dusk_treader', 'sonic_sorcerer', 'eternal_flame', 'panda_pal', 'midnight_rider', 'phoenix_rising', 'space_pioneer', 'crimson_warden', 'sapphire_seeker', 'emerald_warrior', 'fire_fox', 'dark_knight', 'dragon_slayer', 'starry_knight', 'eagle_eye', 'blazing_comet', 'thunder_storm', 'shadow_striker', 'ice_phoenix', 'mystic_mage', 'spectral_scribe', 'solar_flare', 'gentle_giant', 'daring_diver', 'forest_guardian', 'crimson_pirate', 'nebula_nomad', 'serenity_seeker', 'whispering_willow', 'mighty_mage', 'lone_ranger', 'silver_sword', 'crystal_caster', 'star_chaser', 'tech_enthusiast', 'ghost_whisperer', 'sapphire_sorcerer', 'emerald_enigma', 'cyber_pioneer', 'moonlit_mercenary', 'epic_adventurer', 'golden_guardian', 'eternal_voyager', 'fire_dragon', 'starry_sentinel', 'midnight_marauder', 'mystic_minstrel', 'ice_warrior', 'neon_nebula', 'solar_sailor', 'spectral_sorcerer', 'shadow_sprinter', 'thunder_striker', 'dusk_defender', 'whispering_wizard', 'sapphire_scribe', 'star_gazer', 'dragon_slayer', 'ninja_master', 'cool_cat22', 'super_gamer123', 'awesome_sauce', 'tech_wizard', 'swift_runner', 'rainbow_unicorn', 'eagle_eye', 'mega_mind', 'daring_diver', 'stealthy_ninja', 'pixel_pioneer', 'cyber_pirate', 'galactic_explorer', 'mystic_warrior', 'epic_adventurer', 'lone_wolf', 'iron_man', 'sky_walker', 'golden_falcon', 'shadow_hunter', 'magic_mender', 'whispering_wind', 'mighty_hawk', 'neon_ninja', 'silver_bullet', 'emerald_enchantress', 'dusk_treader', 'sonic_sorcerer', 'eternal_flame', 'panda_pal', 'midnight_rider', 'phoenix_rising', 'space_pioneer', 'crimson_warden', 'sapphire_seeker', 'emerald_warrior', 'fire_fox'];
    
    $name = $names[rand(0, count($names)-1)];
    $surname1 = $surnames[rand(0, count($surnames)-1)];
    $surname2 = $surnames[rand(0, count($surnames)-1)];
    $email = $nicks[rand(0, count($nicks)-1)].'@mail.com';
    
    $users[] = new User($i, $email, $name, $surname1, $surname2, make_birthday(), mt_rand(600000000, 699999999));    
}

function make_birthday(): int {
    return mktime(0, 0, 0, mt_rand(1,12), mt_rand(1, 31), mt_rand(1999, 2005));
}

echo '<pre>';
var_dump($users);
echo '</pre>';