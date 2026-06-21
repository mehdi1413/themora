<script setup lang="ts">

import FieldWrapper from '../ui/FieldWrapper.vue'
import MediaUploader from './MediaUploader.vue'

import {RiAddLine, RiDeleteBin6Fill} from '@remixicon/vue'

interface FontFile {
  id: number | null
  file: number | null
  size: number
  format: string
  weight: string
  display: string
}


interface FontFamily {
  family: string
  fonts: FontFile[]
}

const props = defineProps<{
  id: string
  label: string
  modelValue?: FontFamily[]
}>()

const emit = defineEmits<{
  (
      e: 'update:modelValue',
      value: FontFamily[]
  ): void
}>()

const formats = [
  'woff2',
  'woff',
  'ttf',
  'eot'
]

const weights = [
  '100',
  '200',
  '300',
  '400',
  '500',
  '600',
  '700',
  '800',
  '900'
]

const displays = [
  'swap',
  'block',
  'fallback',
  'optional'
]

const data = () => props.modelValue ?? []

function createFont(): FontFile {
  return {
    id: null,
    file: null,
    size: 16,
    format: 'woff2',
    weight: '400',
    display: 'swap'
  }
}

function addFamily() {
  emit(
      'update:modelValue',
      [
        ...data(),
        {
          family: '',
          fonts: [
            createFont()
          ]
        }
      ]
  )
}

function updateFamily(index: number, value: string) {
  const clone = structuredClone(data())
  clone[index].family = value
  emit('update:modelValue', clone)
}

function addFont(index: number) {
  const clone = structuredClone(data())
  clone[index].fonts.push(createFont())

  emit('update:modelValue', clone)
}

function removeFamily(index: number) {
  emit(
      'update:modelValue',
      data().filter(
          (_, i) => i !== index
      )
  )
}

function removeFont(family: number, font: number) {
  const clone = structuredClone(data())
  clone[family].fonts.splice(font, 1)

  emit('update:modelValue', clone)
}
</script>

<template>
  <FieldWrapper
      :id="id"
      :label="label"
  >
    <div class="font-wrapper">
      <button
          type="button"
          class="add-btn"
          @click="addFamily"
      >
        <RiAddLine/>
        افزودن خانواده فونت
      </button>

      <div
          v-for="(family,index) in data()"
          :key="index"
          class="family"
      >

        <div class="family-header">
          <input
              class="input"
              placeholder="نام فونت"
              :value="family.family"
              @input="updateFamily( index,($event.target as HTMLInputElement).value)"
          />

          <button
              type="button"
              class="flex items-center justify-center delete"
              @click="removeFamily(index)"
          >
            <RiDeleteBin6Fill/>
          </button>
        </div>

        <div
            v-for="(font,fontIndex) in family.fonts"
            :key="fontIndex"
            class="font-item"
        >
          <MediaUploader
              inline
              :id="`font-${index}-${fontIndex}`"
              label=""
              :file-type="'font'"
              :model-value="font.file"
              @update:model-value="font.file=$event"
          />

          <div
              class="
              grid
              grid-cols-1
              md:grid-cols-2
              xl:grid-cols-4
              gap-3
              mt-3"
          >

            <input
                type="number"
                v-model="font.size"
            />

            <select v-model="font.weight">
              <option
                  v-for="item in weights"
                  :value="item"
              >
                {{ item }}
              </option>
            </select>

            <select v-model="font.format">
              <option
                  v-for="item in formats"
                  :value="item"
              >
                {{ item }}
              </option>
            </select>

            <select v-model="font.display">
              <option
                  v-for="item in displays"
                  :value="item"
              >
                {{ item }}
              </option>
            </select>

          </div>

          <button
              class="remove-font"
              type="button"
              @click="removeFont(index,fontIndex)"
          >
            حذف وزن
          </button>

        </div>

        <button
            class="add-font"
            type="button"
            @click="addFont(index)"
        >
          + افزودن وزن
        </button>

      </div>

    </div>

  </FieldWrapper>

</template>

<style scoped>
.font-wrapper {
  width: 100%;
}

.add-btn {
  display: flex;
  align-items: center;
  gap: 6px;
  background: #6e00ff;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 8px;
  cursor: pointer;
  margin-bottom: 15px;
}


.family {
  width: 100%;
  border: 1px solid #e5e5e5;
  border-radius: 10px;
  padding: 15px;
  background: #fafafa;
}


.family-header {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
}


.input {
  flex: 1;
  border: 1px solid #ddd;
  padding: 10px;
  border-radius: 8px;
}

.delete {
  width: 40px;
  border: none;
  border-radius: 8px;
  background: #fee2e2;
  color: #dc2626;
}

.font-item {
  background: white;
  border: 1px dashed #ddd;
  border-radius: 10px;
  padding: 12px;
  margin-top: 12px;
}


.options input, .options select {
  height: 38px;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 0 8px;
}

.add-font {
  margin-top: 12px;
  border: none;
  background: #eee;
  padding: 8px 12px;
  border-radius: 8px;
  cursor: pointer;
}

.remove-font {
  margin-top: 10px;
  border: none;
  background: #fee2e2;
  color: #dc2626;
  padding: 7px 12px;
  border-radius: 8px;
}
</style>