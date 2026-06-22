<script setup lang="ts">
import {RiMenuLine, RiMoonFill, RiSunFill} from "@remixicon/vue";

defineProps<{
  sidebarOpen: boolean
  isDark: boolean
}>()

const emit = defineEmits<{
  openSidebar: []
  toggleTheme: []
}>()

const openSidebar = () => {
  emit('openSidebar')
}

const toggleTheme = () => {
  emit('toggleTheme')
}
</script>

<template>
  <header class="flex items-center justify-between border-b border-dashed border-tm-light-grey py-4">
    <button
        type="button"
        @click="openSidebar"
        class="lg:hidden"
    >
      <RiMenuLine size="24px"/>
    </button>
    <h2 class="text-2xl">Welcome to Themora 2</h2>
    <button
        type="button"
        @click="toggleTheme"
        class="flex items-center justify-center size-tm-40 rounded-full border border-tm-light-grey cursor-pointer"
    >
      <RiSunFill v-if="isDark" size="20px" color="var(--color-tm-secondary)"/>
      <RiMoonFill v-else size="20px" color="var(--color-tm-dark)"/>
    </button>
  </header>
</template>