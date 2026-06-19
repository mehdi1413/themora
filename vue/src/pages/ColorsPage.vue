<script setup lang="ts">
import FieldRenderer from '@/components/fields/FieldRenderer.vue'
import colorFields from '@/schemas/colors'

type ColorSection = 'primary' | 'secondary'

const props = defineProps<{
  settings: Record<string, any>
  section: ColorSection
}>()

function updateField(key: string, value: any) {
  props.settings.colors[props.section][key] = value
}
</script>

<template>
  <FieldRenderer
      v-for="field in colorFields[section]"
      :key="field.key"
      :field="field"
      :model-value="settings.colors[section][field.key]"
      @update:model-value="updateField(field.key,$event)"
  />
</template>