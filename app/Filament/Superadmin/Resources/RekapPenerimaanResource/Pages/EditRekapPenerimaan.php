<?php

namespace App\Filament\Superadmin\Resources\RekapPenerimaanResource\Pages;

use App\Filament\Superadmin\Resources\RekapPenerimaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditRekapPenerimaan extends EditRecord
{
    protected static string $resource = RekapPenerimaanResource::class;

    protected static ?string $title = 'Edit Data Santri';

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Data Santri
        $data['santri']['nama_lengkap'] = $this->record->santri->nama_lengkap ?? null;
        $data['santri']['nisn'] = $this->record->santri->nisn ?? null;
        $data['santri']['tanggal_lahir'] = $this->record->santri->tanggal_lahir ?? null;
        $data['santri']['tempat_lahir'] = $this->record->santri->tempat_lahir ?? null;
        $data['santri']['agama'] = $this->record->santri->agama ?? null;
        $data['santri']['jenis_kelamin'] = $this->record->santri->jenis_kelamin ?? null;
        $data['santri']['alamat'] = $this->record->santri->alamat ?? null;

        // Data Orang Tua
        $data['ortu']['nama_ayah'] = $this->record->ortu->nama_ayah ?? null;
        $data['ortu']['nik_ayah'] = $this->record->ortu->nik_ayah ?? null;
        $data['ortu']['pendidikan_terakhir_ayah'] = $this->record->ortu->pendidikan_terakhir_ayah ?? null;
        $data['ortu']['pekerjaan_ayah'] = $this->record->ortu->pekerjaan_ayah ?? null;
        $data['ortu']['no_hp_ayah'] = $this->record->ortu->no_hp_ayah ?? null;
        $data['ortu']['nama_ibu'] = $this->record->ortu->nama_ibu ?? null;
        $data['ortu']['nik_ibu'] = $this->record->ortu->nik_ibu ?? null;
        $data['ortu']['pendidikan_terakhir_ibu'] = $this->record->ortu->pendidikan_terakhir_ibu ?? null;
        $data['ortu']['pekerjaan_ibu'] = $this->record->ortu->pekerjaan_ibu ?? null;
        $data['ortu']['no_hp_ibu'] = $this->record->ortu->no_hp_ibu ?? null;

        // Data Berkas
        $data['berkas']['berkas_fc_sttb'] = $this->record->berkas->berkas_fc_sttb ?? null;
        $data['berkas']['berkas_skhun'] = $this->record->berkas->berkas_skhun ?? null;
        $data['berkas']['berkas_pas_foto'] = $this->record->berkas->berkas_pas_foto ?? null;
        $data['berkas']['berkas_akte_kelahiran'] = $this->record->berkas->berkas_akte_kelahiran ?? null;
        $data['berkas']['berkas_blangko_pendaftaran'] = $this->record->berkas->berkas_blangko_pendaftaran ?? null;
        $data['berkas']['berkas_nisn'] = $this->record->berkas->berkas_nisn ?? null;
        $data['berkas']['berkas_kartu_keluarga'] = $this->record->berkas->berkas_kartu_keluarga ?? null;
        $data['berkas']['status'] = $this->record->berkas->status ?? null;

        return $data;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $userId = $this->record->id;

        // Update tabel santri
        if (isset($data['santri'])) {
            \App\Models\DataSantri::where('user_id', $userId)->update($data['santri']);
        }

        // Update tabel ortu
        if (isset($data['ortu'])) {
            \App\Models\DataOrtu::where('user_id', $userId)->update($data['ortu']);
        }

        // Update tabel berkas
        if (isset($data['berkas'])) {
            \App\Models\UploadBerkas::where('user_id', $userId)->update($data['berkas']);
        }

        // Hapus data relasi agar tidak error saat save ke tabel utama
        unset($data['santri'], $data['ortu'], $data['berkas']);

        return $data;
    }
}
