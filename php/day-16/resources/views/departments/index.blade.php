<x-layouts.app :title="__('Department Dashboard')">
  <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 ">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-neutral-800 dark:text-neutral-100">
        Departments CRUD
      </h1>
      <a href="{{ route('departments.create') }}"
        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 focus:outline-none">
        Create Department
      </a>
    </div>

    <!-- Table -->
    <div class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
      <table class="min-w-full table-auto divide-y divide-neutral-200 dark:divide-neutral-700">
        <thead class="bg-neutral-900 w-full">
          <tr>
            <th scope="col" class="px-4 py-2 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-200">
              ID
            </th>
            <th scope="col" class="px-4 py-2 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-200">
              Name
            </th>
            <th scope="col" class="px-4 py-2 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-200">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700 text-center">
          @foreach ($departments as $department)
          <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800">
            <th scope="row" class="px-4 py-2 text-sm text-neutral-900 dark:text-neutral-100">
              <a href="{{ route('departments.show', $department) }}" class="block w-full h-full cursor-pointer">
                {{ $department->id }}
              </a>
            </th>
            <td class="px-4 py-2 text-sm text-neutral-700 dark:text-neutral-300">
              <a href="{{ route('departments.show', $department) }}" class="block w-full h-full cursor-pointer">
                {{ $department->name }}
              </a>
            </td>
            <td class="px-4 flex py-2 justify-center">
              <div class="flex items-center gap-4 w-fit">
                <a href="{{ route('departments.edit', $department) }}"
                  class="cursor-pointer text-xl hover:text-blue-400">
                  
                </a>
                <form action="{{ route('departments.destroy', $department) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="cursor-pointer text-2xl" style="color: #964a50;"
                    x-on:click.prevent="await sweetConfirm() ? $el.closest('form').submit() : false">
                    󰆴
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-layouts.app>
