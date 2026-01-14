<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Tag; // Tambahkan ini untuk akses Tag model
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\Select::make('bank_id')
                    ->relationship('bank', 'bank')
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default(fn() => Auth::id())
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_transaction')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Struk Transactions')
                    ->image(),
                    // ->required(),
                Forms\Components\Select::make('tags') // Komponen untuk Tags
                    ->label('Tags')
                    ->multiple() // memungkinkan memilih banyak tag
                    ->relationship('tags', 'name') // relasi ke tags
                // ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function (Builder $query) {
                if (Auth::check()) {
                    return Transaction::query()->where('user_id', Auth::id());
                }
                return Transaction::query();
            })
            ->columns([
                Tables\Columns\ImageColumn::make('category.image'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Name')
                    ->description(fn(Transaction $record): string => $record->name)
                    ->searchable(),
                Tables\Columns\IconColumn::make('category.pengeluaran')
                    ->label('Transaction Type')
                    ->trueIcon('heroicon-o-arrow-up-circle')
                    ->falseIcon('heroicon-o-arrow-down-circle')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->boolean()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_transaction')
                    ->date()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('bank.image')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('description')
                //     ->searchable(),
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
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
