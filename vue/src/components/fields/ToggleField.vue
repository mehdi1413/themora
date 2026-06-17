<script setup lang="ts">
import FieldWrapper from "../ui/FieldWrapper.vue";
import ToggleFieldSvg from "../ui/ToggleFieldSvg.vue";

defineProps<{
  id: string
  label: string
  modelValue: boolean
}>()

defineEmits<{
  (e: 'update:modelValue', value: boolean): void
}>()
</script>

<template>
  <FieldWrapper :id="id" :label="label">
    <input
        type="checkbox"
        :id="id"
        class="dynamic-checkbox"
        :checked="modelValue"
        @change="
        $emit('update:modelValue',($event.target as HTMLInputElement).checked)"
    >
    <label
        :for="id"
        class="toggle"
    >
      <ToggleFieldSvg/>
    </label>
  </FieldWrapper>
</template>