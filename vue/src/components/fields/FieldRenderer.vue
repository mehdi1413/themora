<script setup lang="ts">
import TextField from './TextField.vue'
import ToggleField from './ToggleField.vue'
import NumberTextField from './NumberTextField.vue'
import SimpleSelectField from './SimpleSelectField.vue'
import ColorPickerField from './ColorPickerField.vue';
import MediaUploader from "@/components/fields/MediaUploader.vue";

const props = defineProps<{
  field:any
  modelValue:any
}>()

const emit = defineEmits([
  'update:modelValue'
])
</script>

<template>

  <TextField
      v-if="field.type === 'text'"
      :id="field.id"
      :label="field.label"
      :model-value="modelValue"
      @update:model-value="$emit('update:modelValue',$event)"
  />

  <ToggleField
      v-else-if="field.type === 'toggle'"
      :id="field.id"
      :label="field.label"
      :model-value="modelValue"
      @update:model-value="$emit('update:modelValue',$event)"
  />

  <NumberTextField
      v-else-if="field.type === 'number'"
      :id="field.id"
      :label="field.label"
      :model-value="modelValue"
      :min="field.props?.min"
      :max="field.props?.max"
      :step="field.props?.step"
      @update:model-value="$emit('update:modelValue',$event)"
  />

  <SimpleSelectField
      v-else-if="field.type === 'select'"
      :id="field.id"
      :label="field.label"
      :options="field.props?.options"
      :model-value="modelValue"
      @update:model-value="$emit('update:modelValue',$event)"
  />

  <ColorPickerField
      v-else-if="field.type === 'color'"
      :id="field.id"
      :label="field.label"
      :model-value="modelValue"
      @update:model-value="$emit('update:modelValue',$event)"
  />

  <MediaUploader
      v-else-if="field.type === 'media'"
      :id="field.id"
      :label="field.label"
      :model-value="modelValue"
      :file-type="field.fileType"
      @update:model-value="$emit('update:modelValue',$event)"
  />

</template>

<style scoped>

</style>