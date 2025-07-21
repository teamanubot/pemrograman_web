<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StatusResource\Pages;
use App\Models\Akun;
use App\Models\PaymentTransaction;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;

    protected static ?string $navigationGroup = 'Manajemen Bot';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->schema([
                        Forms\Components\Select::make('akun_id')
                            ->relationship('akun', 'name')
                            ->label('Nama Akun')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Penyewa')
                            ->required(),

                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('No. WhatsApp')
                            ->required()
                            ->tel(),
                    ])->columns(3),

                Forms\Components\Section::make('Langganan & Pembayaran')
                    ->schema([
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

                        Forms\Components\Select::make('payment_transaction_id')
                            ->label('Transaksi Midtrans')
                            ->relationship('paymentTransaction', 'midtrans_order_id')
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih jika ada transaksi')
                            ->nullable(),
                        
                        Forms\Components\TextInput::make('price')
                            ->label('Harga')
                            ->prefix('Rp')
                            ->numeric()
                            ->rules(['required', 'numeric', 'min:0']),
                    ])->columns(2),
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
                    ->label('Nama Penyewa'),

                Tables\Columns\TextColumn::make('whatsapp_number')
                    ->label('No. WhatsApp'),

                Tables\Columns\BadgeColumn::make('subscription_type')
                    ->colors([
                        'primary' => 'selfbot',
                        'success' => 'official bot',
                    ])
                    ->label('Jenis Langganan'),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->colors([
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    ])
                    ->label('Status'),

                Tables\Columns\TextColumn::make('paymentTransaction.midtrans_order_id')
                    ->label('Order ID Midtrans')
                    ->sortable()
                    ->copyable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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