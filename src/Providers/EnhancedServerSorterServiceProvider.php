<?php

namespace Olivier\EnhancedServerSorter\Providers;

use App\Enums\CustomizationKey;
use App\Filament\App\Resources\Servers\Pages\ListServers as AppListServers;
use App\Models\Server;
use Filament\Tables\Columns\Column;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Olivier\EnhancedServerSorter\Models\EggFolderAssignment;
use Olivier\EnhancedServerSorter\Models\ServerFolderAssignment;
use Olivier\EnhancedServerSorter\Observers\ServerObserver;

class EnhancedServerSorterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Server::resolveRelationUsing('enhancedFolderAssignment', function (Server $server) {
            return $server->hasOne(ServerFolderAssignment::class, 'server_id', 'id')
                ->where('user_id', user()?->id)
                ->with('folder');
        });
    }

    public function boot(): void
    {
        Server::observe(ServerObserver::class);

        if (!Schema::hasTable('enhanced_server_folder_server')) {
            return;
        }

        Table::configureUsing(function (Table $table): void {
            $component = $table->getLivewire();

            if (!$component instanceof AppListServers) {
                return;
            }

            $usingGrid = user()?->getCustomization(CustomizationKey::DashboardLayout) === 'grid';

            $table
                ->groups([
                    (function (): Group {
                        $group = Group::make('computed_folder_name')
                            ->label(fn () => trans('Enhanced-Server-Sorter::messages.folders'))
                            ->titlePrefixedWithLabel(false);

                        $group->getTitleFromRecordUsing(function (Server $server): string {
                            $userId = user()?->id;
                            
                            $folderName = $server->enhancedFolderAssignment?->folder?->name;
                            
                            if (!$folderName && Schema::hasTable('enhanced_server_egg_folder_assignments')) {
                                $eggAssignment = EggFolderAssignment::query()
                                    ->where('user_id', $userId)
                                    ->where('egg_id', $server->egg_id)
                                    ->with('folder')
                                    ->first();
                                    
                                if ($eggAssignment && $eggAssignment->folder) {
                                    $folderName = $eggAssignment->folder->name;
                                }
                            }
                            
                            return $folderName ?? trans('Enhanced-Server-Sorter::messages.unassigned');
                        })
                        ->collapsible();

                        $group->orderQueryUsing(function (Builder $query, string $direction): Builder {
                            $userId = (int) (user()?->id ?? 0);
                            $serverIdColumn = Server::query()->qualifyColumn('id');
                            $folderSortSub = "(SELECT esf.sort FROM enhanced_server_folder_server esfs JOIN enhanced_server_folders esf ON esf.id = esfs.folder_id WHERE esfs.user_id = {$userId} AND esfs.server_id = {$serverIdColumn} LIMIT 1)";
                            $eggFolderSortSub = "(SELECT esf.sort FROM eggs e JOIN enhanced_server_egg_folder_assignments efa ON efa.egg_id = e.id JOIN enhanced_server_folders esf ON esf.id = efa.folder_id WHERE efa.user_id = {$userId} AND e.id = servers.egg_id LIMIT 1)";
                            $positionSub = "(SELECT esfs.position FROM enhanced_server_folder_server esfs WHERE esfs.user_id = {$userId} AND esfs.server_id = {$serverIdColumn} LIMIT 1)";

                            $directionSql = $direction === 'desc' ? 'DESC' : 'ASC';

                            return $query
                                ->orderByRaw("COALESCE({$folderSortSub}, {$eggFolderSortSub}, 2147483647) {$directionSql}")
                                ->orderByRaw("COALESCE({$positionSub}, 2147483647) {$directionSql}");
                        });

                        return $group;
                    })(),
                ])
                ->defaultGroup('computed_folder_name');
        });
    }
}
