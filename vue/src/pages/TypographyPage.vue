<script setup lang="ts">
import typographyFields from '@/schemas/typography'
import FieldRenderer from '@/components/fields/FieldRenderer.vue'

type TypographySection = 'size' | 'fonts'

const props = defineProps<{
  settings: Record<string, any>
  section: TypographySection
}>()

function updateField(key:string,value:any){
  props.settings.typography[props.section][key] = value
}
</script>

<template>
  <h3 class="mb-4">سایز فونت ها</h3>

  <FieldRenderer
      v-for="field in typographyFields[section]"
      :key="field.key"
      :field="field"
      :model-value="settings.typography[section][field.key]"
      @update:model-value="updateField(field.key,$event)"
  />
</template>