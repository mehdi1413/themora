<script setup lang="ts">
import archiveFields from '../schemas/archive.ts'
import FieldRenderer from '../components/fields/FieldRenderer.vue'

const props = defineProps<{
  settings: Record<string, any>
}>()

function updateField(key: string, value: any) {
  props.settings.archive[key] = value
}
</script>

<template>
  <FieldRenderer
      v-for="field in archiveFields"
      :key="field.key"
      :field="field"
      :model-value="settings.archive[field.key]"
      @update:model-value="
        updateField(
          field.key,
          $event
        )
      "
  />
</template>