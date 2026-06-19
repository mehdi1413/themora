<script setup lang="ts">

import {ref, computed, watch, onMounted, onBeforeUnmount} from 'vue'
import {ColorPicker} from 'vue-color-kit'
import 'vue-color-kit/dist/vue-color-kit.css'

import FieldWrapper from '../ui/FieldWrapper.vue'

type ColorFormat = 'hex' | 'rgba'

const props = withDefaults(
    defineProps<{
      id: string
      label: string
      modelValue: string
      format?: ColorFormat
    }>(),
    {
      format: 'hex'
    }
)


const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()


const open = ref(false)
const selectedFormat = ref<ColorFormat>(props.modelValue?.startsWith('rgba') ? 'rgba' : 'hex')
const color = ref(props.modelValue || '#ffffff')
const rgba = ref({r: 0, g: 0, b: 0, a: 1})

function saveColor() {
  emit(
      'update:modelValue',
      convertColor({
        hex: color.value,
        rgba: rgba.value
      })
  )

  open.value = false
}

watch(
    () => props.modelValue,
    value => {
      if (value) {
        color.value = value
      }
    }
)


const displayValue = computed(() => {
  return color.value
})

function convertColor(value: any) {
  const hex = value.hex

  if (selectedFormat.value === 'hex') {
    return hex.slice(0, 7).toUpperCase()
  }

  if (selectedFormat.value === 'rgba') {
    const rgb = value.rgba
    return `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, ${rgb.a})`
  }

}

function changeColor(value: any) {
  color.value = value.hex
  rgba.value = value.rgba

  emit(
      'update:modelValue',
      convertColor({
        hex: value.hex,
        rgba: value.rgba
      })
  )
}

function changeFormat(format: ColorFormat) {
  selectedFormat.value = format

  emit(
      'update:modelValue',
      convertColor({
        hex: color.value,
        rgba: rgba.value
      })
  )
}

const colorField = ref<HTMLElement | null>(null)

function handleClickOutside(event: MouseEvent) {

  if (
      colorField.value &&
      !colorField.value.contains(
          event.target as Node
      )
  ) {

    if (open.value) {
      saveColor()
    }

  }

}

onMounted(() => {
  document.addEventListener(
      'click',
      handleClickOutside
  )
})
onBeforeUnmount(() => {
  document.removeEventListener(
      'click',
      handleClickOutside
  )
})
</script>

<template>
  <FieldWrapper
      :id="id"
      :label="label"
  >
    <div
        ref="colorField"
        class="tm-color-field"
    >
      <input
          class="tm-color-input"
          :value="displayValue"
          readonly
      />
      <button
          class="tm-color-button"
          type="button"
          @click.stop="open=!open"
      >
        <span
            class="tm-color-preview"
            :style="{background:color}"
        />
      </button>

      <div
          v-if="open"
          class="tm-color-popup"
          @click.stop
      >
        <ColorPicker
            :color="color"
            theme="light"
            :sucker-hide="true"
            @changeColor="changeColor"
        />

        <div class="tm-color-formats">
          <button
              v-for="item in ['hex','rgba']"
              :key="item"
              type="button"
              :class="{active:selectedFormat===item}"
              @click="changeFormat(item as ColorFormat)"
          >{{ item.toUpperCase() }}
          </button>

        </div>

      </div>

    </div>

  </FieldWrapper>
</template>

<style scoped>
.tm-color-field {
  position: relative;
  display: flex;
  align-items: center;
  gap: 10px;
}

.tm-color-input {
  width: 150px;
  height: 40px;
  border: 1px solid #cbd5e0;
  border-radius: 8px;
  padding: 0 12px;
  background: white;
  font-size: 13px;
}

.tm-color-button {
  width: 42px;
  height: 42px;
  border-radius: 8px;
  background: white;
  border: 1px solid #ddd;
  padding: 5px;
  cursor: pointer;
}

.tm-color-preview {
  display: block;
  width: 100%;
  height: 100%;
  border-radius: 6px;
}

.tm-color-popup {
  position: absolute;
  top: 48px;
  right: 0;
  z-index: 99999;
  background: white;
  padding: 12px;
  border-radius: 14px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
}

.tm-color-formats {
  display: flex;
  gap: 6px;
  margin-top: 12px;
}

.tm-color-formats button {
  border: 1px solid #ddd;
  background: white;
  padding: 5px 8px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 11px;
}

.tm-color-formats button.active {
  background: #1a202c;
  color: white;
}
</style>