<script setup lang="ts">
import {RiSettings4Line} from "@remixicon/vue";

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
        class="text-white bg-tm-green rounded-tm-6 px-4 py-3 cursor-pointer"
    >
      <div
          v-if="saving"
          class="flex items-center gap-2"
      >
        در حال ذخیره‌سازی
        <span class="loader"></span>
      </div>
      <div
          v-else
          class="flex items-center gap-2"
      >
        ذخیره تنظیمات
        <RiSettings4Line size="16px"/>
      </div>
    </button>
  </footer>
</template>