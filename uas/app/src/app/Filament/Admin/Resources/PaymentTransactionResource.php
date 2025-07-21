<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PaymentTransactionResource\Pages;
use App\Models\PaymentTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentTransactionResource extends Resource
{
    protected static ?string $model = PaymentTransaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Transaksi Pembayaran';
    protected static ?string $navigationGroup = 'Manajemen Pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\Select::make('akun_id')
                            ->label('Akun')
                            ->relationship('akun', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Pembayaran')
                            ->prefix('Rp')
                            ->required()
                            ->numeric(),
                        
                        Forms\Components\TextInput::make('currency')
                            ->default('IDR')
                            ->required()
                            ->maxLength(10),
                        
                        Forms\Components\Select::make('transaction_status')
                            ->label('Status Transaksi')
                            ->options([
                                'pending' => 'Pending',
                                'settlement' => 'Settlement',
                                'expire' => 'Expire',
                                'cancel' => 'Cancel',
                                'deny' => 'Deny',
                            ])
                            ->default('pending')
                            ->required(),

                        Forms\Components\TextInput::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Midtrans')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('midtrans_order_id')
                            ->label('Order ID Midtrans')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('midtrans_transaction_id')
                            ->label('Transaction ID Midtrans')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Waktu')
                    ->collapsed()
                    ->schema([
                        Forms\Components\DateTimePicker::make('transaction_time'),
                        Forms\Components\DateTimePicker::make('settlement_time'),
                        Forms\Components\DateTimePicker::make('expiry_time'),
                    ])->columns(3),

                Forms\Components\Section::make('Respon Mentah')
                    ->collapsed()
                    ->schema([
                        Forms\Components\Textarea::make('raw_response')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('akun.name')
                    ->label('Akun')
                    ->searchable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('midtrans_order_id')
                    ->label('Order ID')
                    ->copyable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('transaction_status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'settlement',
                        'danger' => ['deny', 'cancel', 'expire'],
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode'),

                Tables\Columns\TextColumn::make('transaction_time')
                    ->label('Waktu Transaksi')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
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
            'index' => Pages\ListPaymentTransactions::route('/'),
            'create' => Pages\CreatePaymentTransaction::route('/create'),
            'edit' => Pages\EditPaymentTransaction::route('/{record}/edit'),
        ];
    }
}