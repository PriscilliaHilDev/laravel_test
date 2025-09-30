<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\UserResource;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

// Actions (v4)
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

// Filtres (optionnels)
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_photo_url')
                    ->label('')
                    ->square()
                    ->extraImgAttributes(['class' => 'object-cover object-center rounded'])
                    ->defaultImageUrl(asset('images/avatar-placeholder.png')),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(), // l’utilisateur peut masquer/afficher

                TextColumn::make('role.name')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state) => match (strtolower($state)) {
                        'admin' => 'danger',
                        'manager' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean() // coche/icone si non-null
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // Filtres simples (optionnels)
            ->filters([
                SelectFilter::make('role_id')
                    ->label('Role')
                    ->relationship('role', 'name'),

                TernaryFilter::make('verified')
                    ->label('Email verified')
                    ->nullable()
                    ->queries(
                        true:  fn ($q) => $q->whereNotNull('email_verified_at'),
                        false: fn ($q) => $q->whereNull('email_verified_at'),
                        blank: fn ($q) => $q, // no filter
                    ),
            ])

            // Actions par ligne
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(),
            ])

            // Actions de barre (bulk)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}
