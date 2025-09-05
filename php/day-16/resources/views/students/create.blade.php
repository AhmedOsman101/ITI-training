<x-layouts.app :title="__('Student Dashboard')">
  <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 ">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-neutral-800 dark:text-neutral-100">
        Create Student
      </h1>
      <a href="{{ route('students.index') }}"
        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
        Go Back
      </a>
    </div>

    <!-- Form -->
    <div
      class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
      <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
        @csrf

        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
            Name
          </label>
          <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}"
            class="mt-1 w-full rounded-lg border border-neutral-300 bg-white p-2 text-neutral-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100" />
          @error('name')
          <p class="mt-1 text-sm" style="color:#964a50;">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
            Email
          </label>
          <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
            class="mt-1 w-full rounded-lg border border-neutral-300 bg-white p-2 text-neutral-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100" />
          @error('email')
          <p class="mt-1 text-sm" style="color:#964a50;">{{ $message }}</p>
          @enderror
        </div>

        <!-- Department -->
        <div>
          <label for="department" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
            Department
          </label>
          <select id="department" name="department_id"
            class="mt-1 w-full rounded-lg border border-neutral-300 bg-white p-2 text-neutral-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
            <option value="">Select a department</option>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id')==$department->id ? 'selected' : '' }}>
              {{ $department->name }}
            </option>
            @endforeach
          </select>
          @error('department_id')
          <p class="mt-1 text-sm" style="color:#964a50;">{{ $message }}</p>
          @enderror
        </div>


        <!-- Drag & Drop Upload -->
        <div x-data="{ fileName: '', preview: '' }" class="w-full">
          <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
            Profile Image
          </label>
          <div
            class="mt-2 flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-neutral-300 bg-neutral-50 p-6 text-center transition hover:border-blue-500 dark:border-neutral-600 dark:bg-neutral-800"
            x-on:drop.prevent="fileName = $event.dataTransfer.files[0].name; $refs.input.files = $event.dataTransfer.files; preview = URL.createObjectURL($event.dataTransfer.files[0])"
            x-on:dragover.prevent x-on:click="$refs.input.click()">
            <input type="file" name="image" class="hidden" x-ref="input"
              x-on:change="fileName = $refs.input.files[0].name; preview = URL.createObjectURL($refs.input.files[0])">
            <template x-if="!preview">
              <p class="text-sm text-neutral-500 dark:text-neutral-400">Drag & drop or click to upload</p>
            </template>
            <template x-if="preview">
              <img :src="preview" alt="Preview" class="mt-2 size-32 rounded object-scale-down shadow" />
            </template>
            <p class="mt-2 text-sm text-neutral-400" x-text="fileName"></p>
          </div>
          @error('image')
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
