<?php

return [
    // Navigation & Titles
    'manage_folders' => 'Manage folders',
    'folders' => 'Folders',
    'folder' => 'Folder',
    'folder_name' => 'Name',
    'servers' => 'Servers',
    'unassigned' => 'Unassigned',

    // Settings
    'default_folders' => 'Default Folders',
    'default_folders_help' => 'These folders will be automatically created for all users and cannot be deleted by users.',
    'lock_folder' => 'Lock folder (users cannot modify server assignments)',
    'lock_folder_help' => 'If enabled, users will not be able to modify or remove server assignments for this folder',
    'select_servers_help' => 'Select servers to automatically assign to this folder for all users',
    
    // Egg Folder Assignments
    'egg_folder_assignments' => 'Egg Folder Assignments',
    'egg_folder_assignments_help' => 'Automatically assign new servers to folders based on their egg type.',
    'assign_egg_to_folder' => 'Assign Egg to Folder',
    'egg' => 'Egg',
    'auto_assign_folder' => 'Auto-assign Folder',
    'select_egg' => 'Select an egg',
    'select_folder' => 'Select a folder',
    'egg_assignment_created' => 'Egg assignment created',
    'egg_assignment_updated' => 'Egg assignment updated',
    'egg_assignment_deleted' => 'Egg assignment deleted',

    // Actions
    'add_folder' => 'Add folder',
    'add_default_folder' => 'Add Default Folder',
    'save' => 'Save',
    'cancel' => 'Cancel',

    // States & Messages
    'migration_required' => 'Migration Required',
    'migration_required_message' => 'Please run the migration to create the required tables.',
    'folder_locked' => 'This folder is locked and cannot be modified',

    // Notifications
    'folders_updated' => 'Folders updated',
    'default_folders_saved' => 'Default folders saved',
    'error_saving' => 'Error saving default folders',
    'duplicate_servers' => 'Duplicate servers detected',
    'duplicate_servers_message' => 'The following servers are assigned to multiple folders: :servers',
];
