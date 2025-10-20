<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
            TextInput::make('name')
            ->required(),
            TextInput::make('email')
            ->label('Email address')
            ->email()
            ->default(null),
            TextInput::make('username')
            ->default(null),
            TextInput::make('displayname')
            ->default(null),
            TextInput::make('celuller_no')
            ->default(null),
            TextInput::make('password')
            ->password()
            ->helperText('Minimum 8 characters')
            ->required() // Make it required for new records
            ->minLength(9) // Make it required for new records
            ->maxLength(255) // Make it required for new records
            ->hiddenOn('edit'),
            Textarea::make('bio')
            ->default(null)
            ->columnSpanFull(),
            FileUpload::make('image')
            ->image(),
            Toggle::make('status')
            ->required(),
        ]);
    }
}