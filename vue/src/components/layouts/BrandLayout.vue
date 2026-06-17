<script setup lang="ts">
defineProps<{
  collapsed: boolean
}>()
</script>

<template>
  <div class="fd-setting-brand-wrapper flex items-center gap-tm-10 px-tm-20 py-tm-30">
    <div v-show="!collapsed" class="tm-brand-texts flex items-end flex-col">
      <p class="brand-text">پنل تنظیمات
        <span class="text-white">تیمورا</span>
      </p>
      <p class="brand-slogan text-white">Themora Option Panel</p>
    </div>
    <img
        src="http://localhost/wp-developer/faradid/wp-content/themes/faradid/assets/admin/images/settings/logo-light.svg"
        width="48"/>
  </div>
</template>