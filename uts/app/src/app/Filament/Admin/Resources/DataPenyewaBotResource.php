<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DataPenyewaBotResource\Pages;
use App\Filament\Admin\Resources\DataPenyewaBotResource\RelationManagers;
use App\Models\DataPenyewaBot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataPenyewaBotResource extends Resource
{
    protected static ?string $model = DataPenyewaBot::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenisbot')
                    ->label('Jenis Langganan')
                    ->options([
                        'selfbot' => 'Selfbot',
                        'official bot' => 'Official Bot',
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('waktu_beli'),
                Forms\Components\DateTimePicker::make('waktu_habis'),
                Forms\Components\TextInput::make('status_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenisbot'),
                Tables\Columns\TextColumn::make('waktu_beli')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_habis')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPenyewaBots::route('/'),
            'create' => Pages\CreateDataPenyewaBot::route('/create'),
            'edit' => Pages\EditDataPenyewaBot::route('/{record}/edit'),
        ];
    }
}
