<script setup lang="ts">
import accountFields from '@/schemas/account.ts'
import FieldRenderer from '@/components/fields/FieldRenderer.vue'

const props = defineProps<{
  settings: Record<string, any>
}>()


function updateField(
    key:string,
    value:any
){
  props.settings.account[key] = value
}

</script>


<template>

  <FieldRenderer

      v-for="field in accountFields"

      :key="field.key"

      :field="field"

      :model-value="settings.account[field.key]"

      @update:model-value="
        updateField(
          field.key,
          $event
        )
      "

  />

</template>