<?php

namespace App\Filament\Resources\Branches;

use App\Filament\Resources\Branches\Pages\CreateBranch;
use App\Filament\Resources\Branches\Pages\EditBranch;
use App\Filament\Resources\Branches\Pages\ListBranches;
use App\Models\Branch;
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

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'الفروع';

    protected static ?string $modelLabel = 'فرع';

    protected static ?string $pluralModelLabel = 'فروع العيادة';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة العيادة';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('البيانات الأساسية للفرع')
                    ->description('أدخل اسم الفرع باللغتين ومعلومات الاتصال المباشرة')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('اسم الفرع (بالعربية)')
                                    ->placeholder('مثال: فرع صنعاء')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('name.en')
                                    ->label('اسم الفرع (بالإنجليزية)')
                                    ->placeholder('e.g. Sana\'a Branch')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('phone')
                                    ->label('رقم هاتف الاتصال')
                                    ->placeholder('+9671445566')
                                    ->tel()
                                    ->required(),

                                TextInput::make('whatsapp_number')
                                    ->label('رقم واتساب الفرع')
                                    ->placeholder('967771234567')
                                    ->helperText('يُحفظ تلقائياً بالصيغة الدولية بدون + أو أصفار')
                                    ->tel()
                                    ->required(),
                            ]),

                        Toggle::make('is_active')
                            ->label('الفرع مفعّل ويستقبل المواعيد')
                            ->default(true),
                    ]),

                Section::make('الموقع الجغرافي وساعات العمل')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Textarea::make('address.ar')
                                    ->label('العنوان التفصيلي (بالعربية)')
                                    ->placeholder('شارع الستين الجنوبي، تقاطع حدة...')
                                    ->required()
                                    ->rows(2),

                                Textarea::make('address.en')
                                    ->label('العنوان التفصيلي (بالإنجليزية)')
                                    ->placeholder('South Sixty Street, Hadda Intersection...')
                                    ->required()
                                    ->rows(2),

                                TextInput::make('working_hours.ar')
                                    ->label('ساعات الدوام (بالعربية)')
                                    ->placeholder('السبت - الخميس: 9:00 ص - 9:00 م')
                                    ->required(),

                                TextInput::make('working_hours.en')
                                    ->label('ساعات الدوام (بالإنجليزية)')
                                    ->placeholder('Sat - Thu: 9:00 AM - 9:00 PM')
                                    ->required(),
                            ]),

                        TextInput::make('map_url')
                            ->label('رابط خريطة Google Maps')
                            ->placeholder('https://maps.google.com/?q=...')
                            ->url()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('name_ar')
                    ->label('اسم الفرع')
                    ->state(fn (Branch $record) => $record->getTranslation('name', 'ar') . ' (' . $record->getTranslation('name', 'en') . ')')
                    ->searchable(query: function ($query, string $search) {
                        return $query->where('name->ar', 'like', "%{$search}%")
                            ->orWhere('name->en', 'like', "%{$search}%");
                    })
                    ->weight('bold'),

                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->icon('heroicon-o-phone'),

                TextColumn::make('whatsapp_number')
                    ->label('واتساب الفرع')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis'),

                TextColumn::make('doctors_count')
                    ->counts('doctors')
                    ->label('الأطباء')
                    ->badge()
                    ->color('info'),

                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('Y-m-d')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
            'index' => ListBranches::route('/'),
            'create' => CreateBranch::route('/create'),
            'edit' => EditBranch::route('/{record}/edit'),
        ];
    }
}
