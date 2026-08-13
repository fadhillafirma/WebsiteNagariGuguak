@extends('layout.sidebar')
@section('title', 'Edit Demografi Pekerjaan')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6 md:py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Demografi Pekerjaan (Tahun {{ $row->tahun }})</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('demografi-pekerjaan.update', $row->id_pekerjaan) }}" method="POST"
          class="bg-white p-4 md:p-6 rounded-lg shadow space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block text-gray-700 mb-1">Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun', $row->tahun) }}" min="1900" max="{{ date('Y')+1 }}"
                   class="w-full rounded-lg border border-gray-300 py-2 p-2  focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        @include('admin.demografiPekerjaan._fields', ['row' => $row])

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('demografi-pekerjaan.index') }}"
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
