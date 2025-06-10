<?php

namespace App\Filament\User\Resources\DataSantriResource\Pages;

use App\Models\DataSantri;
use App\Filament\User\Resources\DataSantriResource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class ManageDataSantri extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = DataSantriResource::class;
    protected static string $view = 'livewire.user.pages.manage-data-santri';

    public ?DataSantri $record = null;

    public function mount(): void
    {
        $this->record = DataSantri::firstOrNew([
            'user_id' => auth()->id(),
        ]);

        $this->form->fill($this->record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->model($this->record)
            ->schema([
                TextInput::make('nama_lengkap')->required(),
                TextInput::make('nisn')->numeric()->required(),
                DatePicker::make('tanggal_lahir')->required(),
                TextInput::make('tempat_lahir')->required(),
                TextInput::make('agama')->required(),
                Select::make('jenis_kelamin')
                    ->options([
                        'laki-laki' => 'Laki-laki',
                        'perempuan' => 'Perempuan',
                    ])
                    ->required(),
                Textarea::make('alamat')->required(),
            ]);
    }

    public function save(): void
    {
        $data = $this->form;

        $this->record->fill($data);
        $this->record->user_id = auth()->id();
        $this->record->save();

        $this->notify('success', 'Data berhasil disimpan!');
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('Simpan')
                ->action('save')
                ->color('primary'),
        ];
    }
}
