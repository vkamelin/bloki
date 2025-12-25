@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">Media</h1>
    <div class="mb-2">
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-200 flex items-center">
            <i class="ti ti-upload mr-1"></i> Upload Media
        </button>
    </div>
</div>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
    <div class="mb-2 md:mb-0">
        <div class="relative">
            <input type="text" placeholder="Search media..." class="form-input pl-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ti ti-search text-gray-400"></i>
            </div>
        </div>
    </div>
    <div class="flex space-x-2">
        <select class="form-input">
            <option>All Types</option>
            <option>Images</option>
            <option>Videos</option>
            <option>Documents</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative pb-[100%]">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29336?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80" alt="Media item" class="absolute h-full w-full object-cover">
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 truncate">team-photo.jpg</h3>
            <p class="text-xs text-gray-500 mt-1">2.4 MB</p>
            <div class="flex items-center mt-2">
                <span class="badge badge-primary text-xs">Image</span>
                <button class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="ti ti-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative pb-[100%]">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80" alt="Media item" class="absolute h-full w-full object-cover">
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 truncate">profile-picture.png</h3>
            <p class="text-xs text-gray-500 mt-1">1.8 MB</p>
            <div class="flex items-center mt-2">
                <span class="badge badge-primary text-xs">Image</span>
                <button class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="ti ti-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative pb-[100%] bg-gray-100 flex items-center justify-center">
            <i class="ti ti-file-text text-3xl text-gray-400"></i>
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 truncate">document.pdf</h3>
            <p class="text-xs text-gray-500 mt-1">4.2 MB</p>
            <div class="flex items-center mt-2">
                <span class="badge badge-warning text-xs">Document</span>
                <button class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="ti ti-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative pb-[100%] bg-gray-100 flex items-center justify-center">
            <i class="ti ti-video text-3xl text-gray-400"></i>
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 truncate">presentation.mp4</h3>
            <p class="text-xs text-gray-500 mt-1">45.7 MB</p>
            <div class="flex items-center mt-2">
                <span class="badge badge-danger text-xs">Video</span>
                <button class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="ti ti-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative pb-[100%]">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80" alt="Media item" class="absolute h-full w-full object-cover">
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 truncate">car.jpg</h3>
            <p class="text-xs text-gray-500 mt-1">3.1 MB</p>
            <div class="flex items-center mt-2">
                <span class="badge badge-primary text-xs">Image</span>
                <button class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="ti ti-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative pb-[100%]">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29336?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80" alt="Media item" class="absolute h-full w-full object-cover">
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 truncate">woman.jpg</h3>
            <p class="text-xs text-gray-500 mt-1">2.7 MB</p>
            <div class="flex items-center mt-2">
                <span class="badge badge-primary text-xs">Image</span>
                <button class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="ti ti-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-between">
    <div class="text-sm text-gray-700">
        Showing <span class="font-medium">1</span> to <span class="font-medium">6</span> of <span class="font-medium">24</span> results
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

<div class="mt-6">
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-800">Upload Media</h2>
        </div>
        <div class="p-6">
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                <div class="flex justify-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <i class="ti ti-upload text-2xl"></i>
                    </div>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Drag and drop files here</h3>
                <p class="mt-1 text-sm text-gray-500">or</p>
                <button class="mt-2 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-200">
                    Browse Files
                </button>
                <p class="mt-2 text-xs text-gray-500">Supports: JPG, PNG, GIF, MP4, PDF, DOC</p>
            </div>
        </div>
    </div>
</div>
@endsection