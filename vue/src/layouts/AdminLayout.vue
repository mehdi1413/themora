<script setup lang="ts">
import {ref, reactive, computed} from 'vue'
import type { Component } from 'vue'

import FooterContent from './content/Footer.vue'
import HeaderContent from './content/Header.vue'

import BrandLayout from '../components/layouts/BrandLayout.vue'

import {
  RiArrowRightDoubleLine,
  RiArrowLeftSLine,
  RiCheckboxBlankCircleFill,

} from '@remixicon/vue'

import GeneralPage from '../pages/GeneralPage.vue'
import ArchivePage from '../pages/ArchivePage.vue'


interface MenuItem {

  title:string
  icon:string

  link?:string

  page?:Component

  settings?:any

  children?:MenuItem[]

}


// ---------------- SETTINGS ----------------
const settings = reactive({

  general:{

    title:'',
    selectOne:'DESC'

  },


  archive:{

    removePrefix:false,
    perPage:12

  },


  colors:{

    primaryColor:'#c52f32',
    secondaryColor:'#e89d26',
    darkColor:'#222222',
    whiteColor:'#FFFFFF',
    greyColor:'#555555',
    greenColor:'#118E62',
    blueColor:'#1B619A'

  }

})



// ---------------- MENU ----------------
const menus = ref<MenuItem[]>([


  {
    title:'عمومی',
    icon:'⚙️',

    page:GeneralPage,

    settings:settings.general

  },


  {
    title:'آرشیو',
    icon:'🗂️',

    page:ArchivePage,

    settings:settings.archive

  },


  {
    title:'محصولات',
    icon:'📦',

    children:[


      {

        title:'تنظیمات محصول',
        icon:'⚙️',

        children:[

          {

            title:'ظاهر محصول',
            icon:'🎨',
            link:'#'

          },


          {

            title:'تب ها',
            icon:'📑',
            link:'#'

          }

        ]

      },


      {

        title:'انبار',
        icon:'📦',
        link:'#'

      }

    ]

  }


])




// ---------------- ACTIVE ----------------
const activeMenu = ref<MenuItem | null>(null)

const activeKey = ref('')


// default page

activeMenu.value = menus.value[0]
activeKey.value = '0'

const currentPage = computed(()=>{

  return activeMenu.value?.page ?? GeneralPage

})




// ---------------- SIDEBAR ----------------
const sidebarOpen = ref(false)

const collapsed = ref(false)


const openedMenus = ref<Record<number,string>>({})


// ---------------- TOGGLE SUBMENU ----------------
const toggleSubmenu = (key:string, level:number)=>{
  if(collapsed.value) return

  if(openedMenus.value[level] === key){
    delete openedMenus.value[level]

    Object.keys(openedMenus.value)
        .forEach(item=>{
          if(Number(item)>level){
            delete openedMenus.value[
                Number(item)
                ]
          }
        })

    return
  }

  openedMenus.value[level]=key

  Object.keys(openedMenus.value).forEach(item=>{
        if(Number(item)>level){
          delete openedMenus.value[
              Number(item)
              ]
        }
      })
}

const isOpen = (key:string, level:number)=>{
  return openedMenus.value[level] === key
}


// ---------------- ACTIVE MENU ----------------
const setActiveItem = (item:MenuItem, key:string)=>{
  activeMenu.value=item
  activeKey.value=key
}


const hasActiveChild = (key:string)=>{
  return activeKey.value.startsWith(
      key+'-'
  )
}

// ---------------- Toggle sidebar ----------------
const toggleSidebar = ()=>{
  collapsed.value=!collapsed.value

  if(collapsed.value){
    openedMenus.value={}
  }
}

//
// ---------------- Open Sidebar From Header Btn ----------------
const openSidebar = ()=>{
  sidebarOpen.value=true
}

const closeSidebar = ()=>{
  sidebarOpen.value=false
}

// ---------------- DARK MODE ----------------
const isDark = ref(false)
const toggleTheme = ()=>{
  isDark.value = !isDark.value
  document.documentElement
      .classList
      .toggle(
          'dark',
          isDark.value
      )
}

</script>

