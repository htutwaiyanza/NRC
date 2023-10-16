<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NrcPostResource\Pages;
use App\Filament\Resources\NrcPostResource\RelationManagers;
use App\Models\NrcPost;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NrcPostResource extends Resource
{
    protected static ?string $model = NrcPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('example'),
                Select::make('nrc2_id')
                ->label('TownName')
                ->relationship('nrc2', 'name_en')
                ->searchable()
                ->required(),
                // Select::make('name_mm')
                // ->label('မြန်မာ')
                // ->relationship('nrc2', 'name_mm')
                // ->searchable()
                // ->required(),
                Select::make('nrc_code')
                ->label('NRC Code')
                ->relationship('nrc2', 'nrc_code')
                ->searchable()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('example'),
                TextColumn::make('nrc2.name_en'),
                TextColumn::make('Nrc2.name_mm'),
                TextColumn::make('Nrc2.nrc_code'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListNrcPosts::route('/'),
            'create' => Pages\CreateNrcPost::route('/create'),
            'edit' => Pages\EditNrcPost::route('/{record}/edit'),
        ];
    }
}
