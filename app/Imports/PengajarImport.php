<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Validators\Failure;

class PengajarImport implements
    ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    private $unit;
    private $role;
    private $unitSlug;

    public $imported = 0;
    public $failed = 0;
    public $duplicates = 0;
    public $duplicateEntries = [];
    public $successEntries = [];

    public function __construct($unit)
    {
        $this->unit = $unit;
        $data_unit = \App\Models\Modules\Unit::where('id', $unit)->first();
        $this->unitSlug = $data_unit->slug;
        $this->role = 'pengajar-'.$this->unitSlug;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            try {
                // Validasi data row
                if (empty($row['nama']) || empty($row['nomor_handphone']) || empty($row['pengajar'])) {
                    $this->failed++;
                    continue;
                }

                // Cek duplikat berdasarkan kode_nama_pengajar dalam unit yang sama
                $pengajarExists = \App\Models\Pengajar::where('kode_nama_pengajar', $row['pengajar'])
                    ->where('unit_id', $this->unit)
                    ->exists();

                if ($pengajarExists) {
                    $this->duplicates++;
                    $this->duplicateEntries[] = [
                        'row' => $index + 2, // +2 karena heading row + index mulai dari 0
                        'nama' => $row['nama'] ?? '',
                        'nomor_handphone' => $row['nomor_handphone'] ?? '',
                        'pengajar' => $row['pengajar'] ?? '',
                        'reason' => 'Kode pengajar sudah ada di unit ini'
                    ];
                    continue;
                }

                // Cek duplikat nomor handphone untuk user yang sama
                $userExists = \App\Models\User::where('phone_number', $row['nomor_handphone'])->first();

                if ($userExists) {
                    // Cek jika user sudah menjadi pengajar di unit ini
                    $alreadyPengajar = \App\Models\Pengajar::where('user_id', $userExists->id)
                        ->where('unit_id', $this->unit)
                        ->exists();

                    if ($alreadyPengajar) {
                        $this->duplicates++;
                        $this->duplicateEntries[] = [
                            'row' => $index + 2,
                            'nama' => $row['nama'] ?? '',
                            'nomor_handphone' => $row['nomor_handphone'] ?? '',
                            'pengajar' => $row['pengajar'] ?? '',
                            'reason' => 'User sudah menjadi pengajar di unit ini'
                        ];
                        continue;
                    }
                }

                // Proses create user dan pengajar
                $user = \App\Models\User::firstOrCreate([
                    'phone_number' => $row['nomor_handphone'],
                ], [
                    'name' => $row['nama'],
                    'email' => null,
                    'phone_code' => '62',
                    'code_access' => null,
                    'code_access_max_date' => null,
                    'password' => null,
                ]);

                $pengajar = \App\Models\Pengajar::firstOrCreate([
                    'kode_nama_pengajar' => $row['pengajar'],
                ],[
                    'user_id' => $user->id,
                    'unit_id' => $this->unit,
                ]);

                // Assign role jika belum memiliki role ini
                if (!$user->hasRole($this->role)) {
                    $user->assignRole($this->role);
                }

                $this->imported++;
                $this->successEntries[] = [
                    'nama' => $row['nama'],
                    'nomor_handphone' => $row['nomor_handphone'],
                    'pengajar' => $row['pengajar']
                ];

            } catch (\Exception $e) {
                $this->failed++;
                // Anda bisa menambahkan log error di sini
                // \Log::error('Import error pada baris ' . ($index + 2) . ': ' . $e->getMessage());
            }
        }
    }

    public function rules(): array
    {
        return [
            // '*.nama' => 'required|string|max:255',
            // '*.nomor_handphone' => [
            //     'required',
            //     'string',
            //     'max:20',
            //     Rule::unique('users', 'phone_number')->where(function ($query) {
            //         return $query->whereNotNull('phone_number');
            //     })
            // ],
            // '*.pengajar' => [
            //     'required',
            //     'string',
            //     'max:100',
            //     Rule::unique('pengajars', 'kode_nama_pengajar')->where(function ($query) {
            //         return $query->where('unit_id', $this->unit);
            //     })
            // ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nomor_handphone.required' => 'Nomor handphone wajib diisi',
            'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar',
            'pengajar.required' => 'Kode pengajar wajib diisi',
            'pengajar.unique' => 'Kode pengajar sudah ada di unit ini',
        ];
    }

    public function onError(\Throwable $e)
    {
        $this->failed++;
    }

    public function getImportResults()
    {
        return [
            'imported' => $this->imported,
            'failed' => $this->failed,
            'duplicates' => $this->duplicates,
            'duplicate_entries' => $this->duplicateEntries,
            'success_entries' => $this->successEntries,
            'failures' => $this->failures(),
            'unit' => $this->unitSlug
        ];
    }

    public function headingRow(): int
    {
        return 1; // Baris pertama sebagai heading
    }
}
