<x-layouts.app :title="__('Department Dashboard')">
  <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 bg-neutral-900">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-neutral-100">
        Department Info
      </h1>
      <a href="{{ route('departments.index') }}"
        class="rounded-lg bg-neutral-700 px-4 py-2 text-sm font-medium text-neutral-100 shadow hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500">
        Go Back
      </a>
    </div>

    <!-- Department Card -->
    <div
      class="relative flex flex-col md:flex-row items-start md:items-center gap-6 rounded-xl border border-neutral-700 bg-neutral-800 p-6 shadow">
      <!-- Info -->
      <div class="flex-1">
        <h2 class="text-xl font-bold text-gray-100">{{ $department->name }}</h2>
      </div>

      <!-- Actions -->
      <div class="flex items-center gap-3 self-start md:self-center">
        <a href="{{ route('departments.edit', $department) }}"
          class="rounded-lg bg-neutral-600 px-4 py-2 text-sm font-medium text-neutral-100 shadow hover:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-400 transition-colors">
          Edit
        </a>
        <form action="{{ route('departments.destroy', $department) }}" method="POST">
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
