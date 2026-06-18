<script setup lang="ts">
import {ref} from 'vue'
import type {MenuItem} from '../types/menu.ts'

import BrandLayout from '../components/layouts/BrandLayout.vue'

import {
  RiArrowRightDoubleLine,
  RiArrowLeftSLine,
} from '@remixicon/vue'


const props = defineProps<{
  menus: MenuItem[]
  activeKey: string
  collapsed: boolean
  sidebarOpen: boolean
}>()

const emit = defineEmits<{
  (e: 'update:collapsed', value: boolean): void
  (e: 'change', item: MenuItem, key: string): void
}>()


const openedMenus = ref<Record<number, string>>({})
// ---------------- SUBMENU ----------------
const toggleSubmenu = (
    key: string,
    level: number
) => {

  if (props.collapsed)
    return


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
    item: MenuItem,
    key: string
) => {

  emit(
      'change',
      item,
      key
  )

}


const hasActiveChild = (
    key: string
) => {

  return props.activeKey.startsWith(
      key + '-'
  )

}


const toggleSidebar = () => {

  emit(
      'update:collapsed',
      !props.collapsed
  )


  if (!props.collapsed) {

    openedMenus.value = {}

  }

}
</script>

<template>
  <aside
      class="themora-menu bg-tm-primary fixed lg:relative right-0 top-0 z-40 min-h-full p-tm-5 rounded-tm-12 shadow transition-all duration-300"
      :class="[collapsed? 'w-20 sidebar-collapse': 'w-72 sidebar-open', sidebarOpen ? 'translate-x-0': 'translate-x-full lg:translate-x-0']"
  >
    <button
        @click="toggleSidebar"
        class="absolute -left-3 top-3 bg-white rounded-full p-1 shadow cursor-pointer"
        :class="[ sidebarOpen ? '' : 'max-sm:hidden']"
    >
      <RiArrowRightDoubleLine
          class="w-5 h-5 transition-transform duration-300"
          :class="{'rotate-180':collapsed}"
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
              duration-300"
              :class="{

active:
activeKey === `${index}`
||
hasActiveChild(`${index}`)

}"


              @click="

setActiveItem(item,`${index}`);

item.children &&
toggleSubmenu(`${index}`,0)

"


          >


            <div class="flex items-center gap-3">

<span>
  <component
      :is="item.icon"
      size="20"
  />
  <!--{{item.icon}}-->
</span>


              <span

                  class="text-tm-13"

                  v-show="!collapsed"

              >

{{ item.title }}

</span>


            </div>


            <RiArrowLeftSLine

                v-if="item.children && !collapsed"

                size="20px"

                class="transition-transform"

                :class="{
'-rotate-90':isOpen(`${index}`,0)
}"

            />


          </div>


          <Transition name="submenu">


            <div

                class="tm-submenu-wrapper"

                :class="{open:isOpen(`${index}`,0)}"

            >


              <ul

                  v-if="item.children"

                  class="themora-submenu"

              >


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
items-center
transition-all
hover:text-tm-secondary
"


                      :class="{

active:
activeKey === `${index}-${cIndex}`

||

hasActiveChild(
`${index}-${cIndex}`
)

}"


                      @click.stop="

setActiveItem(
child,
`${index}-${cIndex}`
);

child.children &&
toggleSubmenu(
`${index}-${cIndex}`,
1
)
"
                  >
                    <div class="flex items-center gap-2">
                      <component :is="child.icon" size="6"/>
                      <span class="text-tm-13 mr-tm-10">{{ child.title }}</span>
                    </div>

                    <RiArrowLeftSLine
                        v-if="child.children"
                        size="20px"
                        class="transition-transform"
                        :class="{'-rotate-90':isOpen(`${index}-${cIndex}`,1)}"
                    />
                  </div>
                  <Transition name="submenu">
                    <div
                        class="tm-submenu-wrapper"
                        :class="{open:isOpen(`${index}-${cIndex}`,1)}"
                    >
                      <ul
                          v-if="child.children"
                          class="pl-6"
                      >
                        <li
                            v-for="(sub,sIndex) in child.children"
                            :key="sIndex"
                            class="pr-tm-10 cursor-pointer"
                            :class="{active:activeKey ===`${index}-${cIndex}-${sIndex}`}"
                            @click.stop="setActiveItem(sub,`${index}-${cIndex}-${sIndex}`)"
                        >
                          <div
                              class="
                              group
                              text-white
                              px-4
                              py-3
                              cursor-pointer
                              flex
                              gap-4
                              items-center
                              hover:text-tm-secondary"
                          >
                            <component :is="child.icon" size="6"/>
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
</template>