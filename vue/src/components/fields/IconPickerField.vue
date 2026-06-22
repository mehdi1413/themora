<script setup lang="ts">

import {
  computed,
  nextTick,
  ref
} from 'vue'

import FieldWrapper from '@/components/ui/FieldWrapper.vue'

import {RiCloseLine} from '@remixicon/vue'

import remixIcons from '@/icons/remix'
import iconRegistry from '@/data/icons'


interface IconValue {
  pack: string
  icon: string
}


const props = defineProps<{
  id:string
  label:string
  modelValue?:IconValue|null
}>()


const emit = defineEmits<{
  (
      e:'update:modelValue',
      value:IconValue|null
  ):void
}>()



/**
 * Icon packs registry
 * بعدا pack های دیگر اضافه می شوند
 */
const packs = {
  remix: remixIcons
}



const open = ref(false)

const search = ref('')




const currentPack = computed(()=>{

  return props.modelValue?.pack ?? 'remix'

})





const currentIcons = computed(()=>{


  const pack =
      packs[
          currentPack.value as keyof typeof packs
          ]


  return pack as Record<string, any>

})






const icons = computed(()=>{


  return (
      iconRegistry[
          currentPack.value as keyof typeof iconRegistry
          ]
      ?? []
  )


})






const filteredIcons = computed(()=>{


  if(!search.value.trim()){

    return icons.value

  }



  return icons.value.filter(icon=>

      icon
          .toLowerCase()
          .includes(
              search.value.toLowerCase()
          )

  )


})






const selectedIcon = computed(()=>{


  const iconName =
      props.modelValue?.icon



  if(!iconName){

    return null

  }



  return currentIcons.value[iconName] ?? null


})







function openPicker(){


  open.value=true


  nextTick(()=>{


    const input =
        document.querySelector(
            '.tm-icon-search'
        ) as HTMLInputElement|null



    input?.focus()


  })

}





function closePicker(){

  open.value=false

  search.value=''

}





function selectIcon(
    icon:string
){


  emit(
      'update:modelValue',
      {
        pack:'remix',
        icon
      }
  )


  closePicker()

}


function removeIcon(){

  emit(
      'update:modelValue',
      null
  )

}
</script>


<template>
  <FieldWrapper
      :id="id"
      :label="label"
  >

    <div class="tm-icon-picker">
      <div class="flex items-center gap-3">

        <button
            type="button"
            class="picker-trigger"
            @click="openPicker"
        >

          <component
              v-if="selectedIcon"
              :is="selectedIcon"
              size="22"
          />

          <span>
        انتخاب آیکن
      </span>

        </button>

        <button
            v-if="modelValue?.icon"
            type="button"
            class="remove-btn"
            @click="removeIcon"
        >
          حذف
        </button>

      </div>

      <Teleport to="body">

        <div
            v-if="open"
            class="picker-overlay"
            @click="closePicker"
        >

          <div
              class="picker-modal"
              @click.stop
          >

            <div class="picker-header">
              <h3>
                انتخاب آیکن
              </h3>


              <button
                  type="button"
                  @click="closePicker"
                  class="cursor-pointer"
              >
                <RiCloseLine />
              </button>

            </div>

            <input
                v-model="search"
                class="tm-icon-search"
                placeholder="جستجوی آیکن..."
            />

            <div class="icon-grid">

              <button
                  v-for="icon in filteredIcons"
                  :key="icon"
                  type="button"
                  class="icon-item"
                  :class="{active:modelValue?.icon === icon}"
                  @click="selectIcon(icon)"
              >

                <component
                    :is="currentIcons[icon]"
                    size="24"
                />

              </button>



            </div>




          </div>


        </div>


      </Teleport>



    </div>


  </FieldWrapper>


</template>

<style scoped>
.picker-trigger{
  display:flex;
  align-items:center;
  gap:8px;
  border:1px solid #ddd;
  background:#fff;
  padding:10px 14px;
  border-radius:10px;
  cursor:pointer;
}

.remove-btn{
  background:#fee2e2;
  color:#dc2626;
  border:none;
  padding:8px 12px;
  border-radius:8px;
}

.picker-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.45);
  display:flex;
  align-items:center;
  justify-content:center;
  z-index:9999;
}

.picker-modal{
  width:700px;
  max-width:90vw;
  background:white;
  border-radius:18px;
  padding:20px;
}


.picker-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
}


.tm-icon-search{
  width:100%;
  margin-top:15px;
  border:1px solid #ddd;
  padding:10px;
  border-radius:10px;
}


.icon-grid{
  margin-top:20px;
  display:grid;
  grid-template-columns:
  repeat(auto-fill, minmax(60px,1fr));
  gap:10px;
  max-height:450px;
  overflow:auto;
}


.icon-item{
  height:60px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:white;
  border:1px solid #eee;
  border-radius:12px;
  cursor: pointer;
}

.icon-item:hover{
  color:#6e00ff;
  background-color: #f3e8ff;
}

.icon-item.active{
  color:#6e00ff;
  background:#f3e8ff;
  border-color:#6e00ff;
}
</style>