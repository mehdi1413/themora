<script setup lang="ts">
import FieldWrapper from "../ui/FieldWrapper.vue";

defineProps<{
  id:string
  label:string
  modelValue: string

  options?: {
    label:string
    value:string
  }[]
}>()

const emit = defineEmits<{
  (e:'update:modelValue', value:string):void
}>()

function handleChange(event:Event){
  const target = event.target as HTMLSelectElement

  emit('update:modelValue', target.value)
}
</script>

<template>
  <FieldWrapper :id="id" :label="label">
    <select :id="id" :value="modelValue" @change="handleChange">
      <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label }}</option>
    </select>
  </FieldWrapper>
</template>

<style scoped>

</style>