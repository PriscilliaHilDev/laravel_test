<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Carbon;
use App\Models\Booking;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Résumé de la réservation')
                ->columns(2)
                ->schema([
                    // Colonne gauche : Bien
                    Grid::make(1)->schema([
                        ImageEntry::make('property.image_path')
                            ->label('Bien')
                            ->disk('public')
                            ->visibility('public')
                            ->defaultImageUrl(asset('images/properties/default.png'))
                            ->extraImgAttributes([
                                // contrôle la taille ici (pas de ->height())
                                'class' => 'w-full h-20 rounded-lg object-cover object-center',
                            ]),

                        TextEntry::make('property.name')->label('Nom du bien'),

                        TextEntry::make('property.price_per_night')
                            ->label('Prix / nuit')
                            ->formatStateUsing(fn ($state) => number_format((float) $state, 2, ',', ' ') . ' €'),
                    ])->columnSpan(1),

                    // Colonne droite : Client + période + total
                    Grid::make(2)->schema([
                        TextEntry::make('user.name')->label('Client')->columnSpan(1),
                        TextEntry::make('user.email')->label('Email')->columnSpan(1),

                        TextEntry::make('dates')
                            ->label('Séjour')
                            ->state(function (?Booking $r) {
                                if (! $r?->start_date || ! $r?->end_date) return '-';
                                $s = Carbon::parse($r->start_date)->isoFormat('DD/MM/YYYY');
                                $e = Carbon::parse($r->end_date)->isoFormat('DD/MM/YYYY');
                                return "Du {$s} au {$e}";
                            })
                            ->columnSpan(2),

                        TextEntry::make('nights')
                            ->label('Nuits')
                            ->state(fn (?Booking $r) => $r?->start_date && $r?->end_date
                                ? Carbon::parse($r->start_date)->diffInDays(Carbon::parse($r->end_date))
                                : '-'),

                        TextEntry::make('total')
                            ->label('Total estimé')
                            ->state(function (?Booking $r) {
                                if (! $r?->start_date || ! $r?->end_date) return '-';
                                $n = Carbon::parse($r->start_date)->diffInDays(Carbon::parse($r->end_date));
                                $p = (float) ($r->property->price_per_night ?? 0);
                                return $n > 0 && $p > 0 ? number_format($n * $p, 2, ',', ' ') . ' €' : '-';
                            }),
                    ])->columnSpan(1),
                ]),

            Section::make('Métadonnées')
                ->columns(2)
                ->schema([
                    TextEntry::make('created_at')->label('Créée le')->dateTime('d/m/Y H:i')->placeholder('-'),
                    TextEntry::make('updated_at')->label('Mise à jour le')->dateTime('d/m/Y H:i')->placeholder('-'),
                ]),
        ]);
    }
}
