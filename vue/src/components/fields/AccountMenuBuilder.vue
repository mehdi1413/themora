<script setup lang="ts">

import {
  ref,
  watch
} from 'vue'

import draggable from 'vuedraggable'
import {RiDragMove2Fill} from '@remixicon/vue'
import IconPicker from '@/components/fields/IconPickerField.vue'
import ToggleField from '@/components/fields/ToggleField.vue'


interface MenuIcon {

  pack:string
  icon:string

}


interface MenuItem {

  key:string
  label:string

  enabled:boolean

  showIcon:boolean

  icon:MenuIcon|null

}



const props = defineProps<{

  modelValue?:MenuItem[]

}>()



const emit = defineEmits<{

  (
      e:'update:modelValue',
      value:MenuItem[]
  ):void

}>()



const defaultMenus:MenuItem[] = [

  {
    key:'dashboard',
    label:'داشبورد',
    enabled:true,
    showIcon:true,
    icon:null
  },

  {
    key:'orders',
    label:'سفارشات',
    enabled:true,
    showIcon:true,
    icon:null
  },

  {
    key:'downloads',
    label:'دانلودها',
    enabled:true,
    showIcon:true,
    icon:null
  },

  {
    key:'edit-account',
    label:'اطلاعات حساب',
    enabled:true,
    showIcon:true,
    icon:null
  },

  {
    key:'customer-logout',
    label:'خروج',
    enabled:true,
    showIcon:true,
    icon:null
  }

]



const menus = ref<MenuItem[]>(

    props.modelValue?.length
        ? structuredClone(props.modelValue)
        : structuredClone(defaultMenus)

)



watch(
    () => props.modelValue,
    value => {

      if(value){

        menus.value =
            structuredClone(value)

      }

    },
    {
      deep:true
    }

)



function updateValue(){

  emit(
      'update:modelValue',
      menus.value
  )

}



function onDragEnd(){

  updateValue()

}


</script>



<template>

  <div class="account-menu-builder">


    <draggable

        v-model="menus"

        item-key="key"

        handle=".drag-handle"

        @end="onDragEnd"

        class="space-y-4"

    >


      <template #item="{element}">

        <div
            class="
      bg-white
      border
      border-gray-200
      rounded-xl
      p-4
      transition-all
      hover:border-tm-primary
      hover:shadow-sm
      "
        >

          <!-- header -->

          <div
              class="
        flex
        flex-col
        lg:flex-row
        gap-4
        lg:items-center
        "
          >

            <div
                class="
          flex
          items-center
          gap-3
          flex-1
          "
            >

              <button
                  type="button"
                  class="
            drag-handle
            shrink-0
            w-10
            h-10
            rounded-lg
            border
            border-gray-200
            flex
            items-center
            justify-center
            text-gray-500
            hover:bg-gray-50
            "
              >
                <RiDragMove2Fill />
              </button>

              <input
                  v-model="element.label"
                  class="
            w-full
            rounded-lg
            border
            border-gray-300
            px-3
            py-2
            "
                  @change="updateValue"
              />

            </div>

            <ToggleField
                inline
                :id="`menu-${element.key}-enabled`"
                label="فعال"
                v-model="element.enabled"
                @update:model-value="updateValue"
            />

          </div>


          <!-- options -->

          <div
              class="
        mt-5
        flex
        flex-col
        lg:flex-row
        lg:items-center
        gap-4
        "
          >

            <div class="flex-1">

              <IconPicker
                  inline
                  :id="`menu-icon-${element.key}`"
                  label="آیکن"
                  v-model="element.icon"
                  @update:model-value="updateValue"
              />

            </div>

            <ToggleField
                inline
                :id="`menu-${element.key}-show-icon`"
                label="نمایش آیکن"
                v-model="element.showIcon"
                @update:model-value="updateValue"
            />

          </div>

        </div>

      </template>


    </draggable>


  </div>

</template>



<style scoped>

.drag-handle{
  cursor:grab;
}

.drag-handle:active{
  cursor:grabbing;
}

</style>