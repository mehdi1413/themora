<script setup lang="ts">
import {ref, reactive, computed, onMounted} from 'vue'

import type {MenuItem} from '../types/menu.ts'
import {createMenus} from '../config/menu.ts'

import Sidebar from "./Sidebar.vue";
import FooterContent from './content/Footer.vue'
import HeaderContent from './content/Header.vue'

import {getSettings} from '../api/settings'

// ---------------- SETTINGS ----------------
const settings = reactive({

  general: {

    title: '',
    selectOne: 'DESC',
    showTitle: true
  },


  archive: {

    removePrefix: false,
    perPage: 12

  },


  colors: {

    primaryColor: '#c52f32',
    secondaryColor: '#e89d26',
    darkColor: '#222222',
    whiteColor: '#FFFFFF',
    greyColor: '#555555',
    greenColor: '#118E62',
    blueColor: '#1B619A'

  }

})

onMounted(async () => {
  try {
    const data = await getSettings()
    Object.assign(settings, data)
  } catch (e) {
    console.error(e)
  }
})
// ---------------- MENU ----------------
// const menus = ref<MenuItem[]>(
//     createMenus(settings)
// )
const menus = ref<MenuItem[]>(createMenus())


// ---------------- ACTIVE ----------------
const activeMenu = ref<MenuItem | null>(null)
const activeKey = ref('')


// default page
activeMenu.value = menus.value[0]
activeKey.value = '0'

const currentPage = computed(() => {
  return activeMenu.value?.page
})

// ---------------- SIDEBAR ----------------
const sidebarOpen = ref(false)
const collapsed = ref(false)

// ---------------- ACTIVE MENU ----------------
const setActiveItem = (item: MenuItem, key: string) => {
  activeMenu.value = item
  activeKey.value = key
}

// ---------------- Open Sidebar From Header Btn ----------------
const openSidebar = () => {
  sidebarOpen.value = true
}

const closeSidebar = () => {
  sidebarOpen.value = false
}

// ---------------- DARK MODE ----------------
const isDark = ref(false)
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
  <div class="flex min-h-screen py-tm-60 gap-4 select-none">
    <!-- overlay -->
    <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        @click="closeSidebar"
    />
    <!-- SIDEBAR -->
    <Sidebar
        :menus="menus"
        :sidebarOpen="sidebarOpen"
        :activeKey="activeKey"
        v-model:collapsed="collapsed"
        @change="setActiveItem"
    />

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
              :settings="settings"
          />
        </main>
        <FooterContent/>
      </form>
    </section>
  </div>
</template>