<script setup lang="ts">
import {
  computed,
  ref,
  onMounted,
  onBeforeUnmount
} from 'vue'

import FieldWrapper from '../ui/FieldWrapper.vue'
import {
  RiArrowDropDownLine,
  RiCloseLine
} from '@remixicon/vue'


interface Option {
  label: string
  value: string
}


const props = defineProps<{
  id: string
  label: string
  modelValue?: string[]
  options: Option[]

  searchable?: boolean
}>()


const emit = defineEmits<{
  (e: 'update:modelValue', value: string[]): void
}>()


const open = ref(false)
const search = ref('')
const wrapper = ref<HTMLElement | null>(null)

const selectedItems = computed(() => {
  const values = props.modelValue ?? []

  return props.options.filter(option =>
      values.includes(option.value)
  )

})


const filteredOptions = computed(() => {
  if (!search.value.trim()) {
    return props.options
  }

  const query = search.value.toLowerCase()

  return props.options.filter(option =>
      option.label.toLowerCase().includes(query)
  )
})


function addItem(value: string) {
  const current = props.modelValue ?? []

  if (current.includes(value)) {
    return
  }

  emit('update:modelValue', [...current, value])

  closeDropdown()
}


function removeItem(value: string) {
  const current = props.modelValue ?? []
  const result = current.filter(item => item !== value)

  emit('update:modelValue', result)
}


function isSelected(value: string) {
  return (props.modelValue ?? []).includes(value)
}


function toggleDropdown() {
  open.value = !open.value

  if (!open.value) {
    search.value = ''
  }
}


function closeDropdown() {
  open.value = false
  search.value = ''
}


function handleClickOutside(event: MouseEvent) {
  if (wrapper.value && !wrapper.value.contains(event.target as Node)) {
    closeDropdown()
  }
}


onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})


onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})

</script>


<template>


  <FieldWrapper
      :id="id"
      :label="label"
  >


    <div
        ref="wrapper"
        class="tm-multiselect"
    >


      <!-- control -->

      <div
          class="tm-control"
          @click.stop="toggleDropdown"
      >


        <div class="tm-selected">


<span
    v-for="item in selectedItems"
    :key="item.value"
    class="tm-tag"
>


{{ item.label }}


<button
    type="button"
    @click.stop="removeItem(item.value)"
>


<RiCloseLine size="14px"/>


</button>


</span>


          <span
              v-if="!selectedItems.length"
              class="tm-placeholder"
          >

انتخاب کنید...

</span>


        </div>


        <span
            class="tm-arrow"
            :class="{open}"
        >


<RiArrowDropDownLine/>


</span>


      </div>


      <Transition name="dropdown">


        <div
            v-if="open"
            class="tm-dropdown"
            @click.stop
        >


          <!-- search -->

          <div
              v-if="searchable"
              class="tm-search-wrapper"
          >
            <input
                v-model="search"
                type="text"
                class="tm-search"
                placeholder="جستجو..."
                @click.stop
            />
          </div>

          <div
              v-for="option in filteredOptions"
              :key="option.value"
              class="tm-option"
              :class="{selected:isSelected(option.value)}"
              @click="addItem(option.value)"
          >

            {{ option.label }}
          </div>

          <div
              v-if="!filteredOptions.length"
              class="tm-empty"
          >
            موردی پیدا نشد
          </div>
        </div>
      </Transition>

    </div>

  </FieldWrapper>


</template>


<style scoped>


.tm-multiselect {
  position: relative;
}


.tm-control {

  min-height: 48px;

  display: flex;
  align-items: center;
  justify-content: space-between;

  gap: 10px;

  padding: 10px 14px;

  border: 1px solid #dcdcdc;

  border-radius: 6px;

  background: #fff;

  cursor: pointer;

  transition: .2s;

}


.tm-control:hover {
  border-color: #6e00ff;
}


.tm-selected {

  flex: 1;

  display: flex;

  flex-wrap: wrap;

  gap: 8px;

}


.tm-tag {
  color: #6e00ff;
  background: #ad58ff15;
  border-radius: 4px;
  align-items: center;
  gap: 8px;
  padding: 6px 12px;
  font-size: 13px;
  display: flex;
}


.tm-tag button {

  border: none;

  background: none;

  cursor: pointer;

  color: inherit;

  padding: 0;

}


.tm-placeholder {

  color: #999;

  font-size: 13px;

}


.tm-arrow {

  transition: .2s;

  font-size: 12px;

}


.tm-arrow.open {

  transform: rotate(180deg);

}


.tm-dropdown {

  position: absolute;

  top: calc(100% + 8px);

  left: 0;

  right: 0;

  z-index: 1000;

  max-height: 300px;

  overflow-y: auto;

  background: #fff;

  border: 1px solid #ddd;

  border-radius: 12px;

  box-shadow: 0 12px 40px rgba(0, 0, 0, .08);

}


.tm-search-wrapper {

  padding: 10px;

  border-bottom: 1px solid #eee;

}


.tm-search {

  width: 100%;

  height: 36px;

  padding: 0 12px;

  border: 1px solid #ddd;

  border-radius: 8px;

  outline: none;

  font-size: 13px;

}


.tm-search:focus {

  border-color: #6e00ff;

}


.tm-option {

  padding: 12px 14px;

  cursor: pointer;

  transition: .15s;

}


.tm-option:hover {

  background: #f6f2ff;

}


.tm-option.selected {

  background: #f1e8ff;

  color: #6e00ff;

  pointer-events: none;

}


.tm-empty {

  padding: 20px;

  text-align: center;

  color: #999;

  font-size: 13px;

}


.dropdown-enter-active,
.dropdown-leave-active {

  transition: .18s ease;

}


.dropdown-enter-from,
.dropdown-leave-to {

  opacity: 0;

  transform: translateY(-6px);

}


</style>