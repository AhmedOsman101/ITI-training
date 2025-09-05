@if (session('success'))
<template x-if="showFlash">
  <div
    class="rounded-lg border border-neutral-600 font-semibold pl-5 pr-3 py-2 flex items-center justify-between text-white bg-green-600">
    <span>{{ session('success') }}</span>
    <button class="text-xl" x-on:click="showFlash = false">  </button>
  </div>
</template>
@elseif (session('error'))
<template x-if="showFlash">
  <div
    class="rounded-lg border border-neutral-600 font-semibold text-neutral-100 pl-5 pr-3 py-2 flex items-center justify-between"
    style="background-color: #964a50;">
    <span>{{ session('error') }}</span>
    <button class="text-xl" x-on:click="showFlash = false">  </button>
  </div>
</template>
@endif
