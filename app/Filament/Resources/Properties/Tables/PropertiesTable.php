<?php

namespace App\Filament\Resources\Properties\Tables;

use App\Filament\Resources\Properties\PropertyResource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

// ✅ En v4, les actions sont unifiées dans Filament\Actions
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('')
                    ->disk('public')
                    ->visibility('public')
                    ->square()
                    ->size(48) // height() est déprécié
                    ->extraImgAttributes(['class' => 'object-cover object-center rounded'])
                    ->defaultImageUrl(asset('images/properties/default.png'))
                    ->url(fn ($record) => PropertyResource::getUrl('view', ['record' => $record])), // clic vers la page "View"

                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price_per_night')
                    ->label('Prix / nuit')
                    ->money('EUR', locale: 'fr_FR'),

                TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Mise à jour le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // ✅ Actions par ligne (record actions)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(), // ← manquait, donc pas de suppression possible
            ])

            // ✅ Actions de barre d’outils (bulk)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}
