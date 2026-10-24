<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Models\Service;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'الخدمات العلاجية';

    protected static ?string $modelLabel = 'خدمة';

    protected static ?string $pluralModelLabel = 'الخدمات العلاجية';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة العيادة';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات الخدمة الطبية')
                    ->description('أدخل مسمى وتفاصيل الخدمة السنية باللغتين العربية والإنجليزية')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('اسم الخدمة (بالعربية)')
                                    ->placeholder('مثال: تقويم الأسنان وتعديل الفكين')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('name.en')
                                    ->label('اسم الخدمة (بالإنجليزية)')
                                    ->placeholder('e.g. Orthodontics & Dentofacial Orthopedics')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('icon')
                                    ->label('رمز الأيقونة')
                                    ->placeholder('sparkles, face-smile, shield-check, heart, bolt...')
                                    ->default('sparkles'),

                                TextInput::make('sort_order')
                                    ->label('ترتيب العرض')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('الرقم الأقل يظهر أولاً في قائمة الخدمات'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('description.ar')
                                    ->label('وصف وتفاصيل الخدمة (بالعربية)')
                                    ->placeholder('شرح الإجراءات والتقنيات المستخدمة...')
                                    ->required()
                                    ->rows(3),

                                Textarea::make('description.en')
                                    ->label('وصف وتفاصيل الخدمة (بالإنجليزية)')
                                    ->placeholder('Detailed description of procedures and benefits...')
                                    ->required()
                                    ->rows(3),
                            ]),

                        Toggle::make('is_active')
                            ->label('الخدمة مفعّلة ومتاحة للحجز بالموقع')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('الخدمة')
                    ->state(fn (Service $record) => $record->getTranslation('name', 'ar') . ' (' . $record->getTranslation('name', 'en') . ')')
                    ->searchable(query: function ($query, string $search) {
                        return $query->where('name->ar', 'like', "%{$search}%")
                            ->orWhere('name->en', 'like', "%{$search}%");
                    })
                    ->weight('bold'),

                TextColumn::make('icon')
                    ->label('الأيقونة')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('doctors_count')
                    ->counts('doctors')
                    ->label('الأطباء الممارسين')
                    ->badge()
                    ->color('info'),

                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('Y-m-d')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
