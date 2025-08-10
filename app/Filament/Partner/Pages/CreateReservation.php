<?php

namespace App\Filament\Partner\Pages;

use Filament\Forms;
use App\Models\City;
use App\Models\Country;
use App\Models\Service;
use App\Models\Province;
use Filament\Pages\Page;
use App\Models\Subservice;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateReservation extends Page
{
    use InteractsWithForms;  // اینجا اضافه کن

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.partner.pages.create-reservation';

    protected static ?string $navigationGroup = 'Reservations';

    protected static ?int $navigationSort = 1;

    // مقدار اولیه state فرم
    public $data = [];

    public function mount()
    {
        $this->form->fill([
            // اینجا اگر بخوای مقدار پیش‌فرض بدی
            // مثلا 'origin_country_id' => null,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Travel Details')
                ->schema([
                    // Origin
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\Select::make('origin_country_id')
                                ->label('Origin Country')
                                ->options(Country::pluck('name', 'id'))
                                ->searchable()
                                ->reactive()  // reactive برای کسکید
                                ->afterStateUpdated(fn (callable $set) => $set('origin_province_id', null))
                                ->required(),

                            Forms\Components\Select::make('origin_province_id')
                                ->label('Origin Province')
                                ->options(function (callable $get) {
                                    $countryId = $get('origin_country_id');
                                    return $countryId ? Province::where('country_id', $countryId)->pluck('name', 'id') : [];
                                })
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set) => $set('origin_city_id', null))
                                ->disabled(fn (callable $get) => !$get('origin_country_id'))
                                ->required(),

                            Forms\Components\Select::make('origin_city_id')
                                ->label('Origin City')
                                ->options(function (callable $get) {
                                    $provinceId = $get('origin_province_id');
                                    return $provinceId ? City::where('province_id', $provinceId)->pluck('name', 'id') : [];
                                })
                                ->searchable()
                                ->disabled(fn (callable $get) => !$get('origin_province_id'))
                                ->required(),
                        ]),

                    // Destination
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\Select::make('destination_country_id')
                                ->label('Destination Country')
                                ->options(Country::pluck('name', 'id'))
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set) => $set('destination_province_id', null))
                                ->required(),

                            Forms\Components\Select::make('destination_province_id')
                                ->label('Destination Province')
                                ->options(function (callable $get) {
                                    $countryId = $get('destination_country_id');
                                    return $countryId ? Province::where('country_id', $countryId)->pluck('name', 'id') : [];
                                })
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set) => $set('destination_city_id', null))
                                ->disabled(fn (callable $get) => !$get('destination_country_id'))
                                ->required(),

                            Forms\Components\Select::make('destination_city_id')
                                ->label('Destination City')
                                ->options(function (callable $get) {
                                    $provinceId = $get('destination_province_id');
                                    return $provinceId ? City::where('province_id', $provinceId)->pluck('name', 'id') : [];
                                })
                                ->searchable()
                                ->disabled(fn (callable $get) => !$get('destination_province_id'))
                                ->required(),
                        ]),

                    // Service
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('service_id')
                                ->label('Service')
                                ->options(Service::pluck('name', 'id'))
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set) => $set('subservice_id', null))
                                ->required(),

                            Forms\Components\Select::make('subservice_id')
                                ->label('Subservice')
                                ->options(function (callable $get) {
                                    $serviceId = $get('service_id');
                                    return $serviceId ? Subservice::where('service_id', $serviceId)->pluck('name', 'id') : [];
                                })
                                ->searchable()
                                ->disabled(fn (callable $get) => !$get('service_id'))
                                ->required(),
                        ]),

                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\DatePicker::make('travel_date')
                                ->label('Travel Date')
                                ->required(),

                            Forms\Components\TextInput::make('price')
                                ->label('Price')
                                ->numeric()
                                ->prefix('USD')
                                ->required(),
                        ]),

                    Forms\Components\Textarea::make('notes')
                        ->label('Notes')
                        ->columnSpanFull(),
                ]),
        ];
    }

    public function create()
    {
        $data = $this->form->getState();

        auth()->user()->reservations()->create($data);

        Notification::make()
        ->title('Reservation created successfully!')
        ->success()
        ->send();

        $this->form->fill();
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }
}
