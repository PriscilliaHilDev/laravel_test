<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;           
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

// Entries
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;

use App\Models\User;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // ── Profil ───────────────────────────────────────────────
            Section::make('Profil')
                ->columns(3)
                ->schema([
                    // Avatar
                    ImageEntry::make('profile_photo_url')
                        ->label('Avatar')
                        ->extraImgAttributes([
                            'class' => 'w-28 h-28 rounded-full object-cover object-center ring-2 ring-white/10',
                        ])
                        ->columnSpan(1),

                    // Infos principales
                    Grid::make(2)->schema([
                        TextEntry::make('name')
                            ->label('Nom')
                            ->weight('bold')
                            ->columnSpan(2),

                        TextEntry::make('email')
                            ->label('Email'),

                        TextEntry::make('role.name')
                            ->label('Rôle')
                            ->placeholder('—'),
                    ])->columnSpan(2),
                ]),

            // ── Statut & Métadonnées ────────────────────────────────
            Section::make('Statut & métadonnées')
                ->columns(3)
                ->schema([
                    TextEntry::make('email_verified_at')
                        ->label('Email vérifié')
                        ->state(fn (?User $u) => $u?->email_verified_at ? 'Oui' : 'Non')
                        ->helperText(fn (?User $u) => $u?->email_verified_at
                            ? $u->email_verified_at->format('d/m/Y H:i')
                            : null),

                    TextEntry::make('created_at')
                        ->label('Compte créé le')
                        ->dateTime('d/m/Y H:i'),

                    TextEntry::make('updated_at')
                        ->label('Dernière mise à jour')
                        ->dateTime('d/m/Y H:i')
                        ->placeholder('—'),
                ]),

            // ── Activité (Réservations) ─────────────────────────────
            Section::make('Activité')
                ->columns(3)
                ->schema([
                    TextEntry::make('bookings_count')
                        ->label('Réservations')
                        ->state(fn (?User $u) => $u?->bookings()->count() ?? 0),

                    TextEntry::make('last_booking')
                        ->label('Dernière réservation')
                        ->state(function (?User $u) {
                            $last = $u?->bookings()->latest('start_date')->first();
                            return $last
                                ? $last->start_date->format('d/m/Y') . ' → ' . $last->end_date->format('d/m/Y')
                                : '—';
                        })
                        ->columnSpan(2),
                ]),

            // ── Sécurité (sans exposer de secrets) ──────────────────
            Section::make('Sécurité')
                ->columns(2)
                ->schema([
                    TextEntry::make('two_factor_confirmed_at')
                        ->label('2FA activée')
                        ->state(fn (?User $u) => $u?->two_factor_confirmed_at ? 'Oui' : 'Non')
                        ->helperText(fn (?User $u) => $u?->two_factor_confirmed_at
                            ? $u->two_factor_confirmed_at->format('d/m/Y H:i')
                            : null),

                    // On n’affiche PAS two_factor_secret ni recovery codes pour des raisons de sécurité
                    TextEntry::make('id')
                        ->label('ID interne')
                        ->helperText('Identifiant technique')
                        ->columnSpan(1),
                ]),
        ]);
    }
}
