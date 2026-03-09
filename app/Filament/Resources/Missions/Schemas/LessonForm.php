<?php

namespace App\Filament\Resources\Missions\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class LessonForm
{
    public static function schema(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique('lessons', 'slug', ignoreRecord: true),
            TextInput::make('icon')
                ->placeholder('e.g. rocket_launch'),
            Select::make('course_id')
                ->relationship('course', 'title')
                ->required(),
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
                            'code_arrange' => 'Code Arrange (Susun Kode)',
                            'code_fillblank' => 'Code Fill-blank (Lengkapi Kode)',
                            'block_code' => 'Block Code (Visual Programming)',
                        ])
                        ->required()
                        ->live(),
                    TextInput::make('title')
                        ->required(),
                    Textarea::make('content')
                        ->required(),
                    FileUpload::make('image')
                        ->image()
                        ->directory('lessons/slides/images'),
                    FileUpload::make('audio_url')
                        ->audio()
                        ->directory('lessons/slides/audio'),
                    TextInput::make('button_text')
                        ->default('Lanjut'),

                    // Quiz & Minigames Specific Fields
                    Repeater::make('options')
                        ->schema([
                            TextInput::make('text')->required()->placeholder('A, B, C...'),
                        ])
                        ->visible(fn (Get $get): bool => in_array($get('type'), ['quiz', 'code_arrange', 'code_fillblank', 'block_code'])),

                    TextInput::make('correct_answer')
                        ->visible(fn (Get $get): bool => in_array($get('type'), ['quiz', 'code_arrange', 'code_fillblank', 'block_code'])),

                    Textarea::make('explanation')
                        ->visible(fn (Get $get): bool => in_array($get('type'), ['quiz', 'code_arrange', 'code_fillblank', 'block_code'])),

                    TextInput::make('order')
                        ->numeric()
                        ->default(0),
                ])
                ->columnSpanFull()
        ];
    }
}
