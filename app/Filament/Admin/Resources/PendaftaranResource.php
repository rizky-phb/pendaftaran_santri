<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use App\Mail\AkunDibuatMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pendaftaran Santri'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Pendaftar calon santri'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 1; // ← Tambahkan ini untuk posisi
    public function mount(): void
{
    if (Auth::user()->role === 'user') {
        redirect('/user')->send();
        exit;
    }
}
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')
                ->maxLength(35)
                ->minLength(3)
                ->extraAttributes([
                    'pattern' => '[a-zA-Z\s]{3,35}',
                    'oninput' => "if(this.value.length > 35) this.value = this.value.slice(0,35);",
                    'title' => "Nama harus 3-35 karakter (hanya huruf dan spasi)",
                    'onkeydown' => "return !(/[0-9]/.test(event.key));"
                ])
                ->required(),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('no_hp')
                    ->label('No. HP')
                    ->required()
                    ->tel() // Gunakan input type tel
                    ->placeholder('08xxxxxxxxxx')
                    ->maxLength(14)
                    ->minLength(10)
                    ->extraAttributes([
                        'pattern' => '^08[0-9]{8,12}$',
                        'title' => 'Nomor HP harus diawali 08 dan hanya angka (10-14 digit)',
                        'oninput' => "if(this.value.length > 14) this.value = this.value.slice(0,14);",
                        'onkeydown' => "return !(/[a-zA-Z\\s]/.test(event.key));"
                    ]),

                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(4)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('no_hp')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alamat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                // admin memverifikasi data yg dikirim pendaftar lalu mengklik tombol centang yang artinya user diperbolehkan untuk mendaftar dan user diberi akun role user, username dan password (password bisa automatis pake default 123 atau sesuatu yg unik dari nama email, nama lengkap dan alamatnya ) biar bisa login dan mengupload berkas untuk benar benar mendaftar
                Tables\Actions\Action::make('verifikasi')
                ->label('Verifikasi & Buat Akun')
                ->icon('heroicon-o-check')
                ->color('success')
                ->action(function (Pendaftaran $record) {
                    $password = '123456'; // atau generate dinamis

                    $existingUser = \App\Models\User::where('email', $record->email)->first();

                    if (!$existingUser) {
                        $user = \App\Models\User::create([
                            'name' => $record->nama_lengkap,
                            'email' => $record->email,
                            'password' => bcrypt($password),
                            'role' => 'user',
                        ]);

                        // Kirim email ke pendaftar
                        Mail::to($record->email)->send(new AkunDibuatMail(
                            $record->nama_lengkap,
                            $record->email,
                            $password
                        ));
                          // Buat entri pembayaran default
                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Pendaftaran Pondok',
                            'jumlah'           => 170000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);
                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Pendaftaran Mandtrasah Diniah',
                            'jumlah'           => 170000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Muawanah',
                            'jumlah'           => 850000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Seragam Olah Raga Pondok',
                            'jumlah'           => 360000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Jas Almamater',
                            'jumlah'           => 240000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Kitab Pengajian Pondok dan madrasah',
                            'jumlah'           => 995000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Atribut Pondok dan Batik Madin',
                            'jumlah'           => 385000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Kartu Santri',
                            'jumlah'           => 80000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'DP Awal Ziarah Wali Songo',
                            'jumlah'           => 500000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Masa Orientasi Santri',
                            'jumlah'           => 140000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Sariah Pondok Per bulan',
                            'jumlah'           => 160000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Sariah Madrasah Per bulan',
                            'jumlah'           => 140000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Makan Per bulan',
                            'jumlah'           => 450000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Kegiatan Santri Per bulan',
                            'jumlah'           => 100000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                        Pembayaran::create([
                            'user_id'          => $user->id,
                            'jenis_pembayaran' => 'Matrai',
                            'jumlah'           => 10000.00,
                            'bukti_transfer'   => null,
                            'tanggal_bayar'    => null,
                            'status'           => 'menunggu',
                        ]);

                    }

                    $record->update([
                        'status' => 'terverifikasi',
                    ]);
                })
                ->requiresConfirmation()
                ->visible(fn (Pendaftaran $record) =>
                    !\App\Models\User::where('email', $record->email)->exists()
                )
                ->successNotificationTitle('Akun berhasil dibuat & email telah dikirim!'),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('verifikasi_bulk')
                        ->label('Verifikasi & Buat Akun')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $password = '123456'; // atau generate dinamis

                                $existingUser = \App\Models\User::where('email', $record->email)->first();
                                $record->role = 'user';
                                if (!$existingUser) {
                                    \App\Models\User::create([
                                        'name' => $record->nama_lengkap,
                                        'email' => $record->email,
                                        'password' => bcrypt($password),
                                        'role' => $record->role ?? 'user',
                                    ]);

                                    // Kirim email ke pendaftar
                                    Mail::to($record->email)->send(new AkunDibuatMail(
                                        $record->nama_lengkap,
                                        $record->email,
                                        $password
                                    ));
                                }

                                $record->update([
                                    'status' => 'terverifikasi',
                                ]);
                            }
                        })
                        ->requiresConfirmation()
                        ->successNotificationTitle('Akun berhasil dibuat & email telah dikirim!'),
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
            'index' => Pages\ListPendaftaran::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
