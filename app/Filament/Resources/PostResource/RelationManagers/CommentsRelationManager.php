<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';
    protected static ?string $recordTitleAttribute = 'content';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('content')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->label('Comment')
                    ->required()
                    ->rows(3),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'takedown' => 'Taken Down',
                    ])
                    ->default('active')
                    ->label('Status'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('content')
            ->columns([
                // Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->limit(50)
                    ->label('Comment'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'active',
                        'danger' => 'takedown',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Posted at')
                    ->dateTime(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'takedown' => 'Taken Down',
                    ]),
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('takedown')
                    ->label('Takedown')
                    ->icon('heroicon-o-shield-exclamation')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Comment $record) {
                        $record->update(['status' => 'takedown']);
                    })
                    ->visible(fn(Comment $record) => $record->status !== 'takedown'),

                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->defaultSort('created_at', 'desc');
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }
}
