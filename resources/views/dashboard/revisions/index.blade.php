@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">Revisions</h1>
</div>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
    <div class="mb-2 md:mb-0">
        <div class="relative">
            <input type="text" placeholder="Search revisions..." class="form-input pl-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ti ti-search text-gray-400"></i>
            </div>
        </div>
    </div>
    <div class="flex space-x-2">
        <select class="form-input">
            <option>All Content Types</option>
            <option>Entries</option>
            <option>Collections</option>
            <option>Sections</option>
        </select>
        <select class="form-input">
            <option>All Users</option>
            <option>John Doe</option>
            <option>Jane Smith</option>
        </select>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Getting Started with CMS</div>
                        <div class="text-sm text-gray-500">Entry #1</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Update</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 1, 2023 10:30 AM</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dashboard.revisions.show', 1) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('dashboard.revisions.compare', 1) }}" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-file-diff"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Blog Posts</div>
                        <div class="text-sm text-gray-500">Collection #1</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29336?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Create</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 1, 2023 9:15 AM</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="#" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-file-diff"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">News</div>
                        <div class="text-sm text-gray-500">Section #3</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Update</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 31, 2022 3:45 PM</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="#" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-file-diff"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">24</span> results
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 rounded-md bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Previous
                </button>
                <button class="px-3 py-1 rounded-md bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-800">Revision Statistics</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-700">142</div>
                    <div class="text-sm text-blue-600">Total Revisions</div>
                </div>
                <div class="p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-700">86</div>
                    <div class="text-sm text-green-600">Entry Revisions</div>
                </div>
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-700">32</div>
                    <div class="text-sm text-yellow-600">Collection Revisions</div>
                </div>
                <div class="p-4 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-700">24</div>
                    <div class="text-sm text-purple-600">Section Revisions</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection