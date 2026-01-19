<?php

return [
    // Navigation & Titles
    'manage_folders' => 'Hantera mappar',
    'folders' => 'Mappar',
    'folder' => 'Mapp',
    'folder_name' => 'Namn',
    'servers' => 'Servrar',
    'unassigned' => 'Ej tilldelad',

    // Settings
    'default_folders' => 'Standardmappar',
    'default_folders_help' => 'Dessa mappar skapas automatiskt för alla användare och kan inte tas bort av användare.',
    'lock_folder' => 'Lås mapp (användare kan inte ändra servertilldelningar)',
    'lock_folder_help' => 'Om aktiverat kommer användare inte att kunna ändra eller ta bort servertilldelningar för denna mapp',
    'select_servers_help' => 'Välj servrar att automatiskt tilldela till denna mapp för alla användare',

    // Actions
    'add_folder' => 'Lägg till mapp',
    'add_default_folder' => 'Lägg till standardmapp',
    'save' => 'Spara',
    'cancel' => 'Avbryt',

    // States & Messages
    'migration_required' => 'Migrering krävs',
    'migration_required_message' => 'Vänligen kör migreringen för att skapa de nödvändiga tabellerna.',
    'folder_locked' => 'Denna mapp är låst och kan inte ändras',

    // Notifications
    'folders_updated' => 'Mappar uppdaterade',
    'default_folders_saved' => 'Standardmappar sparade',
    'error_saving' => 'Fel vid sparande av standardmappar',
    'duplicate_servers' => 'Dubbletter av servrar upptäckta',
    'duplicate_servers_message' => 'Följande servrar är tilldelade till flera mappar: :servers',
];
