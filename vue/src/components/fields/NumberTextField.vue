<script setup lang="ts">
import {computed} from 'vue'
import {RiAddLine, RiSubtractLine} from '@remixicon/vue'
import FieldWrapper from "../ui/FieldWrapper.vue";

const props = withDefaults(
    defineProps<{
      id: string
      label: string
      modelValue: number
      min?: number
      max?: number
      step?: number
    }>(),
    {
      min: 0,
      max: 999999,
      step: 1
    }
)

const emit = defineEmits<{
  (e: 'update:modelValue', value: number): void
}>()

const currentValue = computed({
  get: () => props.modelValue,
  set: (value: number) => emit('update:modelValue', value)
})

const incrementDisabled = computed(() => {
  return currentValue.value >= props.max
})

const decrementDisabled = computed(() => {
  return currentValue.value <= props.min
})

function changeValue(type: 'increment' | 'decrement') {

  let value = currentValue.value

  if (type === 'increment') {
    value += props.step
  } else {
    value -= props.step
  }

  value = Math.max(props.min, value)
  value = Math.min(props.max, value)

  currentValue.value = value
}

function handleInput(event: Event) {

  const target = event.target as HTMLInputElement

  let value = Number(target.value)

  if (isNaN(value)) {
    value = props.min
  }

  value = Math.max(props.min, value)
  value = Math.min(props.max, value)

  currentValue.value = value
}

function handleBlur() {

  let value = currentValue.value

  value = Math.max(props.min, value)
  value = Math.min(props.max, value)

  currentValue.value = value
}

let holdTimeout: number | null = null
let intervalId: number | null = null

function startChanging(type: 'increment' | 'decrement') {

  changeValue(type)

  holdTimeout = window.setTimeout(() => {

    intervalId = window.setInterval(() => {
      changeValue(type)
    }, 100)

  }, 500)
}

function stopChanging() {

  if (holdTimeout !== null) {
    clearTimeout(holdTimeout)
    holdTimeout = null
  }

  if (intervalId !== null) {
    clearInterval(intervalId)
    intervalId = null
  }
}
</script>

<template>
  <FieldWrapper
      :id="id"
      :label="label"
      :isNumberField="true"
  >
    <div class="tm-number-input">
      <button
          type="button"
          class="increment"
          :disabled="incrementDisabled"
          @mousedown="startChanging('increment')"
          @mouseup="stopChanging"
          @mouseleave="stopChanging"
          @touchstart.prevent="startChanging('increment')"
          @touchend="stopChanging"
      >
        <RiAddLine size="18px" color="#FFFFFF"/>
      </button>
      <input
          :id="id"
          type="number"
          class="no-spinner"
          :value="currentValue"
          :min="min"
          :max="max"
          :step="step"
          @input="handleInput"
          @blur="handleBlur"
      >
      <button
          type="button"
          class="decrement"
          :disabled="decrementDisabled"
          @mousedown="startChanging('decrement')"
          @mouseup="stopChanging"
          @mouseleave="stopChanging"
          @touchstart.prevent="startChanging('decrement')"
          @touchend="stopChanging"
      >
        <RiSubtractLine size="18px" color="#FFFFFF"/>
      </button>
    </div>

  </FieldWrapper>
</template>

<style scoped>

.tm-number-input {
  display: flex;
  align-items: center;
  overflow: hidden;

  border: 1px solid #cbd5e0;
  border-radius: 8px;

  width: fit-content;
}

.tm-number-input:focus-within {
  border-color: #11b76b;
}

.tm-number-input input {
  width: 80px;
  height: 40px;

  border: none;
  outline: none;

  text-align: center;
  font-size: 15px;
}

.tm-number-input button {
  width: 40px;
  height: 40px;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #1a202c;
  transition: .2s;
}

.tm-number-input button:hover:not(:disabled) {
  background: #11b76b;
}

.tm-number-input button:disabled {
  opacity: .4;
  cursor: not-allowed;
}

</style>