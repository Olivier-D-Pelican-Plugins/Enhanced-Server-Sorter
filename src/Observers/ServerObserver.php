<?php

namespace Olivier\EnhancedServerSorter\Observers;

use App\Models\Server;
use Olivier\EnhancedServerSorter\Models\EggFolderAssignment;
use Olivier\EnhancedServerSorter\Models\ServerFolderAssignment;

class ServerObserver
{

    public function created(Server $server): void
    {
        if (!$server->owner_id || !$server->egg_id) {
            return;
        }

        $existingAssignment = ServerFolderAssignment::where('server_id', $server->id)
            ->where('user_id', $server->owner_id)
            ->exists();

        if ($existingAssignment) {
            return;
        }

        $eggFolderAssignment = EggFolderAssignment::where('user_id', $server->owner_id)
            ->where('egg_id', $server->egg_id)
            ->first();

        if (!$eggFolderAssignment) {
            return;
        }

        $maxPosition = ServerFolderAssignment::where('folder_id', $eggFolderAssignment->folder_id)
            ->where('user_id', $server->owner_id)
            ->max('position') ?? -1;

        ServerFolderAssignment::create([
            'folder_id' => $eggFolderAssignment->folder_id,
            'user_id' => $server->owner_id,
            'server_id' => $server->id,
            'position' => $maxPosition + 1,
        ]);
    }
}
