<x-admin-layout>
    <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
    <p class="mt-2 text-gray-600">Welcome to the admin panel, {{ Auth::guard('admin')->user()->name }}.</p>
</x-admin-layout>

