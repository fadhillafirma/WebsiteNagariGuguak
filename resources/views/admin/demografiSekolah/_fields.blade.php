<div>
    <label class="block text-gray-700 mb-1">Tahun</label>
    <input type="number" name="tahun" value="{{ old('tahun', $row->tahun ?? '') }}" min="1900" max="{{ date('Y')+1 }}"
           class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
</div>

<div>
    <label class="block text-gray-700 mb-1">Jumlah SD</label>
    <input type="number" name="jumlah_sd" value="{{ old('jumlah_sd', $row->jumlah_sd ?? 0) }}"
           class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
</div>

<div>
    <label class="block text-gray-700 mb-1">Jumlah SMP</label>
    <input type="number" name="jumlah_smp" value="{{ old('jumlah_smp', $row->jumlah_smp ?? 0) }}"
           class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
</div>

<div>
    <label class="block text-gray-700 mb-1">Jumlah SMA</label>
    <input type="number" name="jumlah_sma" value="{{ old('jumlah_sma', $row->jumlah_sma ?? 0) }}"
           class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
</div>

<div>
    <label class="block text-gray-700 mb-1">Jumlah PAUD</label>
    <input type="number" name="jumlah_paud" value="{{ old('jumlah_paud', $row->jumlah_paud ?? 0) }}"
           class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
</div>
