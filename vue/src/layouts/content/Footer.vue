<script setup lang="ts">
defineProps<{
  saving: boolean
}>()
const emit = defineEmits<{
  (e: 'save'): void
}>()
</script>

<template>
  <footer class="pt-4 border-t border-dashed border-tm-light-grey">
    <button
        type="button"
        @click="emit('save')"
        class="text-white bg-tm-green rounded-tm-6 px-6 py-2 cursor-pointer"
    >
      <div
          v-if="saving"
          class="flex items-center gap-2"
      >
        در حال ذخیره‌سازی
        <span class="loader"></span>
      </div>
      <div v-else>
        ذخیره تنظیمات
      </div>
    </button>
  </footer>
</template>