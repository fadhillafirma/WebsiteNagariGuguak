@php
    $fields = [
        'petani' => 'Petani',
        'pegawai_negeri' => 'Pegawai Negeri',
        'karyawan_swasta' => 'Karyawan Swasta',
        'pedagang' => 'Pedagang',
        'tni' => 'TNI',
        'pensiunan' => 'Pensiunan',
        'aparat_pemerintahan' => 'Aparat Pemerintahan',
        'pekerjaan_lain' => 'Pekerjaan Lain',
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @foreach($fields as $name => $label)
        <div>
            <label class="block text-gray-700 mb-1">{{ $label }}</label>
            <input type="number" min="0" name="{{ $name }}"
                   value="{{ old($name, $row?->$name ?? 0) }}"
                   class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>
    @endforeach
</div>
