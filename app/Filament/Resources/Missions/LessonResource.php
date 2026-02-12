<?php

namespace App\Filament\Resources\Missions;

use App\Filament\Resources\Missions\Pages\CreateLesson;
use App\Filament\Resources\Missions\Pages\EditLesson;
use App\Filament\Resources\Missions\Pages\ListLessons;
use App\Filament\Resources\Missions\Schemas\LessonForm;
use App\Filament\Resources\Missions\Tables\LessonsTable;
use App\Models\Lesson;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Learning Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    public static function form(Schema $schema): Schema
    {
        return LessonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonsTable::configure($table);
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
            'index' => ListLessons::route('/'),
            'create' => CreateLesson::route('/create'),
            'edit' => EditLesson::route('/{record}/edit'),
        ];
    }
}
