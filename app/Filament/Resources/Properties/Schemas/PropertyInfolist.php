<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Schemas\Schema;

// ✅ Layouts (v4) => namespace Schemas\Components
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

// ✅ Entries => namespace Infolists\Components
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;

class PropertyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Aperçu du bien')
                ->columns(2)
                ->schema([
                    // Colonne gauche : image
                    ImageEntry::make('image_path')
                        ->label('Image')
                        ->disk('public')        // storage/app/public
                        ->visibility('public')  // URL via /storage/...
                        ->defaultImageUrl(asset('images/properties/default.png')),

                    // Colonne droite : infos
                    Grid::make(1)->schema([
                        TextEntry::make('name')
                            ->label('Nom')
                            ->weight('bold'),

                        TextEntry::make('price_per_night')
                            ->label('Prix / nuit')
                            ->formatStateUsing(fn ($state) => number_format((float) $state, 2, ',', ' ') . ' €'),

                        TextEntry::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ]),
                ]),

            Section::make('Métadonnées')
                ->columns(2)
                ->schema([
                    TextEntry::make('created_at')
                        ->label('Créée le')
                        ->dateTime('d/m/Y H:i')
                        ->placeholder('-'),

                    TextEntry::make('updated_at')
                        ->label('Mise à jour le')
                        ->dateTime('d/m/Y H:i')
                        ->placeholder('-'),
                ]),
        ]);
    }
}
