<?php

namespace App\Filament\Resources\AppointmentRequests;

use App\Filament\Resources\AppointmentRequests\Pages\CreateAppointmentRequest;
use App\Filament\Resources\AppointmentRequests\Pages\EditAppointmentRequest;
use App\Filament\Resources\AppointmentRequests\Pages\ListAppointmentRequests;
use App\Models\AppointmentRequest;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use App\Services\PhoneService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppointmentRequestResource extends Resource
{
    protected static ?string $model = AppointmentRequest::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'طلبات المواعيد';

    protected static ?string $modelLabel = 'طلب موعد';

    protected static ?string $pluralModelLabel = 'طلبات المواعيد';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة الحجوزات';

    protected static ?int $navigationSort = 1;

    /**
     * Enforce branch isolation at the database query level:
     * Receptionist can ONLY view and manage appointment requests for their assigned branch.
     * Super Admin has full unrestricted access.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['branch', 'service', 'doctor']);
        $user = auth()->user();

        if ($user && $user->isReceptionist() && $user->branch_id) {
            $query->where('branch_id', $user->branch_id);
        }

        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        $user = auth()->user();
        $isReceptionist = $user && $user->isReceptionist();

        return $schema
            ->components([
                Section::make('معلومات المريض والاتصال')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('patient_name')
                                    ->label('اسم المريض بالكامل')
                                    ->placeholder('مثال: عبدالرحمن بن محمد')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('phone')
                                    ->label('رقم جوال المريض')
                                    ->placeholder('771234567')
                                    ->tel()
                                    ->required(),
                            ]),
                    ]),

                Section::make('تفاصيل الموعد والخدمة المطلوبة')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('branch_id')
                                    ->label('الفرع')
                                    ->relationship('branch', 'name')
                                    ->getOptionLabelFromRecordUsing(fn (Branch $record) => $record->getTranslation('name', 'ar'))
                                    ->default(fn () => $user?->branch_id)
                                    ->disabled($isReceptionist)
                                    ->dehydrated()
                                    ->required(),

                                Select::make('service_id')
                                    ->label('الخدمة الطبية')
                                    ->relationship('service', 'name')
                                    ->getOptionLabelFromRecordUsing(fn (Service $record) => $record->getTranslation('name', 'ar'))
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('doctor_id')
                                    ->label('الطبيب المفضل (اختياري)')
                                    ->relationship('doctor', 'name')
                                    ->getOptionLabelFromRecordUsing(fn (Doctor $record) => $record->getTranslation('name', 'ar'))
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                DatePicker::make('preferred_date')
                                    ->label('تاريخ الموعد المفضل')
                                    ->native(false)
                                    ->required(),

                                TextInput::make('preferred_time')
                                    ->label('الوقت المفضل')
                                    ->placeholder('مثال: 05:00 م')
                                    ->required(),

                                Select::make('status')
                                    ->label('حالة الطلب')
                                    ->options([
                                        AppointmentRequest::STATUS_NEW => 'جديد (بانتظار التواصل)',
                                        AppointmentRequest::STATUS_CONTACTED => 'تم التواصل مع المريض',
                                        AppointmentRequest::STATUS_CONFIRMED => 'موعد مؤكد ومحجوز',
                                        AppointmentRequest::STATUS_CANCELLED => 'موعد ملغي',
                                    ])
                                    ->default(AppointmentRequest::STATUS_NEW)
                                    ->required(),
                            ]),

                        Textarea::make('notes')
                            ->label('ملاحظات إضافية أو وصف الحالة')
                            ->placeholder('أي تفاصيل إضافية قدمها المريض...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = auth()->user();
        $isSuperAdmin = ! $user || $user->isSuperAdmin();

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('patient_name')
                    ->label('اسم المريض')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('phone')
                    ->label('رقم الجوال')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->copyable()
                    ->copyMessage('تم نسخ رقم الجوال'),

                TextColumn::make('branch_name')
                    ->label('الفرع')
                    ->state(fn (AppointmentRequest $record) => $record->branch ? $record->branch->getTranslation('name', 'ar') : '-')
                    ->badge()
                    ->color('warning')
                    ->visible($isSuperAdmin),

                TextColumn::make('service_name')
                    ->label('الخدمة المطلوبة')
                    ->state(fn (AppointmentRequest $record) => $record->service ? $record->service->getTranslation('name', 'ar') : '-')
                    ->badge()
                    ->color('info')
                    ->limit(25),

                TextColumn::make('doctor_name')
                    ->label('الطبيب')
                    ->state(fn (AppointmentRequest $record) => $record->doctor ? $record->doctor->getTranslation('name', 'ar') : 'أي طبيب متاح')
                    ->color(fn (AppointmentRequest $record) => $record->doctor ? 'primary' : 'gray'),

                TextColumn::make('preferred_date')
                    ->label('تاريخ الموعد')
                    ->date('Y-m-d')
                    ->sortable(),

                TextColumn::make('preferred_time')
                    ->label('الوقت')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->state(fn (AppointmentRequest $record) => $record->status_label)
                    ->color(fn (AppointmentRequest $record) => $record->status_color),

                TextColumn::make('created_at')
                    ->label('وقت الطلب')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Filter by Branch (Super Admin only)
                SelectFilter::make('branch_id')
                    ->label('تصفية حسب الفرع')
                    ->options(fn () => Branch::all()->pluck('name', 'id')->map(function ($val, $key) {
                        $branch = Branch::find($key);
                        return $branch ? $branch->getTranslation('name', 'ar') : $val;
                    }))
                    ->visible($isSuperAdmin),

                // Filter by Status
                SelectFilter::make('status')
                    ->label('تصفية حسب الحالة')
                    ->options([
                        AppointmentRequest::STATUS_NEW => 'جديد',
                        AppointmentRequest::STATUS_CONTACTED => 'تم التواصل',
                        AppointmentRequest::STATUS_CONFIRMED => 'مؤكد',
                        AppointmentRequest::STATUS_CANCELLED => 'ملغي',
                    ]),

                // Filter by Doctor
                SelectFilter::make('doctor_id')
                    ->label('تصفية حسب الطبيب')
                    ->options(fn () => Doctor::all()->mapWithKeys(fn ($d) => [
                        $d->id => $d->getTranslation('name', 'ar'),
                    ])),

                // Filter by Preferred Date
                Filter::make('preferred_date')
                    ->label('تاريخ الموعد')
                    ->form([
                        DatePicker::make('date_from')->label('من تاريخ'),
                        DatePicker::make('date_until')->label('إلى تاريخ'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['date_from'], fn ($q, $date) => $q->whereDate('preferred_date', '>=', $date))
                            ->when($data['date_until'], fn ($q, $date) => $q->whereDate('preferred_date', '<=', $date));
                    }),
            ])
            ->recordActions([
                // Quick Action: Confirm appointment
                Action::make('markConfirmed')
                    ->label('تأكيد الموعد')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (AppointmentRequest $record) => $record->status !== AppointmentRequest::STATUS_CONFIRMED)
                    ->action(function (AppointmentRequest $record) {
                        $record->update(['status' => AppointmentRequest::STATUS_CONFIRMED]);
                        Notification::make()
                            ->title('تم تأكيد الموعد بنجاح')
                            ->success()
                            ->send();
                    }),

                // Quick Action: Mark as Contacted
                Action::make('markContacted')
                    ->label('تم التواصل')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->color('info')
                    ->visible(fn (AppointmentRequest $record) => $record->status === AppointmentRequest::STATUS_NEW)
                    ->action(function (AppointmentRequest $record) {
                        $record->update(['status' => AppointmentRequest::STATUS_CONTACTED]);
                        Notification::make()
                            ->title('تم تحديث الحالة إلى: تم التواصل')
                            ->info()
                            ->send();
                    }),

                // Quick Action: WhatsApp Patient directly
                Action::make('openWhatsapp')
                    ->label('محادثة واتساب')
                    ->icon('heroicon-o-chat-bubble-oval-left')
                    ->color('success')
                    ->url(function (AppointmentRequest $record) {
                        $clean = PhoneService::normalize($record->phone);
                        $msg = rawurlencode("مرحباً بك {$record->patient_name}، نتواصل معك من عيادة دار العلوم لجراحات الفم والأسنان بخصوص طلب موعدك.");
                        return "https://wa.me/{$clean}?text={$msg}";
                    })
                    ->openUrlInNewTab(),

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
            'index' => ListAppointmentRequests::route('/'),
            'create' => CreateAppointmentRequest::route('/create'),
            'edit' => EditAppointmentRequest::route('/{record}/edit'),
        ];
    }
}
