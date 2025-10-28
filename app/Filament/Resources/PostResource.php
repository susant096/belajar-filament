<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true) // supaya slug otomatis saat user selesai mengetik judul
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', Str::slug($state));   // otomatis ubah slug berdasarkan judul
                    }),

                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()// tetap dikirim ke database
                    ->maxLength(255),

                // TextInput::make('user_id')
                //     ->default(fn() => auth()->user()->id),


                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('thumbnail')
                    ->label('Gambar utama')
                    ->image()
                    ->directory('post')
                    ->visibility('public')
                    ->imagePreviewHeight('200'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                ImageColumn::make('thumbnail')
                    ->label('gambar')
                    ->square(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
