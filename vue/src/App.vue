<script setup lang="ts">

import {ref} from 'vue'
import BrandLayout from './components/layouts/BrandLayout.vue'

import {
  RiArrowRightDoubleLine,
  RiArrowLeftSLine,
  RiCheckboxBlankCircleFill,
  RiMoonFill,
  RiSunFill,
  RiMenuLine
} from '@remixicon/vue'

interface MenuItem {
  title: string
  icon: string
  link?: string
  children?: MenuItem[]
}


const sidebarOpen = ref(false)
const collapsed = ref(false)
const isDark = ref(false)

const activeItem = ref('')

const openedMenus = ref<Record<number, string>>({})


const menus = ref<MenuItem[]>([

  {
    title: 'عمومی',
    icon: '⚙️',
    link: '#'
  },

  {
    title: 'محصولات',
    icon: '📦',
    children: [

      {
        title: 'تنظیمات محصول',
        icon: '⚙️',

        children: [

          {
            title: 'ظاهر محصول',
            icon: '🎨',
            link: '#'
          },

          {
            title: 'تب ها',
            icon: '📑',
            link: '#'
          }

        ]
      },


      {
        title: 'انبار',
        icon: '📦',
        link: '#'
      }

    ]
  },


  {
    title: 'پرداخت',
    icon: '💳',

    children: [

      {
        title: 'زرین پال',
        icon: '💰',
        link: '#'
      },

      {
        title: 'ملت',
        icon: '💳',
        link: '#'
      }

    ]

  },


  {
    title: 'حمل و نقل',
    icon: '🚚',
    link: '#'
  }


])


const toggleSubmenu = (
    key: string,
    level: number
) => {


  if (collapsed.value) {
    return
  }


  if (openedMenus.value[level] === key) {


    delete openedMenus.value[level]


    Object.keys(openedMenus.value)
        .forEach(item => {

          if (Number(item) > level) {

            delete openedMenus.value[
                Number(item)
                ]

          }

        })


    return

  }


  openedMenus.value[level] = key


  Object.keys(openedMenus.value)
      .forEach(item => {


        if (Number(item) > level) {

          delete openedMenus.value[
              Number(item)
              ]

        }

      })


}


const isOpen = (
    key: string,
    level: number
) => {

  return openedMenus.value[level] === key

}


const setActiveItem = (
    key: string
) => {

  activeItem.value = key

}

const hasActiveChild = (key: string) => {
  return activeItem.value.startsWith(key + '-')
}

const toggleSidebar = () => {
  collapsed.value = !collapsed.value

  if(collapsed.value){
    openedMenus.value = {}
  }
}

const openSidebar = () => {

  sidebarOpen.value = true

}


const closeSidebar = () => {

  sidebarOpen.value = false

}


const toggleTheme = () => {

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
  <div class="flex h-screen py-tm-60 gap-4 overflow-hidden">
    <!-- overlay -->
    <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        @click="closeSidebar"
    />
    <!-- SIDEBAR -->
    <aside class="themora-menu bg-tm-primary fixed lg:relative right-0 top-0 z-40 h-full p-tm-5 rounded-tm-12 shadow transition-all duration-300"
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
        <BrandLayout :collapsed="collapsed" />

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

                :class="{active:activeItem === `${index}`|| hasActiveChild(`${index}`)}"
                @click="setActiveItem(`${index}`);item.children &&toggleSubmenu(`${index}`,0)"
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
                        :class="{ active:activeItem === `${index}-${cIndex}`|| hasActiveChild(`${index}-${cIndex}`)}"
                        @click.stop="setActiveItem(`${index}-${cIndex}`);
                        child.children && toggleSubmenu(`${index}-${cIndex}`,1)"
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
                              :class="{active:activeItem ===`${index}-${cIndex}-${sIndex}`}"
                              @click.stop="setActiveItem(`${index}-${cIndex}-${sIndex}`)"
                          >
                            <div class="group text-white px-4 py-3 cursor-pointer flex gap-4 items-center transition-all hover:text-tm-secondary">
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

    <section class="flex-1 flex flex-col overflow-hidden bg-white p-tm-30 rounded-tm-12">
      <header class="border-b border-dashed border-tm-light-grey py-4 flex justify-between">
        <button
            @click="openSidebar"
            class="lg:hidden"
        >
          <RiMenuLine size="24px"/>
        </button>

        <h2 class="text-2xl">Welcome to Themora</h2>

        <button
            @click="toggleTheme"
            class="flex items-center justify-center size-tm-40 rounded-full border border-tm-light-grey"
        >
          <RiSunFill v-if="isDark" size="20px" color="var(--color-tm-secondary)"/>
          <RiMoonFill v-else size="20px" color="var(--color-tm-dark)"/>
        </button>
      </header>

      <main class="py-6">
        <h2 class="text-xl text-white">تنظیمات عمومی</h2>
      </main>

      <footer class="pt-4 border-t border-dashed border-tm-light-grey">
        <button class="text-white bg-tm-green rounded-tm-6 px-6 py-2 cursor-pointer">save</button>
      </footer>
    </section>
  </div>
</template>