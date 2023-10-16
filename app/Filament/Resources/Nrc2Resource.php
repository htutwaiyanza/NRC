<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Nrc2Resource\Pages;
use App\Filament\Resources\Nrc2Resource\RelationManagers;
use App\Models\Nrc2;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Nrc2Resource extends Resource
{
    protected static ?string $model = Nrc2::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_en')->required(),
                TextInput::make('name_mm')->required(),
                TextInput::make('nrc_code')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_en'),
                TextColumn::make('name_mm'),
                TextColumn::make('nrc_code'),
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
            'index' => Pages\ListNrc2s::route('/'),
            'create' => Pages\CreateNrc2::route('/create'),
            'edit' => Pages\EditNrc2::route('/{record}/edit'),
        ];
    }
}