<template>
  <div class="flex h-screen py-tm-60 gap-4 select-none">
    <!-- overlay -->
    <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        @click="closeSidebar"
    />
    <!-- SIDEBAR -->
    <aside
        class="themora-menu bg-tm-primary fixed lg:relative right-0 top-0 z-40 h-full p-tm-5 rounded-tm-12 shadow transition-all duration-300"
        :class="[collapsed? 'w-20 sidebar-collapse': 'w-72 sidebar-open', sidebarOpen ? 'translate-x-0': 'translate-x-full lg:translate-x-0']"
    >
      <button
          @click="toggleSidebar"
          class="absolute -left-3 top-3 bg-white rounded-full p-1 shadow cursor-pointer"
      >
        <RiArrowRightDoubleLine
            class="w-5 h-5 transition-transform duration-300 ease-in-out" :class="{'rotate-180': collapsed}"
            size="20px"
        />
      </button>

      <nav>
        <BrandLayout :collapsed="collapsed"/>

        <ul class="themora-tabs space-y-1">
          <li
              v-for="(item,index) in menus"
              :key="index"
              class="relative"
          >
            <div
                class="
                themora-tab-list-item
                flex
                items-center
                justify-between
                text-white
                p-tm-10
                rounded-lg
                cursor-pointer
                transition-all
                duration-300 hover:text-tm-dark"
                :class="{
 active: activeKey === `${index}` || hasActiveChild(`${index}`)
}"

                @click="
 setActiveItem(item,`${index}`);
 item.children && toggleSubmenu(`${index}`,0)
"
            >

              <div class="flex items-center gap-3">
                <span>{{ item.icon }}</span>
                <span class="text-tm-13" v-show="!collapsed">{{ item.title }}</span>
              </div>
              <RiArrowLeftSLine
                  class="transition-transform duration-300 ease-in-out"
                  size="20px"
                  v-if="item.children && !collapsed"
                  :class="{'-rotate-90':isOpen(`${index}`,0)}"
              />
            </div>

            <Transition name="submenu">

              <div
                  class="tm-submenu-wrapper"
                  :class="{open:isOpen(`${index}`,0)}"
              >

                <ul v-if="item.children" class="themora-submenu">
                  <li
                      v-for="(child,cIndex) in item.children"
                      :key="cIndex"
                  >

                    <div
                        class="
                        group
                        text-white
                        px-4
                        py-3
                        cursor-pointer
                        flex
                        justify-between
                        items-center transition-all hover:text-tm-secondary"
                        :class="{
active:
activeKey === `${index}-${cIndex}`
||
hasActiveChild(`${index}-${cIndex}`)
}"

                        @click.stop="
setActiveItem(child,`${index}-${cIndex}`);
child.children && toggleSubmenu(`${index}-${cIndex}`,1)
"
                    >
                      <div class="tm-submenu-item-text-wrap flex items-center gap-2">
                        <RiCheckboxBlankCircleFill size="6px"/>
                        <span class="tm-submenu-list-text text-tm-13 mr-tm-10">{{ child.title }}</span>
                      </div>
                      <RiArrowLeftSLine
                          v-if="child.children"
                          class="transition-transform duration-300 ease-in-out"
                          :class="{'-rotate-90':isOpen(`${index}-${cIndex}`,1)}"
                          size="20px"
                      />
                    </div>
                    <Transition name="submenu">
                      <div class="tm-submenu-wrapper" :class="{open:isOpen(`${index}-${cIndex}`,1)}">
                        <ul v-if="child.children" class="pl-6">
                          <li v-for="(sub,sIndex) in child.children"
                              :key="sIndex"
                              class="pr-tm-10 cursor-pointer"
                              :class="{
active:activeKey ===`${index}-${cIndex}-${sIndex}`
}"
                              @click.stop="
setActiveItem(sub,`${index}-${cIndex}-${sIndex}`)
"
                          >
                            <div
                                class="group text-white px-4 py-3 cursor-pointer flex gap-4 items-center transition-all hover:text-tm-secondary">
                              <RiCheckboxBlankCircleFill size="6px"/>
                              <span class="text-tm-13">{{ sub.title }}</span>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </Transition>
                  </li>
                </ul>
              </div>
            </Transition>
          </li>
        </ul>
      </nav>
    </aside>


    <section class="flex-1 flex flex-col bg-white p-tm-30 rounded-tm-12">
      <form>
        <HeaderContent
            :sidebarOpen="sidebarOpen"
            :isDark="isDark"
            @openSidebar="openSidebar"
            @toggleTheme="toggleTheme"
        />
        <main class="tm-tab-content py-6">
          <h2 class="text-xl text-white">تنظیمات عمومی</h2>
          <component
              :is="currentPage"
              :settings="activeMenu?.settings"
          />
        </main>
        <FooterContent />
      </form>
    </section>
  </div>
</template>