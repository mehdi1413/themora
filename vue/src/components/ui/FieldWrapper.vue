<script setup lang="ts">
withDefaults(
    defineProps<{
      label?: string
      id?: string
      isNumberField?: boolean
    }>(),
    {
      isNumberField:false
    }
)
</script>

<template>
  <div class="tm-field-wrapper grid grid-cols-1 md:grid-cols-[30%_1fr] items-center gap-4 py-tm-10" :class="{'tm-number-input-wrapper': isNumberField}">
    <div class="tm-field-label">
      <label :for="id">{{ label }}</label>
    </div>

    <div class="tm-field-content">
      <slot/>
    </div>
  </div>
</template>