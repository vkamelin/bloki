@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">Entries</h1>
    <div class="mb-2">
        <a href="{{ route('dashboard.entries.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-200 flex items-center">
            <i class="ti ti-plus mr-1"></i> Add Entry
        </a>
    </div>
</div>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
    <div class="mb-2 md:mb-0">
        <div class="relative">
            <input type="text" placeholder="Search entries..." class="form-input pl-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ti ti-search text-gray-400"></i>
            </div>
        </div>
    </div>
    <div class="flex space-x-2">
        <select class="form-input">
            <option>All Collections</option>
            <option>Blog Posts</option>
            <option>Products</option>
            <option>Team Members</option>
        </select>
        <select class="form-input">
            <option>All Statuses</option>
            <option>Published</option>
            <option>Draft</option>
            <option>Archived</option>
        </select>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                            <span class="ml-2">Title</span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Collection</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-500 focus:ring-blue-500 mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900">Getting Started with CMS</div>
                                <div class="text-sm text-gray-500">/blog/getting-started-with-cms</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Blog Posts</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-success">Published</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 1, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dashboard.entries.show', 1) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('dashboard.entries.edit', 1) }}" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-edit"></i>
                        </a>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-500 focus:ring-blue-500 mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900">How to Build a Website</div>
                                <div class="text-sm text-gray-500">/blog/how-to-build-a-website</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Blog Posts</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-warning">Draft</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 2, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="#" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-edit"></i>
                        </a>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-500 focus:ring-blue-500 mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900">Meet Our Team</div>
                                <div class="text-sm text-gray-500">/about/team</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Team Members</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29336?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-success">Published</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 3, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="#" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-edit"></i>
                        </a>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">3</span> results
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
            <h2 class="text-lg font-medium text-gray-800">Quick Actions</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('dashboard.entries.create') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-500 mr-3">
                            <i class="ti ti-file-plus"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Create Entry</h3>
                            <p class="text-sm text-gray-500">Add new content</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-green-100 text-green-500 mr-3">
                            <i class="ti ti-file-check"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Publish Selected</h3>
                            <p class="text-sm text-gray-500">Make live</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-500 mr-3">
                            <i class="ti ti-file-pencil"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Draft Selected</h3>
                            <p class="text-sm text-gray-500">Save as draft</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-red-100 text-red-500 mr-3">
                            <i class="ti ti-trash"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Delete Selected</h3>
                            <p class="text-sm text-gray-500">Remove entries</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
