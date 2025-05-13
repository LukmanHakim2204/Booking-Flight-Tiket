<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirlaneResource\Pages;
use App\Filament\Resources\AirlaneResource\RelationManagers;
use App\Models\Airlane;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AirlaneResource extends Resource
{
    protected static ?string $model = Airlane::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('airlane')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('code')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListAirlanes::route('/'),
            'create' => Pages\CreateAirlane::route('/create'),
            'edit' => Pages\EditAirlane::route('/{record}/edit'),
        ];
    }
}
