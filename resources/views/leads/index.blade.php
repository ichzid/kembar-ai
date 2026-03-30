@extends('layouts.app')

@section('title', 'Leads Management')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight">Leads</h1>
            <p class="text-gray-500 text-base md:text-lg font-light">Prospek yang terkumpul dari interaksi AI.</p>
        </div>
        <div class="flex space-x-3 w-full md:w-auto">
            <a href="{{ $leadsDisabled ? '#' : route('leads.export') }}" class="flex-1 md:flex-none justify-center px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-all duration-200 flex items-center {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export CSV
            </a>
        </div>
    </div>

    @if($leadsDisabled)
        <div class="rounded-2xl border border-yellow-200 bg-yellow-50 px-4 py-3 flex items-start space-x-3">
            <div class="mt-0.5">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 5a7 7 0 00-7 7 7 7 0 0012.02 4.24" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-800">Leads & CRM dalam keadaan nonaktif.</p>
                <p class="text-xs text-yellow-700 mt-1">
                    Aktifkan toggle Leads & CRM di Pengaturan Akun untuk mengaktifkan fitur Leads, Chat Logs, dan Decision Inbox.
                </p>
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden {{ $leadsDisabled ? 'opacity-60' : '' }}">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat & Minat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahapan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Interaksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($leads as $lead)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                    {{ substr($lead->name ?? '?', 0, 2) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $lead->name ?? 'Tanpa Nama' }}</div>
                                    <div class="text-xs text-gray-500" title="{{ $lead->persona->persona_name ?? '-' }}">
                                        Persona: {{ Str::limit($lead->persona->persona_name ?? '-', 20, '...') }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $lead->phone }}</div>
                            <div class="text-xs text-gray-500">{{ $lead->email ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 truncate max-w-xs">{{ $lead->address ?? '-' }}</div>
                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ $lead->interest ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ ucfirst($lead->conversation_stage ?? 'New') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $lead->last_interaction_at ? $lead->last_interaction_at->diffForHumans() : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-lg font-medium text-gray-900">Belum ada leads</p>
                                <p class="text-sm text-gray-500">Data leads akan muncul di sini setelah interaksi dimulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $leads->firstItem() ?? 0 }} sampai {{ $leads->lastItem() ?? 0 }} dari {{ $leads->total() }} data leads.
            </p>
            <div class="mt-2 md:mt-0">
                {{ $leads->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
