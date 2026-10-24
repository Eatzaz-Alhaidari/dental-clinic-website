<?php

namespace App\Filament\Resources\Doctors;

use App\Filament\Resources\Doctors\Pages\CreateDoctor;
use App\Filament\Resources\Doctors\Pages\EditDoctor;
use App\Filament\Resources\Doctors\Pages\ListDoctors;
use App\Models\Doctor;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'الأطباء';

    protected static ?string $modelLabel = 'طبيب';

    protected static ?string $pluralModelLabel = 'أطباء العيادة';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة العيادة';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('البيانات الشخصية والمهنية للطبيب')
                    ->description('أدخل اسم الطبيب وتخصصه ومؤهلاته باللغتين')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('اسم الطبيب (بالعربية)')
                                    ->placeholder('مثال: د. عمر بن عبدالعزيز الزهراني')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('name.en')
                                    ->label('اسم الطبيب (بالإنجليزية)')
                                    ->placeholder('e.g. Dr. Omar Al-Zahrani')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('specialty.ar')
                                    ->label('التخصص والدرجة المهنية (بالعربية)')
                                    ->placeholder('مثال: استشاري تقويم الأسنان والفكين')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('specialty.en')
                                    ->label('التخصص والدرجة المهنية (بالإنجليزية)')
                                    ->placeholder('e.g. Consultant in Orthodontics')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('bio.ar')
                                    ->label('النبذة والخبرات والشهادات (بالعربية)')
                                    ->placeholder('تفاصيل الخبرات والزمالات المهنية...')
                                    ->rows(3),

                                Textarea::make('bio.en')
                                    ->label('النبذة والخبرات والشهادات (بالإنجليزية)')
                                    ->placeholder('Professional background and fellowships...')
                                    ->rows(3),
                            ]),

                        FileUpload::make('photo')
                            ->label('صورة الطبيب الشخصية')
                            ->image()
                            ->directory('doctors')
                            ->maxSize(2048),

                        Toggle::make('is_active')
                            ->label('الطبيب متاح ونشط بالعيادة')
                            ->default(true),
                    ]),

                Section::make('التوزيع على الفروع والخدمات السنية')
                    ->description('حدد الفروع التي يداوم بها الطبيب والخدمات التي يقدمها')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('branches')
                                    ->label('الفروع المتاح بها الطبيب')
                                    ->multiple()
                                    ->relationship('branches', 'name')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->getTranslation('name', 'ar'))
                                    ->preload()
                                    ->required()
                                    ->helperText('يمكن للطبيب الدوام في أكثر من فرع'),

                                Select::make('services')
                                    ->label('الخدمات السنية التي يقدمها الطبيب')
                                    ->multiple()
                                    ->relationship('services', 'name')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->getTranslation('name', 'ar'))
                                    ->preload()
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('اسم الطبيب')
                    ->state(fn (Doctor $record) => $record->getTranslation('name', 'ar') . ' (' . $record->getTranslation('name', 'en') . ')')
                    ->searchable(query: function ($query, string $search) {
                        return $query->where('name->ar', 'like', "%{$search}%")
                            ->orWhere('name->en', 'like', "%{$search}%");
                    })
                    ->weight('bold'),

                TextColumn::make('specialty')
                    ->label('التخصص')
                    ->state(fn (Doctor $record) => $record->getTranslation('specialty', 'ar'))
                    ->limit(35),

                TextColumn::make('branches_list')
                    ->label('الفروع')
                    ->state(fn (Doctor $record) => $record->branches->map(fn ($b) => $b->getTranslation('name', 'ar'))->join('، '))
                    ->badge()
                    ->color('warning'),

                TextColumn::make('services_list')
                    ->label('الخدمات')
                    ->state(fn (Doctor $record) => $record->services->map(fn ($s) => $s->getTranslation('name', 'ar'))->join('، '))
                    ->badge()
                    ->color('info')
                    ->limitList(2),

                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
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
            'index' => ListDoctors::route('/'),
            'create' => CreateDoctor::route('/create'),
            'edit' => EditDoctor::route('/{record}/edit'),
        ];
    }
}
