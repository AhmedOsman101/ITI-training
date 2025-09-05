<x-layouts.app :title="__('Department Dashboard')">
  <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 ">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-neutral-800 dark:text-neutral-100">
        Edit Department
      </h1>
      <a href="{{ route('departments.index') }}"
        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
        Go Back
      </a>
    </div>

    <!-- Form -->
    <div
      class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
      <form action="{{ route('departments.update', $department) }}" method="POST" enctype="multipart/form-data"
        class="space-y-6 p-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
            Name
          </label>
          <input type="text" id="name" name="name" placeholder="Enter your name"
            value="{{ old('name', $department->name) }}"
            class="mt-1 w-full rounded-lg border border-neutral-300 bg-white p-2 text-neutral-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100" />
          @error('name')
          <p class="mt-1 text-sm" style="color:#964a50;">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4">
          <button type="submit"
            class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layouts.app>
