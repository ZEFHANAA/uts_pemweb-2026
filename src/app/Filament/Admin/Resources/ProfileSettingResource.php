<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfileSettingResource\Pages;
use App\Filament\Admin\Resources\ProfileSettingResource\RelationManagers;
use App\Models\ProfileSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileSettingResource extends Resource
{
    protected static ?string $model = ProfileSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Profile Settings';

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $modelLabel = 'Profile Setting';

    protected static ?string $pluralModelLabel = 'Profile Settings';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('sub_title')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('avatar_path')
                            ->label('Avatar / Foto Profil')
                            ->image()
                            ->directory('profile')
                            ->disk('public')
                            ->columnSpanFull()
                            ->helperText('Upload foto profil Anda. Jika kosong, akan menggunakan inisial.'),
                        Forms\Components\FileUpload::make('cv_path')
                            ->label('File CV (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('cvs')
                            ->disk('public')
                            ->columnSpanFull()
                            ->helperText('Upload file CV Anda dalam format PDF.'),
                    ]),

                Forms\Components\Section::make('Tentang Saya')
                    ->schema([
                        Forms\Components\RichEditor::make('about_me')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Kontak & Media Sosial')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('github_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->url()
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Statistik')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('project_count_offset')
                            ->numeric()
                            ->required()
                            ->label('Jumlah Proyek (Tambahan)')
                            ->helperText('Jumlah proyek tambahan di luar proyek di database'),
                        Forms\Components\TextInput::make('years_of_experience_offset')
                            ->numeric()
                            ->required()
                            ->label('Tahun Belajar / Pengalaman')
                            ->helperText('Jumlah tahun pengalaman belajar/bekerja'),
                        Forms\Components\TextInput::make('tech_stack_count_offset')
                            ->numeric()
                            ->required()
                            ->label('Tech Stack (Tambahan)')
                            ->helperText('Jumlah tech stack tambahan'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Peran/Gelar'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Disable bulk delete for profile setting
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
            'index' => Pages\ListProfileSettings::route('/'),
            'create' => Pages\CreateProfileSetting::route('/create'),
            'edit' => Pages\EditProfileSetting::route('/{record}/edit'),
        ];
    }
}
