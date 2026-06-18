<script setup lang="ts">
import generalFields from '@/schemas/general.ts'
import FieldRenderer from '@/components/fields/FieldRenderer.vue'

const props = defineProps<{
  settings: Record<string, any>
}>()

// function updateFieldOld(key:string, value:any){
//   props.settings[key] = value
// }
function updateField(key: string, value: any) {
  props.settings.general[key] = value
}
</script>

<template>
  <FieldRenderer
      v-for="field in generalFields"
      :key="field.key"
      :field="field"
      :model-value="settings.general[field.key]"
      @update:model-value="
        updateField(
          field.key,
          $event
        )
      "
  />
</template>