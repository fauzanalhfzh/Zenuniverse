<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                \Filament\Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                \Filament\Forms\Components\Textarea::make('excerpt')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                \Filament\Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('blog-thumbnails'),

                \Filament\Forms\Components\DateTimePicker::make('published_at'),

                \Filament\Forms\Components\Toggle::make('is_published')
                    ->required(),
                
                \Filament\Forms\Components\Hidden::make('author_id')
                    ->default(auth()->id()),
            ]);
    }
}
