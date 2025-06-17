<?php

namespace App\Filament\Admin\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class VerifikasiBerkasExporter extends Exporter
{
    protected static ?string $model = User::class;

    // Gabungkan data user (role user) dengan data santri, ortu, dan upload berkas
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'user')
            ->with(['santri', 'ortu', 'berkas']); // pastikan relasi ini ada di model User
    }
    public static function getDirectory(): string
{
    return 'exports'; // folder di dalam disk yang kamu set
}
    public static function getColumns(): array
    {
        // Define your export columns here, for example:
        return [
            ExportColumn::make('name')->label('Nama'),
            ExportColumn::make('email')->label('Email'),

            // Data Santri
            ExportColumn::make('santri.nama_lengkap')->label('Nama Lengkap Santri'),
            ExportColumn::make('santri.nisn')->label('NISN'),
            ExportColumn::make('santri.tanggal_lahir')->label('Tanggal Lahir'),
            ExportColumn::make('santri.tempat_lahir')->label('Tempat Lahir'),
            ExportColumn::make('santri.agama')->label('Agama'),
            ExportColumn::make('santri.jenis_kelamin')->label('Jenis Kelamin'),
            ExportColumn::make('santri.alamat')->label('Alamat'),

            // Data Orang Tua
            ExportColumn::make('ortu.nama_ayah')->label('Nama Ayah'),
            ExportColumn::make('ortu.nik_ayah')->label('NIK Ayah'),
            ExportColumn::make('ortu.pendidikan_terakhir_ayah')->label('Pendidikan Terakhir Ayah'),
            ExportColumn::make('ortu.pekerjaan_ayah')->label('Pekerjaan Ayah'),
            ExportColumn::make('ortu.no_hp_ayah')->label('No HP Ayah'),
            ExportColumn::make('ortu.nama_ibu')->label('Nama Ibu'),
            ExportColumn::make('ortu.nik_ibu')->label('NIK Ibu'),
            ExportColumn::make('ortu.pendidikan_terakhir_ibu')->label('Pendidikan Terakhir Ibu'),
            ExportColumn::make('ortu.pekerjaan_ibu')->label('Pekerjaan Ibu'),
            ExportColumn::make('ortu.no_hp_ibu')->label('No HP Ibu'),

            // Data Berkas
            //ExportColumn::make('berkas.berkas_fc_sttb')->label('FC STTB'),
            //ExportColumn::make('berkas.berkas_skhun')->label('SKHUN'),
            //ExportColumn::make('berkas.berkas_pas_foto')->label('Pas Foto'),
            //ExportColumn::make('berkas.berkas_akte_kelahiran')->label('Akte Kelahiran'),
            //ExportColumn::make('berkas.berkas_blangko_pendaftaran')->label('Blangko Pendaftaran'),
            //ExportColumn::make('berkas.berkas_nisn')->label('Berkas NISN'),
            //ExportColumn::make('berkas.berkas_kartu_keluarga')->label('Kartu Keluarga'),
            ExportColumn::make('berkas.status')->label('Status Berkas'),
            // Add other columns as needed
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Ekspor selesai. <a href="' . $export->getUrl() . '" class="underline font-bold text-primary-600">Klik di sini untuk mengunduh file.</a>';
    }
}
