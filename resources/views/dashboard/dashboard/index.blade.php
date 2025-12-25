@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                <i class="ti ti-book-2 text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-medium text-gray-700">Collections</h5>
                <p class="text-2xl font-bold text-gray-900">12</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('dashboard.collections.index') }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center">
                View all
                <i class="ti ti-arrow-right text-xs ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                <i class="ti ti-file-text text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-medium text-gray-700">Entries</h5>
                <p class="text-2xl font-bold text-gray-900">142</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('dashboard.entries.index') }}" class="text-green-500 hover:text-green-700 text-sm font-medium flex items-center">
                View all
                <i class="ti ti-arrow-right text-xs ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                <i class="ti ti-users text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-medium text-gray-700">Users</h5>
                <p class="text-2xl font-bold text-gray-900">8</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('dashboard.users.index') }}" class="text-purple-500 hover:text-purple-700 text-sm font-medium flex items-center">
                View all
                <i class="ti ti-arrow-right text-xs ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                <i class="ti ti-photo text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-medium text-gray-700">Media</h5>
                <p class="text-2xl font-bold text-gray-900">86</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('dashboard.media.index') }}" class="text-yellow-500 hover:text-yellow-700 text-sm font-medium flex items-center">
                View all
                <i class="ti ti-arrow-right text-xs ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                <i class="ti ti-layout-grid text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-medium text-gray-700">Field Groups</h5>
                <p class="text-2xl font-bold text-gray-900">24</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('dashboard.field-groups.index') }}" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center">
                View all
                <i class="ti ti-arrow-right text-xs ml-1"></i>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-500 mr-4">
                <i class="ti ti-forms text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-medium text-gray-700">Fields</h5>
                <p class="text-2xl font-bold text-gray-900">64</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('dashboard.fields.index') }}" class="text-indigo-500 hover:text-indigo-700 text-sm font-medium flex items-center">
                View all
                <i class="ti ti-arrow-right text-xs ml-1"></i>
            </a>
        </div>
    </div>
</div>

<div class="mt-8">
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-800">Recent Activity</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="ti ti-plus text-blue-500 text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-700">New entry <span class="font-medium">"Getting Started with CMS"</span> was created</p>
                        <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="ti ti-edit text-green-500 text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-700">Collection <span class="font-medium">"Blog Posts"</span> was updated</p>
                        <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="ti ti-user-plus text-purple-500 text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-700">New user <span class="font-medium">"Alex Johnson"</span> was added</p>
                        <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
