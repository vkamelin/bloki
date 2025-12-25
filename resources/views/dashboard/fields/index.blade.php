@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">Fields</h1>
    <div class="mb-2">
        <a href="{{ route('dashboard.fields.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-200 flex items-center">
            <i class="ti ti-plus mr-1"></i> Add Field
        </a>
    </div>
</div>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
    <div class="mb-2 md:mb-0">
        <div class="relative">
            <input type="text" placeholder="Search fields..." class="form-input pl-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ti ti-search text-gray-400"></i>
            </div>
        </div>
    </div>
    <div class="flex space-x-2">
        <select class="form-input">
            <option>All Types</option>
            <option>Text</option>
            <option>Textarea</option>
            <option>Rich Text</option>
            <option>Image</option>
            <option>File</option>
            <option>Date</option>
            <option>Boolean</option>
        </select>
        <select class="form-input">
            <option>All Groups</option>
            <option>Blog Post Fields</option>
            <option>Product Details</option>
            <option>SEO Settings</option>
        </select>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Label</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Title</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">title</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Text</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Blog Post Fields</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="badge badge-success">Yes</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dashboard.fields.show', 1) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('dashboard.fields.edit', 1) }}" class="text-indigo-500 hover:text-indigo-700 mr-3">
                            <i class="ti ti-edit"></i>
                        </a>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Content</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">content</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rich Text</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Blog Post Fields</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="badge badge-success">Yes</span>
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
                        <div class="text-sm font-medium text-gray-900">Featured Image</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">featured_image</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Image</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Blog Post Fields</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="badge badge-danger">No</span>
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
            <h2 class="text-lg font-medium text-gray-800">Field Types</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-500 mr-3">
                            <i class="ti ti-text-size"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Text</h3>
                            <p class="text-sm text-gray-500">Single line text</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-green-100 text-green-500 mr-3">
                            <i class="ti ti-align-left"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Textarea</h3>
                            <p class="text-sm text-gray-500">Multi-line text</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-purple-100 text-purple-500 mr-3">
                            <i class="ti ti-photo"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Image</h3>
                            <p class="text-sm text-gray-500">Image upload</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-500 mr-3">
                            <i class="ti ti-calendar"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Date</h3>
                            <p class="text-sm text-gray-500">Date picker</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection