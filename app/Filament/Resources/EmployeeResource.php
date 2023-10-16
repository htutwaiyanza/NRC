<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\Nrc2;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Candidate Info')
                        ->schema([

                            TextInput::make('employee_en')->nullable()->columnSpan(6)->placeholder('employee name')->live(onBlur: true),
                            TextInput::make('employee_mm')->nullable()->columnSpan(6)->placeholder('အလုပ်သမား နာမည်')->live(onBlur: true),
                            TextInput::make('father_name')->nullable()->columnSpan(6)->placeholder('father name')->live(onBlur: false),
                            DatePicker::make('date_of_birth')->format('d/m/Y')->columnSpan(6),
                            TextInput::make('race')->columnSpan(6),
                            Select::make('religion_id')
                                ->label('Religion')

                                ->relationship('religion', 'name')
                                // ->options(\App\Models\Religion::pluck('name', 'id'))
                                // ->searchable()
                                ->columnSpan(6),



                            Select::make('nationality_id')
                                ->label('Nationality')
                                ->relationship('nationality', 'name')
                                // ->placeholder('နိုင်ငံသား')->live(onBlur:true)
                                // ->searchable()
                                // ->nullable()
                                ->columnSpan(6),
                            Select::make('vacancy_id')
                                ->label('Vacancy')
                                ->relationship('vacancy', 'name')
                                // ->searchable()
                                ->placeholder('အလုပ်အကိုင်')->live(onBlur: true)
                                ->nullable()
                                ->columnSpan(6),
                            TextInput::make('passport')->nullable()
                                ->columnSpan(6),
                            TextInput::make('driver_licene')->nullable()->columnSpan(6),

                            Fieldset::make('employees')
                                ->schema([


                                    Select::make('nrc2_id')
                                        ->label('Code')
                                        ->hiddenLabel()
                                        ->options(Nrc2::select('nrc_code')->distinct()->orderBy('nrc_code', 'asc')->pluck('nrc_code','nrc_code'))
                                        ->live()
                                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('name_en', Nrc2::select('name_en')->where('nrc_code', $state)->pluck('name_en','name_en')))->columnSpan(3),



                                    Select::make('nrc2_n')
                                        ->label('distinct')
                                        ->hiddenLabel()
                                        ->options(function ($get) {
                                            return $get('name_en');
                                        })->columnSpan(3),



                                    Select::make('nrc1_id')
                                        ->hiddenLabel()
                                        ->relationship('nrc1', 'name')
                                        // ->searchable()
                                        ->placeholder('နံပတ်')->live(onBlur: true)
                                        ->nullable()
                                        ->columnSpan(3),

                                    TextInput::make('name')->nullable()->disableLabel()->numeric()
                                        ->columnSpan(3),
                                ])->columns(12)->columnSpan(9),


                            Select::make('gender_id')
                                ->label('Gender')
                                ->relationship('gender', 'name')
                                // ->searchable()
                                ->nullable()
                                ->columnSpan(3),
                            Select::make('blood_types_id')
                                ->label('Blood Type')
                                ->placeholder('ေသွး')->live(onBlur: true)
                                ->relationship('blood_type', 'name')
                                // ->searchable()
                                ->nullable()
                                ->columnSpan(6),
                            Select::make('martial_status_id')
                                ->label('Martial Status')
                                ->relationship('martial_status', 'name')
                                // ->searchable()
                                ->nullable()
                                ->columnSpan(6),
                            TextInput::make('home_phone')->nullable()->columnSpan(6)->tel()->numeric(),
                            TextInput::make('mobile_phone')->nullable()->columnSpan(6)->numeric(),
                            TextInput::make('url')->nullable()->placeholder('Social Media ')
                                ->live(onBlur: true)
                                ->columnSpan(12),

                        ])->columns(18),







                    Wizard\Step::make('Background Info')
                        ->schema([
                            Checkbox::make('education_info')->columnSpanFull()->default(true),
                            Repeater::make('educations')->relationship()
                                ->schema([
                                    TextInput::make('education_degree')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    DatePicker::make('education_from')->nullable(),
                                    DatePicker::make('education_to')->nullable(),
                                    TextInput::make('school')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                ])
                                ->columns(6),


                            Checkbox::make('working_info')->columnSpanFull()->default(true),
                            Repeater::make('workings')
                                ->relationship()
                                ->schema([
                                    TextInput::make('job')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('company_name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    DatePicker::make('job_from')->nullable(),
                                    DatePicker::make('job_to')->nullable(),
                                    TextInput::make('employer_contact')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                    TextInput::make('employer_address')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(4),
                                ])
                                ->columns(6),


                            Fieldset::make('employees')
                                ->schema([
                                    Checkbox::make('family_member_info')->columnSpanFull()->default(true),
                                    TextInput::make('family_member_name')->live(onBlur: true),
                                    TextInput::make('relationship')->live(onBlur: true),
                                    TextInput::make('family_date_of_birth')->live(onBlur: true),
                                    TextInput::make('occupation')->live(onBlur: true),
                                    TextInput::make('contact_phone_number')->live(onBlur: true),
                                    TextInput::make('family_address')->live(onBlur: true)->columnSpan(3),
                                ])
                                ->columns(4)
                        ]),

                    Wizard\Step::make('Address')
                        ->schema([
                            Checkbox::make('addresses')->columnSpanFull()->default(true),
                            Fieldset::make('contact_address')
                                ->schema([
                                    TextInput::make('country')
                                        // ->required()
                                        ->live(onBlur: true),
                                    TextInput::make('state')
                                        // ->required()
                                        ->live(onBlur: true),
                                    TextInput::make('township')
                                        // ->required()
                                        ->live(onBlur: true),
                                    TextInput::make('street')
                                        // ->required()
                                        ->live(onBlur: true),
                                ])
                                ->columns(4)

                        ]),
                ])->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->toggleable(isToggledHiddenByDefault: (true)),
                TextColumn::make('employee_en')->sortable()->searchable()->toggleable(),
                TextColumn::make('employee_mm')->sortable()->searchable()->toggleable(),
                TextColumn::make('father_name')->sortable()->searchable()->toggleable(),
                TextColumn::make('date_of_birth')->sortable()->searchable()->toggleable(),
                TextColumn::make('religion.name')->sortable()->searchable()->toggleable(),
                TextColumn::make('0nationality.name')->sortable()->searchable()->toggleable(),
                TextColumn::make('vacancy.name')->sortable()->searchable()->toggleable(),
                TextColumn::make('passport')->sortable()->searchable()->toggleable(),
                TextColumn::make('nrc2.nrc_code')->sortable()->searchable()->toggleable()->label('NRC Code'),
                TextColumn::make('nrc2.name_en')->sortable()->searchable()->toggleable()->label('TownShip'),
                TextColumn::make('nrc1.name')->sortable()->searchable()->toggleable()->label('NRC Type'),
                TextColumn::make('name')->sortable()->searchable()->toggleable()->label('NRC No'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}



// ->schema([
//     Checkbox::make('Education Info')->columnSpanFull()->default(true),

//     Repeater::make('members')
//         ->schema([

//             TextInput::make('Education')->nullable()->columnSpan(2),
//             DatePicker::make('From')->nullable(),
//             DatePicker::make('To')->nullable(),
//             TextInput::make('School/College/University')->columnSpan(2),
//         ])->columns(6),



//     // TextInput::make('Degree')->nullable()->columnSpan(2),
//     // DatePicker::make('from')->nullable(),
//     // DatePicker::make('to')->nullable(),
//     // TextInput::make('School/College/University')->columnSpan(2),
//     Checkbox::make('Working Info')->columnSpanFull(),
//     TextInput::make('Working Experience')->columnSpan(2),
//     TextInput::make('Company Name')->columnSpan(2),
//     DatePicker::make('From')->nullable(),
//     DatePicker::make('To')->nullable(),
//     TextInput::make('Employer Contact')->columnSpan(2),
//     TextInput::make('Employer Address')->columnSpan(4),

//     FileUpload::make('attachment')->columnSpan(5)


// ])->columns(6),
