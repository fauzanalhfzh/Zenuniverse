<?php

namespace App\Filament\Resources\Missions\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->relationship('course', 'title')
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique('lessons', 'slug', ignoreRecord: true),
                TextInput::make('icon')
                    ->placeholder('e.g. rocket_launch'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0),
                TextInput::make('xp_reward')
                    ->numeric()
                    ->default(100),
                
                Repeater::make('slides')
                    ->relationship()
                    ->schema([
                        Select::make('type')
                            ->options([
                                'intro' => 'Intro (Information)',
                                'quiz' => 'Quiz (Question)',
                            ])
                            ->required()
                            ->live(),
                        TextInput::make('title')
                            ->required(),
                        Textarea::make('content')
                            ->required(),
                        TextInput::make('image')
                            ->placeholder('images/hero.png'),
                        TextInput::make('button_text')
                            ->placeholder('Lanjut'),
                        
                        // Quiz specific fields
                        Repeater::make('options')
                            ->schema([
                                TextInput::make('id')->required()->placeholder('A, B, C...'),
                                TextInput::make('text')->required(),
                                Select::make('correct')
                                    ->options([
                                        true => 'Correct',
                                        false => 'Incorrect',
                                    ])
                                    ->required(),
                            ])
                            ->visible(fn ($get) => $get('type') === 'quiz')
                            ->columnSpanFull(),
                        
                        TextInput::make('correct_answer')
                            ->placeholder('e.g. A')
                            ->visible(fn ($get) => $get('type') === 'quiz'),
                        
                        Textarea::make('explanation')
                            ->visible(fn ($get) => $get('type') === 'quiz'),
                        
                        TextInput::make('order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->orderColumn('order')
                    ->columnSpanFull()
            ]);
    }
}
