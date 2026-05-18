<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages;
use App\Filament\Admin\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    
    protected static ?string $navigationLabel = 'Projects';
    
    protected static ?string $navigationGroup = 'Management';
    
    protected static ?string $modelLabel = 'Project';
    
    protected static ?string $pluralModelLabel = 'Projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Project Details')
                    ->tabs([
                        Tabs\Tab::make('Basic Information')
                            ->schema([
                                Section::make('Project Information')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Project Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpan(2)
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                $set('slug', Str::slug($state));
                                            })
                                            ->live(debounce: 500),
                                        
                                        TextInput::make('slug')
                                            ->label('URL Slug')
                                            ->required()
                                            ->unique(Project::class, 'slug', ignoreRecord: true)
                                            ->columnSpan(2),
                                        
                                        Textarea::make('description')
                                            ->label('Short Description')
                                            ->required()
                                            ->maxLength(500)
                                            ->rows(3)
                                            ->columnSpan(2)
                                            ->hint('Brief overview of the project'),
                                        
                                        Textarea::make('long_description')
                                            ->label('Full Description')
                                            ->maxLength(5000)
                                            ->rows(6)
                                            ->columnSpan(2)
                                            ->hint('Detailed project description'),
                                    ]),
                            ]),
                        
                        Tabs\Tab::make('Media & Links')
                            ->schema([
                                Section::make('Project Media')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Project Image')
                                            ->image()
                                            ->disk('public')
                                            ->directory('projects')
                                            ->visibility('public')
                                            ->maxSize(10240)
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('800')
                                            ->imageResizeTargetHeight('450'),
                                    ]),
                                
                                Section::make('External Links')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('demo_url')
                                            ->label('Demo URL')
                                            ->url()
                                            ->placeholder('https://example.com'),
                                        
                                        TextInput::make('repository_url')
                                            ->label('Repository URL')
                                            ->url()
                                            ->placeholder('https://github.com/user/project'),
                                    ]),
                            ]),
                        
                        Tabs\Tab::make('Status & Progress')
                            ->schema([
                                Section::make('Project Status')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('status')
                                            ->label('Status')
                                            ->options([
                                                'planning' => 'Planning',
                                                'in-progress' => 'In Progress',
                                                'completed' => 'Completed',
                                                'on-hold' => 'On Hold',
                                            ])
                                            ->required(),
                                        
                                        TextInput::make('progress')
                                            ->label('Completion Progress (%)')
                                            ->type('number')
                                            ->inputMode('numeric')
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->required()
                                            ->step(1),
                                        
                                        Toggle::make('is_featured')
                                            ->label('Feature on Homepage')
                                            ->columnSpan(2),
                                    ]),
                                
                                Section::make('Timeline')
                                    ->columns(2)
                                    ->schema([
                                        DatePicker::make('start_date')
                                            ->label('Start Date'),
                                        
                                        DatePicker::make('end_date')
                                            ->label('End Date'),
                                    ]),
                            ]),
                        
                        Tabs\Tab::make('Technologies')
                            ->schema([
                                Section::make('Technologies Used')
                                    ->schema([
                                        TagsInput::make('technologies')
                                            ->label('Technologies & Tools')
                                            ->separator(',')
                                            ->hint('Press enter to add technology'),
                                    ]),
                            ]),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Project')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'in-progress' => 'info',
                        'planning' => 'warning',
                        'on-hold' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('-', ' ', $state)))
                    ->sortable(),
                
                TextColumn::make('progress')
                    ->label('Progress')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->sortable(),
                
                TextColumn::make('start_date')
                    ->label('Started')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('is_featured')
                    ->label('Featured')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                    ->color(fn ($state): string => $state ? 'success' : 'gray'),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'planning' => 'Planning',
                        'in-progress' => 'In Progress',
                        'completed' => 'Completed',
                        'on-hold' => 'On Hold',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}

