<script setup lang="ts">
import {computed, ref} from 'vue'
import FieldWrapper from '../ui/FieldWrapper.vue'

const props = defineProps<{
  id: string
  label: string
  modelValue: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const menuOpen = ref(false)

const color = computed({
  get: () => props.modelValue,
  set: value => emit('update:modelValue', value)
})

const swatchStyle = computed(() => ({
  backgroundColor: color.value,
  borderRadius: menuOpen.value ? '50%' : '6px'
}))
</script>

<template>
  <FieldWrapper
      :id="id"
      :label="label"
  >

    <div class="tm-color-field">

      <input
          :id="id"
          v-model="color"
          type="text"
          class="tm-color-input"
      >

      <div
          class="tm-color-swatch"
          :style="swatchStyle"
          @click="menuOpen = !menuOpen"
      />

      <div
          v-if="menuOpen"
          class="tm-color-popover"
      >
        <input
            v-model="color"
            type="color"
            class="tm-native-color-picker"
        >
      </div>

    </div>

  </FieldWrapper>
</template>

<style scoped>

.tm-color-field {
  position: relative;
  display: flex;
  align-items: center;
  gap: 12px;
}

.tm-color-input {
  width: 180px;
  height: 40px;
  padding: 0 12px;

  border: 1px solid #d1d5db;
  border-radius: 8px;
}

.tm-color-swatch {
  width: 32px;
  height: 32px;

  cursor: pointer;

  transition: .2s;
}

.tm-color-popover {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;

  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 12px;

  padding: 12px;

  box-shadow: 0 8px 20px rgba(0, 0, 0, .1);

  z-index: 100;
}

.tm-native-color-picker {
  width: 220px;
  height: 180px;
  border: none;
  padding: 0;
}

</style>