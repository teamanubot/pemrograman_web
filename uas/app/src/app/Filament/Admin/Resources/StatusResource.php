<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StatusResource\Pages;
use App\Filament\Admin\Resources\StatusResource\RelationManagers;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;

    protected static ?string $navigationGroup = 'Manajemen Bot';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('akun_id')
                    ->relationship('akun', 'name')
                    ->label('Nama Akun')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Penyewa Bot')
                    ->required(),

                Forms\Components\Select::make('subscription_type')
                    ->label('Jenis Langganan')
                    ->options([
                        'selfbot' => 'Selfbot',
                        'official bot' => 'Official Bot',
                    ])
                    ->required(),
                Forms\Components\Select::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('payment_proof')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp ')
                    ->rule('numeric'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('akun.name')
                    ->label('Nama Akun')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Penyewa Bot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('akun.whatsapp_number')
                    ->label('No. WhatsApp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subscription_type'),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->disk('public')
                    ->visibility('public')
                    ->height(80),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 2, ',', '.')),
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
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'edit' => Pages\EditStatus::route('/{record}/edit'),
        ];
    }
}
