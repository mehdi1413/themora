<script setup lang="ts">
import generalFields from '../schemas/general.ts'
import FieldRenderer from '../components/fields/FieldRenderer.vue'

const props = defineProps<{
  settings: Record<string, any>
}>()

function updateField(key:string, value:any){
  props.settings[key] = value
}
</script>

<template>
  <FieldRenderer
      v-for="field in generalFields"
      :key="field.key"
      :field="field"
      :model-value="settings[field.key]"
      @update:model-value="
        updateField(
          field.key,
          $event
        )
      "
  />
</template>