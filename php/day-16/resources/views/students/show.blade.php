<x-layouts.app :title="__('Student Dashboard')">
  <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 bg-neutral-900">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-neutral-100">
        Student Info
      </h1>
      <a href="{{ route('students.index') }}"
        class="rounded-lg bg-neutral-700 px-4 py-2 text-sm font-medium text-neutral-100 shadow hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500">
        Go Back
      </a>
    </div>

    <!-- Student Card -->
    <div
      class="relative flex flex-col md:flex-row items-start md:items-center gap-6 rounded-xl border border-neutral-700 bg-neutral-800 p-6 shadow">
      <!-- Image -->
      <div>
        @if ($student->image)
        <img
          class="h-32 w-32 rounded-full object-cover flex items-center justify-center border border-neutral-600 text-neutral-400"
          src="{{ storage_url($student->image)  }}" alt="{{ $student->name }}">
        @else
        <div
          class="h-32 w-32 flex items-center justify-center rounded-full bg-neutral-700 text-neutral-400 border border-neutral-600">
          No Image
        </div>
        @endif
      </div>

      <!-- Info -->
      <div class="flex-1">
        <h2 class="text-xl font-bold text-gray-100">{{ $student->name }}</h2>
        <p class="text-gray-200">{{ $student->email }}</p>
        <p class="mt-2 text-sm font-medium text-gray-200">
          Department: {{ $student->department->name }}
        </p>
      </div>

      <!-- Actions -->
      <div class="flex items-center gap-3 self-start md:self-center">
        <a href="{{ route('students.edit', $student) }}"
          class="rounded-lg bg-neutral-600 px-4 py-2 text-sm font-medium text-neutral-100 shadow hover:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-400 transition-colors">
          Edit
        </a>
        <form action="{{ route('students.destroy', $student) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="rounded-lg bg-red-900 px-4 py-2 text-sm font-medium text-neutral-100 shadow hover:bg-red-800 focus:outline-none transition-colors cursor-pointer"
            x-on:click.prevent="await sweetConfirm() ? $el.closest('form').submit() : false">
            Delete
          </button>
        </form>
      </div>
    </div>
  </div>
</x-layouts.app>
