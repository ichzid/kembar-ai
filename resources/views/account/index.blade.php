@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-display font-bold text-gray-900 tracking-tight">Pengaturan Akun</h1>
            <p class="text-gray-500 text-lg font-light">Kelola nomor WhatsApp admin dan modul CRM Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">WhatsApp Admin</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Nomor WhatsApp yang akan digunakan untuk melatih AI.
                        </p>
                    </div>
                    <div class="w-full md:w-80">
                        <label for="admin_whatsapp_number" class="sr-only">Nomor WhatsApp Admin</label>
                        <input
                            type="text"
                            id="admin_whatsapp_number"
                            name="admin_whatsapp_number"
                            value="{{ old('admin_whatsapp_number', auth()->user()->admin_whatsapp_number) }}"
                            placeholder="Contoh: 6281234567890"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-[#d4af37] focus:ring-4 focus:ring-[#d4af37]/20 transition-all shadow-sm"
                        />
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Leads & CRM</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Mengaktifkan atau menonaktifkan modul Leads, Chat Logs, dan Decision Inbox.
                        </p>
                    </div>
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            name="leads_enabled"
                            id="leads_enabled"
                            class="toggle-input sr-only"
                            {{ auth()->user()->leads_enabled ? 'checked' : '' }}
                        />
                        <label for="leads_enabled" class="toggle-label relative inline-flex items-center cursor-pointer">
                            <span class="toggle-bg block w-11 h-6 rounded-full bg-gray-300 transition-colors"></span>
                            <span class="toggle-dot absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow transform transition-transform"></span>
                        </label>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
                <div class="space-y-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Contextual CTA</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Kendalikan apakah AI boleh menawarkan produk, komunitas, atau event beserta pesannya.
                            </p>
                        </div>
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                name="contextual_cta_enabled"
                                id="contextual_cta_enabled"
                                class="toggle-input sr-only"
                                {{ auth()->user()->contextual_cta_enabled ? 'checked' : '' }}
                            />
                            <label for="contextual_cta_enabled" class="toggle-label relative inline-flex items-center cursor-pointer">
                                <span class="toggle-bg block w-11 h-6 rounded-full bg-gray-300 transition-colors"></span>
                                <span class="toggle-dot absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow transform transition-transform"></span>
                            </label>
                        </div>
                    </div>

                    <div id="cta_text_wrapper" class="{{ auth()->user()->contextual_cta_enabled ? '' : 'hidden' }}">
                        <label for="contextual_cta_text" class="sr-only">Informasi CTA</label>
                        <textarea
                            id="contextual_cta_text"
                            name="contextual_cta_text"
                            rows="4"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-[#d4af37] focus:ring-4 focus:ring-[#d4af37]/20 transition-all shadow-sm"
                            placeholder="Contoh: penawaran produk utama, ajakan gabung komunitas, atau promosi event."
                        >{{ old('contextual_cta_text', auth()->user()->contextual_cta_text) }}</textarea>
                    </div>
                </div>
            </section>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-gray-900 text-[#d4af37] text-sm font-medium rounded-lg shadow-lg shadow-gray-900/20 hover:bg-black transition-all duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<style>
.toggle-input:checked + .toggle-label .toggle-bg {
    background-color: #d4af37;
}
.toggle-input:checked + .toggle-label .toggle-dot {
    transform: translateX(20px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctaToggle = document.getElementById('contextual_cta_enabled');
    var ctaWrapper = document.getElementById('cta_text_wrapper');

    if (ctaToggle && ctaWrapper) {
        ctaToggle.addEventListener('change', function () {
            if (ctaToggle.checked) {
                ctaWrapper.classList.remove('hidden');
            } else {
                ctaWrapper.classList.add('hidden');
            }
        });
    }
});
</script>

@endsection
