@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">Sections</h1>
    <div class="mb-2">
        <a href="{{ route('dashboard.sections.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-200 flex items-center">
            <i class="ti ti-plus mr-1"></i> Add Section
        </a>
    </div>
</div>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
    <div class="mb-2 md:mb-0">
        <div class="relative">
            <input type="text" placeholder="Search sections..." class="form-input pl-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ti ti-search text-gray-400"></i>
            </div>
        </div>
    </div>
    <div class="flex space-x-2">
        <select class="form-input">
            <option>All Types</option>
            <option>Page</option>
            <option>Category</option>
            <option>Tag</option>
        </select>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entries</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Blog</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">blog</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Page</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">24</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-success">Published</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dashboard.sections.show', 1) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('dashboard.sections.edit', 1) }}" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-edit"></i>
                        </a>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Products</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">products</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Page</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-success">Published</span>
                    </td>
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
                        <div class="text-sm font-medium text-gray-900">News</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">news</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Category</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-warning">Draft</span>
                    </td>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('dashboard.sections.create') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-500 mr-3">
                            <i class="ti ti-layout"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Create Section</h3>
                            <p class="text-sm text-gray-500">Add a new section</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-green-100 text-green-500 mr-3">
                            <i class="ti ti-file-import"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Import Sections</h3>
                            <p class="text-sm text-gray-500">Import from file</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-purple-100 text-purple-500 mr-3">
                            <i class="ti ti-file-export"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Export Sections</h3>
                            <p class="text-sm text-gray-500">Download as file</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection