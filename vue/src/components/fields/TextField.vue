<script setup lang="ts">
import FieldWrapper from "../ui/FieldWrapper.vue";

defineProps<{
  id: string
  label: string
  modelValue: string
  placeholder?: string
}>()

defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()
</script>

<template>
  <FieldWrapper :id="id" :label="label">
    <input
        type="text"
        :id="id"
        :placeholder="placeholder"
        :value="modelValue"
        @input="$emit('update:modelValue',($event.target as HTMLInputElement).value)"
    >
  </FieldWrapper>
</template>
