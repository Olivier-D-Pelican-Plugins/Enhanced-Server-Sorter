<?php

namespace Olivier\EnhancedServerSorter\Models;

use App\Models\Egg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EggFolderAssignment extends Model
{
    protected $table = 'enhanced_server_egg_folder_assignments';

    protected $fillable = [
        'egg_id',
        'user_id',
        'folder_id',
    ];

    public function egg(): BelongsTo
    {
        return $this->belongsTo(config('panel.egg_model', Egg::class), 'egg_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('panel.auth.models.user'), 'user_id');
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(ServerFolder::class, 'folder_id');
    }
}
